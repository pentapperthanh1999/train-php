<?php
class TeachersController extends Controller {

    public function __construct()
    {
        $this->teacherModel = $this->model('Teacher');
    }
    // teacher home page
    public function index() 
    {
        $teachers = $this->teacherModel->getAllTeachers();
        $data = array(
            'teachers' => $teachers
        );
        $this->view('teachers/index', $data);
    }
    // create teacher
    public function create()
    {
        $data = [
            'code' => '',
            'name' => '',
            'birthday' => '',
            'gender' => '',
            'address' => '',
            'status' => '',
            'message' => array(
                'codeError' => '',
                'nameError' => '',
                'birthdayError' => '',
                'genderError' => '',
                'addressError' => '',
                'duplicate' => ''
            )
        ];
        // check request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $code = $_POST['code'];
            $name = $_POST['name'];
            $birthday = $_POST['birthday']; //day default dd-mm-yyyy
            $birthday = !empty($_POST['birthday']) ? date("Y-m-d H:i:s", strtotime($birthday)) : ''; // convert yyyy-mm-dd
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $data = [
                'code' => trim($code),
                'name' => trim($name),
                'birthday' => trim($birthday),
                'gender' => trim($gender),
                'address' => trim($address),
                'message' => array(
                    'codeError' => '',
                    'nameError' => '',
                    'birthdayError' => '',
                    'genderError' => '',
                    'addressError' => '',
                    'duplicate' => ''
                    )
                ];
            //validation data
            if (empty($data['code'])) {
                $data['message']['codeError'] = 'The code of a teacher cannot be empty';
            }
            if (empty($data['name'])) {
                $data['message']['nameError'] = 'The name of a teacher cannot be empty';
            }
            if (empty($data['birthday'])) {
                $data['message']['birthdayError'] = 'The birthday of a teacher cannot be empty';
            }
            if (isset($data['gender']) && $data['gender'] == '') {
                $data['message']['genderError'] = 'The gender of a teacher cannot be empty';
            }
            if (empty($data['address'])) {
                $data['message']['addressError'] = 'The address of a teacher cannot be empty';
            }
            
            $status_when_submit = STATUS_TRUE; //status when submit
            //check pass all data;
            foreach ($data['message'] as $key => $value) {
                // $default_status = !empty($value) ? 0 : 1;
                if (!empty($value)) { 
                    $status_when_submit = STATUS_FALSE;
                    break; // break loop when one value has message
                }
            }

            //submit data
            if ($status_when_submit == STATUS_TRUE) {
                if ($this->teacherModel->createteacher($data)) {
                    header("Location: " . URLROOT . "/teachers");
                } else {
                    $data['message']['duplicate'] = 'Duplicate Student! Please try again!';
                    $this->view('teachers/create', $data);
                }
            } else {
                $this->view('teachers/create', $data);
                
            }
        }
        $this->view('teachers/create', $data);
    }
    // update teacher
    public function update($id)
    {
        $teacher_selected = $this->teacherModel->getteacherById($id);
        $data = [
            'teacher' => $teacher_selected,
            'code' => '',
            'name' => '',
            'birthday' => '',
            'gender' => '',
            'address' => '',
            'status' => '',
            'message' => array(
                'codeError' => '',
                'nameError' => '',
                'birthdayError' => '',
                'genderError' => '',
                'addressError' => '',
                'duplicate' => ''
            )
        ];
        // check request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            $new_code = $_POST['code'];
            $new_name = $_POST['name'];
            $new_birthday = $_POST['birthday']; //day default dd-mm-yyyy
            $new_birthday = !empty($_POST['birthday']) ? date("Y-m-d H:i:s", strtotime($new_birthday)) : ''; // convert yyyy-mm-dd
            $new_gender = $_POST['gender'];
            $new_address = $_POST['address'];
            $data = [
                'teacher' => $teacher_selected,
                'id' => $id,
                'code' => trim($new_code),
                'name' => trim($new_name),
                'birthday' => trim($new_birthday),
                'gender' => trim($new_gender),
                'address' => trim($new_address),
                'message' => array(
                    'codeError' => '',
                    'nameError' => '',
                    'birthdayError' => '',
                    'genderError' => '',
                    'addressError' => '',
                    'duplicate' => ''
                    )
                ];
            //validation data
            if (empty($data['code'])) {
                $data['message']['codeError'] = 'The code of a teacher cannot be empty';
            }
            if (empty($data['name'])) {
                $data['message']['nameError'] = 'The name of a teacher cannot be empty';
            }
            if (empty($data['birthday'])) {
                $data['message']['birthdayError'] = 'The birthday of a teacher cannot be empty';
            }
            if (isset($data['gender']) && $data['gender'] == '') {
                $data['message']['genderError'] = 'The gender of a teacher cannot be empty';
            }
            if (empty($data['address'])) {
                $data['message']['addressError'] = 'The address of a teacher cannot be empty';
            }
            
            $status_when_submit = STATUS_TRUE; //status when submit
            //check pass all data;
            foreach ($data['message'] as $key => $value) {
                // $default_status = !empty($value) ? 0 : 1;
                if (!empty($value)) { 
                    $status_when_submit = STATUS_FALSE;
                    break; // break loop when one value has message
                }
            }

            //submit data
            if ($status_when_submit == STATUS_TRUE) {
                if ($this->teacherModel->updateteacher($data)) {
                    header("Location: " . URLROOT . "/teachers");
                } else {
                    $data['message']['duplicate'] = 'Duplicate Student! Please try again!';
                    $this->view('teachers/update', $data);
                }
            } else {
                $this->view('teachers/update', $data);
                
            }
        }
        $this->view('teachers/update', $data);
    }
    // delete teacher
    public function delete($id)
    {
        $this->teacherModel->getteacherById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            if ($this->teacherModel->deleteteacher($id)) {
                header('Location: ' . URLROOT . '/teachers' );
            } else {
                die('Something went wrong, please try again');
            }
        }
    }
}
