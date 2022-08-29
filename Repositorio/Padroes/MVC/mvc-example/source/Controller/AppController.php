<?php
namespace App\Controller;

use App\Model\User;

final class AppController extends Controller {

    public static function index() {
        return self::view('index');
    }

    public static function list() {
        $users = (new User)->listAll();
        return self::view('list', ['users' => $users]);
    }

    public static function write() {
        (new User)->createNew( self::params('user') );
        self::redirect('/list');
    }

    public static function logout() {
        (new User)->deleteAll();
        self::redirect('/');
    }
}