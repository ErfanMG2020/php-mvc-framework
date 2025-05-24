<?php

class controller
{
    public $redirect_url = 'http://localhost/mvc/products';
    public function view($file_name, $data = '')
    {
		// The controller::nav() can also called here to have the same header for every page in project.
        $this->nav('header');

        $new_csrf = new SecurityService();
        include 'app/view/'.$file_name.'.php';
    }

	// Following function can be used to include any header from "app/layouts/*.php", before any controller::view() function
    public function nav($file_name)
    {
        include 'app/view/layouts/'.$file_name.'.php';
    }

    public function check_auth()
    {
        // Following if statement will prevent browser to enter register page, if user already logged in.
        if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>
