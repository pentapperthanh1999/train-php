<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class ApiTeachersController extends Controller {

    public function __construct()
    {
        $this->teacherModel = $this->model('Teacher');
    }
    // init api teachers
    public function api() {
        $method = $_SERVER['REQUEST_METHOD'];
        $response = array();
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        switch($method) {
            case 'GET':
                if ($id) {
                    $response = $this->getTeacher($id);
                } else {
                    $response = $this->getAllTeachers();
                }
                break;
            case 'POST':
                $response = $this->createTeacherFromRequest();
                break;
            case 'PUT':
                $id = isset($_GET['id']) ? $_GET['id'] : '';
                if ($id) {
                    $response = $this->updateTeacherFromRequest($id);
                }
                break;
            case 'DELETE':
                $id = isset($_GET['id']) ? $_GET['id'] : '';
                if ($id) {
                    $response = $this->deleteTeacher($id);
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
    //Get all teachers
    private function getAllTeachers() {
        $result = $this->teacherModel->getAllTeachers();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
    // get teacher by id
    private function getTeacher($id)
    {
        $result = $this->teacherModel->getTeacherById($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
    // validate input teacher
    private function validateTeacher($input)
    {
        if (!isset($input['code'])) {
            return false;
        }
        if (!isset($input['name'])) {
            return false;
        }
        if (!isset($input['birthday'])) {
            return false;
        }
        if (!isset($input['gender'])) {
            return false;
        }
        if (!isset($input['address'])) {
            return false;
        }
        return true;
    }
    // create teacher
    private function createTeacherFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateTeacher($input)) {
            return $this->unprocessableEntityResponse();
        }
        $execute = $this->teacherModel->createTeacher($input);
        if ($execute) {
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;
        } else {
            $response['status_code_header'] = 'HTTP/1.1 404 Cant Created';
            $response['body'] = null;
        }
        return $response;
    }
    // update teacher
    private function updateTeacherFromRequest($id)
    {
        $result = $this->teacherModel->getTeacherById($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateTeacher($input)) {
            return $this->unprocessableEntityResponse();
        }
        $execute = $this->teacherModel->updateTeacher($input);
        if ($execute) {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = null;
        } else {
            $response['status_code_header'] = 'HTTP/1.1 404 Cant Updated';
            $response['body'] = null;
        }
        return $response;
    }
    // delete teacher
    private function deleteTeacher($id)
    {
        $result = $this->teacherModel->getTeacherById($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $execute = $this->teacherModel->deleteTeacher($id);
        if ($execute) {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = null;
        } else {
            $response['status_code_header'] = 'HTTP/1.1 404 Cant Detele';
            $response['body'] = null;
        }
        return $response;
    }
    // un process
    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
    // not found response
    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
