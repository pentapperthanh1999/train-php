<?php

class Teacher {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    //get all teachers in db
    public function getAllteachers()
    {
        $sql = "SELECT * FROM teachers ORDER BY created_at DESC";
        $this->db->query($sql);
        $result = $this->db->all();
        return $result;
    }

    //count teachers
    public function countTeachers()
    {
        $sql = "SELECT * FROM teachers";
        $this->db->query($sql);
        $this->db->all();
        $result = $this->db->rowCount();
        return $result;
    }
    //create teacher
    public function createTeacher($data)
    {
        // check duplicate
        $sql_check = 'SELECT * FROM teachers WHERE code = :code';
        $this->db->query($sql_check);
        $this->db->bind(':code', $data['code']);
        $this->db->execute();
        $count = $this->db->rowCount();

        if ($count <= 0) {
            $sql = "INSERT INTO teachers ( code, name, birthday, gender, address ) VALUES (:code, :name, :birthday, :gender, :address)";
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
    // get teacher
    public function getTeacherById($id)
    {
        $sql = "SELECT * FROM teachers WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $data = $this->db->single();
        return $data;
    }
    // update teacher
    public function updateTeacher($data)
    {   
        // check duplicate
        $sql_check = 'SELECT * FROM teachers WHERE code = :code';
        $this->db->query($sql_check);
        $this->db->bind(':code', $data['code']);
        $this->db->execute();
        $count = $this->db->rowCount();

        if ($count <=0) {
            $sql = "UPDATE teachers SET code = :code, name = :name, birthday = :birthday, gender = :gender, address = :address WHERE id = :id";
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
    // delete teacher
    public function deleteTeacher($id)
    {
        $sql = "DELETE FROM teachers WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}