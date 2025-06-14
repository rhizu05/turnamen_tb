<?php

class GameModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getGameBySlug($slug)
    {
        $this->db->query("SELECT * FROM games WHERE slug = :slug");
        $this->db->bind('slug', $slug);
        return $this->db->single();
    }


    public function getAllGames() {
        $this->db->query("SELECT * FROM games");
        return $this->db->resultSet();
    }

    public function getAll() {
        $this->db->query("SELECT * FROM games");
        return $this->db->resultSet();
    }
    
    public function getById($id)
    {
        $this->db->query("SELECT * FROM games WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}
