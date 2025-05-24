<?php

// Instead of including each file in each function, do it by a parent class 'controller'
// and pass its file name to controller::view() function.

class indexController extends controller
{
    public function __construct() {}

    public function home()
    {
        $this->view('home');
//        include 'app/view/home.php';
    }

    public function search()
    {
        $this->view('search');
//        include 'app/view/search.php';
    }
}
