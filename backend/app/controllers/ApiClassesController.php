<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class ApiClassesController extends Controller {

    public function __construct()
    {
        $this->classModel = $this->model('Classes');
    }
    // init api classes
    public function api() {
        $method = $_SERVER['REQUEST_METHOD'];
        $response = array();
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        switch($method) {
            case 'GET':
                if ($id) {
                    $response = $this->getClass($id);
                } else {
                    $response = $this->getAllClasses();
                }
                break;
            case 'POST':
                $response = $this->createClassFromRequest();
                break;
            case 'PUT':
                $id = isset($_GET['id']) ? $_GET['id'] : '';
                if ($id) {
                    $response = $this->updateClassFromRequest($id);
                }
                break;
            case 'DELETE':
                $id = isset($_GET['id']) ? $_GET['id'] : '';
                if ($id) {
                    $response = $this->deleteClass($id);
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
    //Get all classes
    private function getAllClasses() {
        $result = $this->classModel->getAllClasses();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
    // get class by id
    private function getClass($id)
    {
        $result = $this->classModel->getClassById($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
    // validate input class
    private function validateClass($input)
    {
        if (!isset($input['code'])) {
            return false;
        }
        if (!isset($input['name'])) {
            return false;
        }
        return true;
    }
    // create class
    private function createClassFromRequest()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateClass($input)) {
            return $this->unprocessableEntityResponse();
        }
        $execute = $this->classModel->createClass($input);
        if ($execute) {
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = null;
        } else {
            $response['status_code_header'] = 'HTTP/1.1 404 Cant Created';
            $response['body'] = null;
        }
        return $response;
    }
    // update class
    private function updateClassFromRequest($id)
    {
        $result = $this->classModel->getClassById($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateClass($input)) {
            return $this->unprocessableEntityResponse();
        }
        $execute = $this->classModel->updateClass($input);
        if ($execute) {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = null;
        } else {
            $response['status_code_header'] = 'HTTP/1.1 404 Cant Updated';
            $response['body'] = null;
        }
        return $response;
    }
    // delete class
    private function deleteClass($id)
    {
        $result = $this->classModel->getClassById($id);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $execute = $this->classModel->deleteClass($id);
        if ($execute) {
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = null;
        } else {
            $response['status_code_header'] = 'HTTP/1.1 404 Cant Delete';
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
