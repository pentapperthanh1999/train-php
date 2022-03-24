<?php

class Assignment {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllAssignments()
    {
        $sql = 'SELECT a.id, s.code as `student_code`, c.code as `class_code`, t.code as `teacher_code` from assignments a
            INNER JOIN students s ON s.code = a.student_code
            INNER JOIN classes c ON c.code = a.class_code
            INNER JOIN teachers t ON t.code = a.teacher_code
        ';
        $this->db->query($sql);
        $result = $this->db->all();
        return $result;
    }
    //get class by code
    public function getClassInfo($code) {
        $sql = "SELECT c.id, c.code, c.name FROM classes c INNER JOIN assignments a ON a.class_code = c.code WHERE c.code = :class_code";
        $this->db->query($sql);
        $this->db->bind(':class_code', $code);
        $result = $this->db->single();
        return $result;
    }
    //get student by code
    public function getStudentInfo($code) {
        $sql = "SELECT s.id, s.code, s.name, s.birthday, s.gender, s.address FROM students s INNER JOIN assignments a ON a.student_code = s.code WHERE s.code = :student_code";
        $this->db->query($sql);
        $this->db->bind(':student_code', $code);
        $result = $this->db->single();
        return $result;
    }
    //get teacher by code
    public function getTeacherInfo($code) {
        $sql = "SELECT t.id, t.code, t.name, t.birthday, t.gender, t.address FROM teachers t INNER JOIN assignments a ON a.teacher_code = t.code WHERE t.code = :teacher_code";
        $this->db->query($sql);
        $this->db->bind(':teacher_code', $code);
        $result = $this->db->single();
        return $result;
    }

    public function createAssignment($data)
    {
        // $sql = "INSERT INTO assignments ( student_code, class_code, teacher_code ) VALUES (:student_code, :class_code, :teacher_code)
        // ";
        $sql = "INSERT INTO assignments (student_code, class_code, teacher_code )
        SELECT * FROM (SELECT :student_code, :class_code, :teacher_code ) AS tmp
        WHERE NOT EXISTS (
            SELECT * FROM assignments WHERE student_code = :student_code and class_code = :class_code and teacher_code = :teacher_code
        ) LIMIT 1";
        $this->db->query($sql);

        $this->db->bind(':student_code', $data['student_code']);
        $this->db->bind(':class_code', $data['class_code']);
        $this->db->bind(':teacher_code', $data['teacher_code']);
        
        $this->db->execute();
        // check duplicate data in db
        return $this->db->rowCount() > 0 ? true : false;
    }

    public function getAssignById($id)
    {
        $sql = "SELECT * FROM assignments WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $data = $this->db->single();
        return $data;
    }

    public function updateAssign($data)
    {
        $sql = "UPDATE assignments SET student_code = :student_code, class_code = :class_code, teacher_code = :teacher_code WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':student_code', $data['student_code']);
        $this->db->bind(':teacher_code', $data['teacher_code']);
        $this->db->bind(':class_code', $data['class_code']);
        // print_r($sql);
        // die();
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAssign($id)
    {
        $sql = "DELETE FROM assignments WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
