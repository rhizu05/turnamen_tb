<?php

class PlayerModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function login($email) {
        $this->db->query("SELECT * FROM players WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function register($data) {
        // Cek jika email sudah ada
        $this->db->query("SELECT id FROM players WHERE email = :email");
        $this->db->bind(':email', $data['email']);
        if ($this->db->single()) {
            return false; // Email sudah digunakan
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->db->query("INSERT INTO players (username, email, password, nickname) VALUES (:username, :email, :password, :nickname)");
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $hashedPassword);
        $this->db->bind(':nickname', $data['nickname']);

        return $this->db->execute();
    }
}
