<?php

class authController extends controller
{
    public function register()
    {
        // Following if statement will prevent browser to enter register page, if user already logged in.
        if ($this->check_auth())
        {
            header('location: '.$this->redirect_url);
            exit();
        }
        else
        {
            $this->view('register');
        }
    }

    public function storeUser()
    {
        $name = $_POST['name'];
        $user = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $csrf = $_POST['csrf-token'];

        $csrf_svc = new SecurityService();
        if (!$csrf_svc->validate_token($csrf))
        {
            return var_dump('Error : CSRF Token invalid.');
        }

        include 'app/model/user.php';
        $new_user = new user();
        echo $new_user->insert($name, $user, $password, $email);

        header('location: http://localhost/mvc/login');
    }

    public function activate_user($token)
    {
        include 'app/model/user.php';
        $new_user = new user();
        $result = $new_user->activate_user($token);

        if ($result['response'] == 200)
        {
            header('location: http://localhost/mvc/login');
            exit();
        }
    }

    public function showlogin()
    {
        if ($this->check_auth())
        {
            header('location: '.$this->redirect_url);
            exit();
        }
        else
        {
            $this->view('login');
        }
    }

    public function login()
    {
        $user = $_POST['username'];
        $psk = $_POST['password'];

        include 'app/model/user.php';
        $new_user = new user();
        $res = $new_user->find_user($user, $psk);

        if ($res['response'] == 200)
        {
            // User found & session entry required
            $_SESSION['user_id'] = $res['message']['id'];
            $_SESSION['username'] = $res['message']['user'];
            $_SESSION['name'] = $res['message']['name'];
            $_SESSION['type'] = $res['message']['type'];
            $_SESSION['is_auth'] = 1;
        }
        else
        {
            header('location: http://localhost/mvc/login');
            exit();
        }

        header('location: '.$this->redirect_url);
        exit();
    }

    public function logout()
    {
        session_destroy();
        header('location: http://localhost/mvc/login');
        exit();
    }
}

?>
