<?php
if (isset($_POST['create_post'])) {
    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category']);
    $post_user = escape($_POST['post_user']);
    $post_status = escape($_POST['post_status']);

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    // $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_user}',now() ,'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}' ) ";

    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);

    $the_post_id = mysqli_insert_id($connection);

    echo "<p class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              <strong>Post Created.</strong> <a href='../post.php?p_id={$the_post_id}'>View Post</a>
          </p>";

    // header("Location: posts.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" id="title" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_user">Users</label>
        <select name="post_user" id="post_user" class="form-control">
            <?php
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            confirmQuery($select_users);

            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo "<option value='{$username}'>{$username}</option>";
            }
            ?>
        </select>
    </div>

    <!--<div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" id="author" class="form-control" name="author">
    </div>-->

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select id="post_status" class="form-control" name="post_status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" id="post_image" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" id="post_tags" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" id="summernote" name="post_content" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>