<?php
class Classes {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    //get all classes in db
    public function getAllClasses()
    {
        $sql = "SELECT * FROM classes ORDER BY created_at DESC";
        $this->db->query($sql);
        $result = $this->db->all();
        return $result;
    }
    //count classes
    public function countClasses()
    {
        $sql = "SELECT * FROM classes";
        $this->db->query($sql);
        $this->db->all();
        $result = $this->db->rowCount();
        return $result;
    }
    //create class
    public function createClass($data)
    {   

        $sql_check = 'SELECT * FROM classes WHERE code = :code';
        $this->db->query($sql_check);
        $this->db->bind(':code', $data['code']);
        $this->db->execute();
        $count = $this->db->rowCount();

        if ($count <= 0) {
            $sql = "INSERT INTO classes ( code, name ) VALUES (:code, :name)";
            $this->db->query($sql);
            $this->db->bind(':code', $data['code']);
            $this->db->bind(':name', $data['name']);
            
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // get class by id
    public function getClassById($id)
    {
        $sql = "SELECT * FROM classes WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $data = $this->db->single();
        return $data;
    }
    // update class
    public function updateClass($data)
    {
        // check duplicate
        $sql_check = 'SELECT * FROM classes WHERE code = :code';
        $this->db->query($sql_check);
        $this->db->bind(':code', $data['code']);
        $this->db->execute();
        $count = $this->db->rowCount();

        if ($count <= 0) {
            $sql = "UPDATE classes SET code = :code, name = :name WHERE id = :id";
        
            $this->db->query($sql);
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':code', $data['code']);
            $this->db->bind(':name', $data['name']);
            // print_r($sql);
            // die();
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }     
        } else {
            return false;
        }
    }
    // delete class
    public function deleteClass($id)
    {
        $sql = "DELETE FROM classes WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //api: read classes
    public function apiReadClasses()
    {
        $sql = "SELECT * FROM classes ORDER BY created_at DESC";
        $this->db->query($sql);
        $result = $this->db->all();
        print_r($result); die;
    }
}