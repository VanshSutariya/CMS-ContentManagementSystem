<?php include 'includes/admin_header.php'; ?>
<?php
if (isset($_SESSION['username'])) {
    $the_username = $_SESSION['username'];
    $query = "SELECT * from users WHERE username = '{$the_username}' ";
    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }

    if (isset($_POST['update_profile'])) {
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];

        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        $user_role = $_POST['user_role'];

        move_uploaded_file($user_image_temp, "../images/$user_image");

        if (empty($user_image)) {
            $query = "SELECT * FROM users WHERE username = '{$the_username}' ";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_image)) {
                $user_image = $row['user_image'];
            }
        }

        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);

        if (!$select_randsalt_query) {
            die("Query Failed" . mysqli_error($connection));
        }

        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);

        $query = "UPDATE users SET ";
        $query .= "username = '$username', ";
        $query .= "user_password = '$hashed_password', ";
        $query .= "user_firstname = '$user_firstname', ";
        $query .= "user_lastname = '$user_lastname', ";
        $query .= "user_email = '$user_email', ";
        $query .= "user_image = '$user_image', ";
        $query .= "user_role = '$user_role' ";
        $query .= "WHERE username = '{$the_username}' ";

        $update_user_profile_query = mysqli_query($connection, $query);

        confirmQuery($update_user_profile_query);

        header("Location: index.php");
    }
}
?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo ucfirst($_SESSION['username']); ?></small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" class="form-control" name="username"
                                       value="<?php echo $username; ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input autocomplete="off" type="password" id="user_password" class="form-control"
                                       name="user_password">
                            </div>

                            <div class="form-group">
                                <label for="user_firstname">First Name</label>
                                <input type="text" id="user_firstname" class="form-control" name="user_firstname"
                                       value="<?php echo $user_firstname; ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_lastname">Last Name</label>
                                <input type="text" id="user_lastname" class="form-control" name="user_lastname"
                                       value="<?php echo $user_lastname; ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" id="user_email" class="form-control" name="user_email"
                                       value="<?php echo $user_email; ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_image">Image</label>
                                <br>
                                <img width="40" src="../images/<?php echo $user_image ?>"
                                     class="img-thumbnail img-rounded">
                                <p></p>
                                <input type="file" id="user_image" name="user_image">
                            </div>


                            <div class="form-group">
                                <label for="user_role">Role</label>
                                <select name="user_role" id="user_role" class="form-control">
                                    <option value="<?php echo $user_role ?>"><?php echo ucfirst($user_role); ?></option>
                                    <?php
                                    if ($user_role == 'admin') {
                                        echo "<option value='subscriber'>Subscriber</option>";
                                    } else {
                                        echo "<option value='admin'>Admin</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update_profile"
                                       value="Update Profile">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include 'includes/admin_footer.php'; ?>