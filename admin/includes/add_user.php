<?php
if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $user_role = $_POST['user_role'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
    $query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_image}', '{$user_role}' ) ";

    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);

    header("Location: users.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" id="user_password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" id="user_firstname" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" id="user_lastname" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" id="user_email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_image">Image</label>
        <input type="file" id="user_image" name="user_image">
    </div>


    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" id="user_role" class="form-control">
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>