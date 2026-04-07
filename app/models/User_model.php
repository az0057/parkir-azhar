<?php

class User_model {
    private $table = 'tb_user';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // --- FUNGSI UNTUK LOGIN ---
    public function getUserByUsername($username) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username = :username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    // --- FUNGSI UNTUK CRUD USER ---
    public function getAllUser() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY role ASC");
        return $this->db->resultSet();
    }

    public function getUserById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_user = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataUser($data) {
        $query = "INSERT INTO " . $this->table . " (nama_lengkap, username, password, role) 
                  VALUES (:nama, :username, :password, :role)";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama_lengkap']);
        $this->db->bind('username', $data['username']);
        // Disarankan menggunakan password_hash jika sistem sudah stabil
        $this->db->bind('password', $data['password']); 
        $this->db->bind('role', $data['role']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // --- FITUR EDIT USER ---
    public function editDataUser($data) {
        $query = "UPDATE " . $this->table . " SET 
                    nama_lengkap = :nama,
                    username = :username,
                    role = :role
                  WHERE id_user = :id";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama_lengkap']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('role', $data['role']);
        $this->db->bind('id', $data['id_user']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataUser($id) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_user = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}