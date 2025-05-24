<h1>Product List</h1>

<?php 
if ($this->check_auth())
{
?>

<h2>Welcome <?php echo $_SESSION['name']; ?> </h2>
<br>
<form action="http://localhost/mvc/logout" method="post">
    <button type="submit">Logout</button>
</form>
<br><br>

<?php
}
else
{
?>

<h2>Welcome Guest</h2>
<br>
<form action="http://localhost/mvc/login" method="post">
    <button type="submit">Login</button>
</form>
<br><br>

<?php
}
?>

<link rel="stylesheet" href="">
<table border="2" cellpadding="10">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Model number</th>
<?php if ($this->is_admin()) { ?>
            <th>Action</th>
<?php } ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data['product'] as $product) { ?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['slug']; ?></td>
<?php if ($this->is_admin()) { ?>
            <td><a href="http://localhost/mvc/product/show_product/<?php echo $product['slug']; ?>">Edit</a></td>
<?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>
