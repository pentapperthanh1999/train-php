<?php

class PagesController extends Controller {

    public function __construct()
    {
        $this->classModel = $this->model('Classes');
        $this->studentModel = $this->model('Student');
        $this->teacherModel = $this->model('Teacher');
    }

    public function index() 
    {   
        $countStudents = $this->studentModel->countStudents();
        $countClasses = $this->classModel->countClasses();
        $countTeachers = $this->teacherModel->countTeachers();
        
        $data = [
            'countStudents' => $countStudents,
            'countClasses' => $countClasses,
            'countTeachers' => $countTeachers
        ];

        $this->view('pages/index', $data);
    }
}
