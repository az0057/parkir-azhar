<?php

class Controller {
    // Fungsi untuk memanggil tampilan (View)
    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }

    // Fungsi untuk memanggil logika database (Model)
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
}