<?php

class Student {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    //get all students in db
    public function getAllStudents()
    {
        $sql = "SELECT * FROM students ORDER BY created_at DESC";
        $this->db->query($sql);
        $result = $this->db->all();
        return $result;
    }
    //count students
    public function countStudents()
    {
        $sql = "SELECT * FROM students";
        $this->db->query($sql);
        $this->db->all();
        $result = $this->db->rowCount();
        return $result;
    }
    //create student
    public function createStudent($data)
    {   
        $sql_check = 'SELECT * FROM students WHERE code = :code';
        $this->db->query($sql_check);
        $this->db->bind(':code', $data['code']);
        $this->db->execute();
        $count = $this->db->rowCount();

        if ($count <= 0) {
            $sql = "INSERT INTO students ( code, name, birthday, gender, address ) VALUES (:code, :name, :birthday, :gender, :address)";
            $this->db->query($sql);
            $this->db->bind(':code', $data['code']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':birthday', $data['birthday']);
            $this->db->bind(':gender', $data['gender']);
            $this->db->bind(':address', $data['address']);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getStudentById($id)
    {
        $sql = "SELECT * FROM students WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $data = $this->db->single();
        return $data;
    }

    public function updateStudent($data)
    {
        $sql_check = 'SELECT * FROM students WHERE code = :code';
        $this->db->query($sql_check);
        $this->db->bind(':code', $data['code']);
        $this->db->execute();
        $count = $this->db->rowCount();
        if ($count <= 0) {
            $sql = "UPDATE students SET code = :code, name = :name, birthday = :birthday, gender = :gender, address = :address WHERE id = :id";
            $this->db->query($sql);
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':code', $data['code']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':birthday', $data['birthday']);
            $this->db->bind(':gender', $data['gender']);
            $this->db->bind(':address', $data['address']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteStudent($id)
    {
        $sql = "DELETE FROM students WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}