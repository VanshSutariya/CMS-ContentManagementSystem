<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        // $user_date = $row['user_date'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";
        echo "<td><a href=''>Approve</a></td>";
        echo "<td><a href=''>UnApprove</a></td>";
        echo "<td><a href=''>Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection, $query);
    confirmQuery($approve_comment_query);
    header("Location: comments.php");
}

if (isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
    $unapprove_comment_query = mysqli_query($connection, $query);
    confirmQuery($unapprove_comment_query);
    header("Location: comments.php");
}

if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_comment_query = mysqli_query($connection, $query);
    confirmQuery($delete_comment_query);

    // TEST: UPDATE POST_COMMENT COUNT
    $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
    $query .= "WHERE post_id = $comment_post_id";
    $update_comments_count = mysqli_query($connection, $query);
    confirmQuery($update_comments_count);

    header("Location: comments.php");
}
?>