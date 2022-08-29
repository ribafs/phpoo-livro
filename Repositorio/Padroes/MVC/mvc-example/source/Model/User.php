<?php
namespace App\Model;

class User {

    public function __construct() {
        session_start();
        session_regenerate_id();

        if(!isset($_SESSION['users']))
            $_SESSION['users'] = [];
    }

    public function listAll() {
        return $_SESSION['users'];
    }

    public function createNew(string $name) {
        $_SESSION['users'][] = $name;
    }

    public function deleteAll() {
        unset($_SESSION['users']);
        session_destroy();
    }
}