<?php

class AssignmentsController extends Controller {
    
    public function __construct()
    {
        $this->assignmentModel = $this->model('Assignment');
        $this->classModel = $this->model('Classes');
        $this->studentModel = $this->model('Student');
        $this->teacherModel = $this->model('Teacher');
    }

    public function index()
    {
        $assignments = $this->assignmentModel->getAllAssignments();
        $data = array(
            'assignments' => $assignments
        );
        $this->view('assignments/index', $data);
    }

    public function create()
    {   
        $classes = $this->classModel->getAllClasses();
        $students = $this->studentModel->getAllStudents();
        $teachers = $this->teacherModel->getAllTeachers();

        $data = [
            'students' => $students,
            'classes'=> $classes,
            'teachers' => $teachers,
            'student_code' => '',
            'class_code' => '',
            'teacher_code' => '',
            'message' => [
                'already_exist' => '',
                'student_code_error' => '',
                'class_code_error' => '',
                'teacher_code_error' => ''
            ]
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $student_code = '';
            $class_code = '';
            $teacher_code = '';
            if (isset($_POST['student_code'])) {
                $student_code = $_POST['student_code'];
            }
            if (isset($_POST['class_code'])) {
                $class_code = $_POST['class_code'];
            }

            if (isset($_POST['teacher_code'])) {
                $teacher_code = $_POST['teacher_code'];
            }
            
            $data = [
                'students' => $students,
                'classes'=> $classes,
                'teachers' => $teachers,
                'student_code' => $student_code,
                'class_code' =>  $class_code,
                'teacher_code' => $teacher_code,
                'message' => [
                    'already_exist' => '',
                    'student_code_error' => '',
                    'class_code_error' => '',
                    'teacher_code_error' => ''
                ]
            ];
            // check field
            if (empty($data['student_code'])) {
                $data['message']['student_code_error'] = 'The student_code of a student cannot be empty';
            }
            if (empty($data['class_code'])) {
                $data['message']['class_code_error'] = 'The class_code of a class cannot be empty';
            }
            if (empty($data['teacher_code'])) {
                $data['message']['teacher_code_error'] = 'The teacher_code of a teacher cannot be empty';
            }

            if (!empty($student_code) && !empty($class_code) && !empty($teacher_code)) {
                if($this->assignmentModel->createAssignment($data)) {
                    header("Location: " . URLROOT . "/assignments");
                } else {
                    $data['message']['exist'] = 'Record Already Exists';
                }
            } 
        }
        $this->view('/assignments/create', $data);
    }

    public function update($id)
    {
        $assign_selected = $this->assignmentModel->getAssignById($id);

        $classes = $this->classModel->getAllClasses();
        $students = $this->studentModel->getAllStudents();
        $teachers = $this->teacherModel->getAllTeachers();

        $data = [
            'assign' => $assign_selected,
            'students' => $students,
            'classes'=> $classes,
            'teachers' => $teachers
        ];

        if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

            $new_student_code = $_POST['student_code'];
            $new_class_code = $_POST['class_code'];
            $new_teacher_code = $_POST['teacher_code'];

            $data = [
                'id' => $id,
                'assign' => $assign_selected,
                'students' => $students,
                'classes'=> $classes,
                'teachers' => $teachers,
                'student_code' => $new_student_code,
                'class_code' => $new_class_code,
                'teacher_code' => $new_teacher_code
            ];
            if ($this->assignmentModel->updateAssign($data)) {
                // print_r($data); die;
                header("Location: " . URLROOT . "/assignments");
            } else {
                die("Something went wrong, please try again");
            }
        }

        $this->view('assignments/update', $data);
    }
    //delete assign
    public function delete($id)
    {
        $this->assignmentModel->getAssignById($id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
            if ($this->assignmentModel->deleteAssign($id)) {
                header('Location: ' . URLROOT . '/assignments' );
            } else {
                die('Something went wrong, please try again');
            }
        } else {
            print_r('k co'); die;
        }
    }
    // get class properties
    public function getClass($code) {
        $code_lower_case = strtolower($code);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = $this->assignmentModel->getClassInfo($code_lower_case);
            // $this->view('assignments/index', $data);
            if (!empty($data)) {
                print_r(json_encode($data));
            }
        }
        return false;
    }
    // get student properties
    public function getStudent($code) {
        $code_lower_case = strtolower($code);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = $this->assignmentModel->getStudentInfo($code_lower_case);
            // $this->view('assignments/index', $data);
            if (!empty($data)) {
                print_r(json_encode($data));
            }
        }
        return false;
    }
    // get teacher properties
    public function getTeacher($code) {
        $code_lower_case = strtolower($code);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = $this->assignmentModel->getTeacherInfo($code_lower_case);
            // $this->view('assignments/index', $data);
            if (!empty($data)) {
                print_r(json_encode($data));
            }
        }
        return false;
    }

    
}
