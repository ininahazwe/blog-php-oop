<?php

class Misc {
    private $db;

    public function __construct() {
        $this->db = new Databases();
    }
    
    public function getNumPosts() {
        $this->db->query("SELECT * FROM posts");
        $this->db->execute();
        $data = $this->db->rowCount();
        return $data;   
    }
    public function getNumUsers() {
        $this->db->query("SELECT * FROM admin");
        $this->db->execute();
        $data = $this->db->rowCount();
        return $data;   
    }
    public function getNumCategories() {
        $this->db->query("SELECT * FROM categories");
        $this->db->execute();
        $data = $this->db->rowCount();
        return $data;   
    }
}