<?php

class OrganizerModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query("INSERT INTO organizers (firstName, lastName, org_name, country, email, password, phone) VALUES (:firstName, :lastName, :org_name, :country, :email, :password, :phone)");
        $this->db->bind(':firstName', $data['firstName']); 
        $this->db->bind(':lastName', $data['lastName']); 
        $this->db->bind(':org_name', $data['org_name']); 
        $this->db->bind(':country', $data['country']); 
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        return $this->db->execute();
    }

    public function login($email) {
        $this->db->query("SELECT * FROM organizers WHERE email = :email");
        $this->db->bind(':email', $email);
        return $this->db->single();
    }
}
