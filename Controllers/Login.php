<?php

namespace Controllers;

class Login extends \Controllers\Controller {

    public function __construct() {
        parent::__construct(false);
    }

    public function index () {
        // If action isset then time to login!
        if ((isset($_GET['_action']))) {
            \Core\Session::remove("reason"); // Wipe this shit...
            Steam::OpenIDSteam();
        } else {
            $params = array (
                'css' => array ('login.css')
            );

            if (\Core\Session::get("reason")) {
                $params['reason'] = \Core\Session::get("reason");
            }

            Controller::$currentPage = "Login";
            Controller::buildPage(array(ROOT . 'views/navbar', ROOT . 'views/login/page'), $params);
        }
    }

    // Used for resyncing steam account details...
    public function resync() {
        if(\Core\Account::isLoggedIn()) {
            Steam::resync(\Core\Account::$steamid, true);
        } else {
            header("Location: ".URL);
        }
    }
}