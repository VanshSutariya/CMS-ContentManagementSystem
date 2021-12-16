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

        confirmQuery($select_posts_id);

        while ($row = mysqli_fetch_assoc($select_posts_id)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
        }

        echo "<td>{$comment_date}</td>";
        echo "<td><a href=''>Approve</a></td>";
        echo "<td><a href=''>UnApprove</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_comment_query = mysqli_query($connection, $query);

    confirmQuery($delete_comment_query);

    header("Location: comments.php");
}
?>