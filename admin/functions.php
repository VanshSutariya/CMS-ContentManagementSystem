<?php

function redirect($location)
{
    // return header("Location:" . $location);
    header("Location:" . $location);
    exit;
}

function query($query)
{
    global $connection;
    return mysqli_query($connection, $query);
}

function imagePlaceholder($image = '')
{
    if (!$image) {
        return '../images/default.png';
    } else {
        return $image;
    }
}

function ifItIsMethod($method = null)
{
    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
        return true;
    }

    return false;
}

function isLoggedIn()
{
    if (isset($_SESSION['user_role'])) {
        return true;
    }

    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocatioin = null)
{
    if (isLoggedIn()) {
        redirect($redirectLocatioin);
    }
}

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function recordCount($table)
{
    global $connection;

    $query = "SELECT * FROM " . $table;
    $select_all_record = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_record);
    confirmQuery($result);

    return $result;
}

function checkStatus($table, $column, $status)
{
    global $connection;
    $query = "SELECT * FROM " . $table . " WHERE " . $column . " = '{$status}'";
    $select_all_record = mysqli_query($connection, $query);
    $record_count = mysqli_num_rows($select_all_record);
    return $record_count;
}

function checkUserRole($table, $column, $role)
{
    global $connection;
    $query = "SELECT * FROM " . $table . " WHERE " . $column . " = '{$role}'";
    $select_all_record = mysqli_query($connection, $query);
    $record_count = mysqli_num_rows($select_all_record);
    return $record_count;
}

function usersOnline()
{
    if (isset($_GET['onlineusers'])) {
        global $connection;

        if (!$connection) {
            session_start();
            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session' ";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time') ");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
            }

            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
            echo $count_user = mysqli_num_rows($users_online_query);
        }

    } // GET REQUEST isset()
}

usersOnline();

function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}

function isAdmin($username)
{
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username' ";

    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    $row = mysqli_fetch_array($result);

    if (isset($row['user_role']) == 'admin') {
        return true;
    } else {
        return false;
    }
}

function usernameExists($username)
{
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function emailExists($email)
{
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function registerUser($username, $email, $password)
{
    global $connection;

    /*if (usernameExists($username)) {
        $message = "User Exists!";
    } else {*/

    if (!empty($username) && !empty($email) && !empty($password)) {
        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        /*$query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);

        if (!$select_randsalt_query) {
            die("Query Failed" . mysqli_error($connection));
        }

        $row = mysqli_fetch_assoc($select_randsalt_query);
        $salt = $row['randSalt'];
        $password = crypt($password, $salt);*/

        $query = "INSERT INTO users(username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'admin' ) ";

        $register_user_query = mysqli_query($connection, $query);

        confirmQuery($register_user_query);

        /*if (!$register_user_query) {
            die("Query Failed " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
        }*/

        // header("Location: ./index.php");
        // $message = "Your Registration has been submitted.";
    } /*else {
            $message = "Fields cannot be empty.";
        }*/
    /*}*/
}

function loginUser($username, $password)
{

    global $connection;

    $username = mysqli_real_escape_string($connection, trim($username));
    $password = mysqli_real_escape_string($connection, trim($password));

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    confirmQuery($select_user_query);

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

        if (password_verify($password, $db_user_password)) {
            $_SESSION['username'] = $db_username;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            // header("Location: ../admin");
            redirect("/php-cms/admin");
        } else {
            // header("Location: ../index.php");
            // redirect("/php-cms/index.php");
            return false;
        }
    }

    // $password = crypt($password, $db_user_password);

    // if ($username === $db_username && $password === $db_user_password) {

}

function loggedInUserId()
{
    if (isLoggedIn()) {
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] . "' ");
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;

        /*if (mysqli_num_rows($result) >= 1) {
            return $user['user_id'];
        }*/
    }

    return false;
}

function userLikedThisPost($post_id)
{
    $result = query("SELECT * FROM likes WHERE user_id=" . loggedInUserId() . " AND post_id=$post_id");
    return mysqli_num_rows($result) >= 1;
}

function getPostLikes($post_id)
{
    $result = query("SELECT * FROM likes WHERE post_id=$post_id");
    confirmQuery($result);
    echo mysqli_num_rows($result);
}

function insertCategories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "<div class='alert alert-danger'>";
            echo "<strong>Oh snap!</strong> ";
            echo "This field should not be empty.</div>";
        } else {
            /*$query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";*/
            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUE(?) ");
            mysqli_stmt_bind_param($stmt, 's', $cat_title);
            mysqli_stmt_execute($stmt);

            // $create_category_query = mysqli_query($connection, $query);

            confirmQuery($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

function findAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        if (!$delete_query) {
            die('Query Failed' . mysqli_error($connection));
        }
        header("Location: categories.php");
    }
}