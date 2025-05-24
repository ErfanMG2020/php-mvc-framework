<?php

trait userPolicy
{
    public function is_admin()
    {
        if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 1 && $_SESSION['type'] == 'admin')
        {
            return true;
        }
        return false;
    }

    public function edit()
    {

    }

    public function write()
    {

    }
}

?>
