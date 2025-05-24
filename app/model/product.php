<?php

include 'core/model.php';

class product extends model
{
    public function insert()
    {
		// Function not implemented
    }

    public function edit()
    {
		// Function not implemented
    }

    public function getProducts()
    {
        $query = "SELECT * FROM products";
        $result = $this->connection->prepare($query);
        $result->execute();

        return $result->get_result();
    }
}
