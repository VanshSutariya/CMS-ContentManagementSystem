<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>UnApprove</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM comments";
    $select_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = substr($row['comment_content'], 0, 40);
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_content} ...</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_status}</td>";

        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
        $select_posts_id = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts_id)) {
            $post_title = $row['post_title'];
            echo "<td>{$post_title}</td>";
        }

        echo "<td>{$comment_date}</td>";
        echo "<td><a href=''>Approve</a></td>";
        echo "<td><a href=''>UnApprove</a></td>";
        echo "<td><a href=''>Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);

    confirmQuery($delete_query);
    header("Location: posts.php");
}
?>