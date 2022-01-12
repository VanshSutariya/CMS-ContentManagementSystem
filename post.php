<?php include 'includes/db.php' ?>
<?php include 'includes/header.php' ?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <?php
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];

                // View Count
                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                $send_query = mysqli_query($connection, $view_query);
                if (!$send_query) {
                    die('Query Failed' . mysqli_error($connection));
                }

                $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
                $select_post_by_id = mysqli_query($connection, $query);

                if (!$select_post_by_id) {
                    die('Query Failed : ' . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_assoc($select_post_by_id)) {
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                }

                ?>

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by
                    <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php $date = date_create($post_date);
                    echo date_format($date, "F j, Y"); ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="./images/<?php echo $post_image; ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p><?php echo $post_content; ?></p>

                <hr>

                <?php
            } else {
                header("Location: index.php");
            }
            ?>
            <!-- Blog Comments -->
            <?php
            if (isset($_POST['create_comment'])) {
                $the_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ($the_post_id, '{$comment_author}','{$comment_email}','{$comment_content}', 'unapproved', now()) ";

                    $create_comment_query = mysqli_query($connection, $query);
                    if (!$create_comment_query) {
                        die('Query Failed' . mysqli_error($connection));
                    }

                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    $query .= "WHERE post_id = $the_post_id ";
                    $update_comments_count = mysqli_query($connection, $query);
                    if (!$update_comments_count) {
                        die('Query Failed' . mysqli_error($connection));
                    }
                } else {
                    echo "<script>alert('Fields cannot be empty!')</script>";
                }
            }
            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="comment_author">Name</label>
                        <input type="text" class="form-control" name="comment_author" id="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" class="form-control" name="comment_email" id="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Comment</label>
                        <textarea class="form-control" rows="3" id="comment_content" name="comment_content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comment_query = mysqli_query($connection, $query);

            if (!$select_comment_query) {
                die('Query Failed' . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];

                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img width="64" class="img-thumbnail img-circle" src="./images/profile.png">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php $date = date_create($comment_date);
                                echo date_format($date, "F j, Y"); ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>


        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include 'includes/footer.php' ?>
