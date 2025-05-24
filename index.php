<?php

// Session start should be at the highest level of project
session_start();

include 'core/route.php';
include 'core/controller.php';
include 'app/services/SecurityService.php';

$csrf_token = new SecurityService();
$csrf_token->setCSRFToken();

new route();

?>
