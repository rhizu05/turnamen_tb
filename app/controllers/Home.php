<?php

class Home extends Controller {
    public function index() 
    {
        $data['judul'] = 'Home';
        $data['games'] = $this->model('GameModel')->getAllGames();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
