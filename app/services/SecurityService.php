<?php

class SecurityService
{
    private $algo = 'sha256';
    private $hash = true; // Can be false
    private $salt = 'QWERTY!@#$%^';

    public function setCSRFToken()
    {
        if (empty($_SESSION['csrf-token']))
        {
            $_SESSION['csrf-token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
    }

    public function getCSRFToken()
    {
        if ($this->hash)
        {
            return $this->hmac_data($_SESSION['csrf-token']);
        }
        else
        {
            return $_SESSION['csrf-token'];
        }
    }

    public function hmac_data($data)
    {
        return hash_hmac($this->algo, $this->salt, $data);
    }

    public function validate_token($token)
    {
        if (!$_SESSION['csrf-token'])
        {
            return var_dump('Error CSRF Token unavailable.');
        }

        if ($this->hash)
        {
            $token_hash = $this->hmac_data($_SESSION['csrf-token']);
            return hash_equals($token_hash, $token);
        }
        else
        {
            return hash_equals($_SESSION['csrf-token'], $token);
        }
    }

}

?>