<h1>Register</h1>

<form action="http://localhost/mvc/register" method="POST">

    <input type="hidden" name="csrf-token" value=<?php echo $new_csrf->getCSRFToken(); ?>>

    <label>Name : </label>
    <input type="text" name="name" placeholder="Your name">
    <br>

    <label>Username : </label>
    <input type="text" name="username" placeholder="Your username">
    <br>

    <label>Password : </label>
    <input type="password" name="password" placeholder="Strong password">
    <br>

    <label>Email : </label>
    <input type="email" name="email" placeholder="Email">
    <br>
    <button type="submit">Register</button>

</form>
