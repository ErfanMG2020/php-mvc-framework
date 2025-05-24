<?php

include 'core/model.php';

class user extends model
{
    public function insert($name, $user, $psk, $email)
    {
        // Encrypt password for additional security
        $psk_enc = password_hash($psk, PASSWORD_DEFAULT);
        $token = bin2hex(openssl_random_pseudo_bytes(32));

        $query = "INSERT INTO users(name, user, password, email, token) VALUES(?, ?, ?, ?, ?)";
        $result = $this->connection->prepare($query);
        $result->bind_param('sssss', $name, $user, $psk_enc, $email, $token);
        $result->execute();

        // Account verification (line commented out because it requires mail server configuration)
        $link = '<a href="http://localhost/mvc/active-link/'.$token.'">Click Me</a>';
        // mail($email, 'Activation link', $link);

        return 'OK!';
    }

    public function find_user($user, $psk)
    {
        $query = "SELECT * FROM users WHERE user = ? AND is_active = 1 LIMIT 0, 1";
        $result = $this->connection->prepare($query);
        $result->bind_param('s', $user);
        $result->execute();

        $user = $result->get_result()->fetch_assoc();
        if (password_verify($psk, $user['password']))
        {
            return ['response'=>200, 'message'=>$user];
        }
        return ['response'=>403, 'message'=>'Error! Invalid username or password.'];
    }

    public function activate_user($token)
    {
        $query = "SELECT * FROM users WHERE token = ? LIMIT 0, 1";
        $result = $this->connection->prepare($query);
        $result->bind_param('s', $token);
        $result->execute();

        $user = $result->get_result()->fetch_assoc();

        if ($user && isset($user['id']))
        {
            $query = "UPDATE users SET is_active = 1 WHERE id = '".$user['id']."' ";
            $this->connection->query($query);
            return ['response'=>200, 'message'=>$user];
        }
        return ['response'=>403, 'message'=>'Error! Invalid user token.'];
    }

    public function edit()
    {

    }
}

?>
