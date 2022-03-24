<?php
class ClassesController extends Controller {
    
    public function __construct()
    {
        $this->classModel = $this->model('Classes');
    }
    //show classes
    public function index()
    {
        $classes = $this->classModel->getAllClasses();
        $data = array(
            'classes' => $classes
        );
        $this->view('classes/index', $data);
    }
    //create class
    public function create()
    {
        $data = [
            'code' => '',
            'name' => '',
            'codeError' => '',
            'nameError' => '',
            'message' => '',
            'duplicate' => ''
        ];
        // check request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $data = [
                'code' => trim($_POST['code']),
                'name' => trim($_POST['name']),
                'codeError' => '',
                'nameError' => '',
                'message' => '',
                'duplicate' => ''
            ];

            if (empty($data['code'])) {
                $data['codeError'] = 'The code of a class cannot be empty';
            }

            if (empty($data['name'])) {
                $data['nameError'] = 'The name of a class cannot be empty';
            }

            if (empty($data['codeError']) && empty($data['nameError'])) {
                if ($this->classModel->createClass($data)) {
                    header("Location: " . URLROOT . "/classes");
                } else {
                    $data['duplicate'] = 'Duplicate Class! Please try again!';
                    $this->view('classes/create', $data);
                }
            } else {
                $this->view('classes/create', $data);
            }
        }
        $this->view('classes/create', $data);
    }
    //update class
    public function update($id)
    {
        $class_selected = $this->classModel->getClassById($id);
        $data = [
            'class' => $class_selected,
            'code' => '',
            'name' => '',
            'codeError' => '',
            'nameError' => '',
            'duplicate' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $data = [
                'id' => $id,
                'class' => $class_selected,
                'code' => trim($_POST['code']), //remove white space
                'name' => trim($_POST['name']), //remove white space
                'codeError' => '',
                'nameError' => '',
                'duplicate' => ''
            ];
            
            if (empty($data['code'])) {
                $data['codeError'] = 'The code of a class cannot be empty';
            }

            if (empty($data['name'])) {
                $data['nameError'] = 'The name of a class cannot be empty';
            }

            if (empty($data['codeError']) && empty($data['nameError'])) {
                
                if ($this->classModel->updateClass($data)) {
                    header("Location: " . URLROOT . "/classes");
                } else {
                    $data['duplicate'] = 'Duplicate Class';
                    $this->view('classes/update', $data);
                }
            } else {
                $this->view('classes/update', $data);
            }
        }
        // var_dump($data);
        // die;
        $this->view('classes/update', $data);
    }
    //delete class
    public function delete($id)
    {
        $class_selected = $this->classModel->getClassById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            if ($this->classModel->deleteClass($id)) {
                header('Location: ' . URLROOT . '/classes' );
            } else {
                die('Something went wrong, please try again');
            }
        }
    }
}
