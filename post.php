<?php include 'includes/db.php' ?>
<?php include 'includes/header.php' ?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<?php
if (isset($_POST['liked'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    // 1. FETCHING RIGHT POST
    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $postResult = mysqli_query($connection, $query);
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];

    /*if (mysqli_num_rows($postResult) >= 1) {
        echo $post['post_id'];
    }*/

    // 2. UPDATE POST WITH LIKES (Increment)
    mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id=$post_id");

    // 3. CREATE LIKES FOR POST
    mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
    exit();
}

if (isset($_POST['unliked'])) {

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    // 1. FETCHING RIGHT POST
    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $postResult = mysqli_query($connection, $query);
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];

    /*if (mysqli_num_rows($postResult) >= 1) {
        echo $post['post_id'];
    }*/

    // 2. DELETE LIKES
    mysqli_query($connection, "DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id");

    // 3. UPDATE POST WITH LIKES (Decrement)
    mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id=$post_id");

    // 4. CREATE LIKES FOR POST
    // mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
    exit();
}
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">
            <?php
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];

                if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                    // View Count
                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                    $send_query = mysqli_query($connection, $view_query);
                    if (!$send_query) {
                        die('Query Failed' . mysqli_error($connection));
                    }

                }

                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                } else {

                    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} AND post_status = 'published' ";
                }

                $select_post_by_id = mysqli_query($connection, $query);

                if (!$select_post_by_id) {
                    die('Query Failed : ' . mysqli_error($connection));
                }

                if (mysqli_num_rows($select_post_by_id) < 1) {
                    echo "<h4 class='text-muted'>No Posts, Please login to see draft posts.</h4>";
                } else {

                    while ($row = mysqli_fetch_assoc($select_post_by_id)) {
                        $post_id = $row['post_id'];
                        // $post_author = $row['post_author'];
                        $post_author = $row['post_user'];
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
                        <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo ucwords($post_author); ?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php $date = date_create($post_date);
                        echo date_format($date, "F j, Y"); ?></p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-responsive" src="/php-cms/images/<?php echo imagePlaceholder($post_image); ?>"
                         alt="">

                    <hr>

                    <!-- Post Content -->
                    <p><?php echo $post_content; ?></p>

                    <hr>

                    <?php
                    if (isLoggedIn()) {
                        ?>
                        <div class="row">
                            <p class="pull-right"><a class="like" href="#" data-toggle="tooltip" data-placement="top"
                                                     title="Like this post"><span
                                            class="glyphicon glyphicon-thumbs-up"></span>
                                    Like</a>
                            </p>
                        </div>

                        <div class="row">
                            <p class="pull-right"><a class="unlike" href="#" data-toggle="tooltip" data-placement="top"
                                                     title="Unlike this post"><span
                                            class="glyphicon glyphicon-thumbs-down"></span>
                                    Unlike</a>
                            </p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="row">
                            <p class="pull-right">You need to <a href="/php-cms/login.php">Login</a> to like.</p>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <p class="pull-right">Like: <?php getPostLikes($post_id); ?></p>
                    </div>

                    <div class="clearfix"></div>

                    <!-- Blog Comments -->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

                                /* $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                                $query .= "WHERE post_id = $the_post_id ";
                                $update_comments_count = mysqli_query($connection, $query); */


                                /*if (!$update_comments_count) {
                                    die('Query Failed' . mysqli_error($connection));
                                }*/
                            } else {
                                echo "<script>alert('Fields cannot be empty!')</script>";
                            }
                        }
                    }
                    ?>

                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form action="" method="post" role="form">
                            <input type="hidden" value="<?php isset($the_post_id) ?? null ?>">

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
                                <textarea class="form-control" rows="3" id="comment_content"
                                          name="comment_content"></textarea>
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
                                <img width="64" class="img-thumbnail img-circle" src="/php-cms/images/profile.png">
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
                }
            } else {
                header("Location: index.php");
            }
            ?>
        </div>


        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include 'includes/footer.php' ?>

    <script>
        $(document).ready(function () {
            $("[data-toggle='tooltip']").tooltip();

            var post_id = <?php echo $the_post_id; ?>;
            var user_id = <?php echo loggedInUserId(); ?>;

            // LIKING
            $('.like').click(function () {
                // console.log("It Works!")
                $.ajax({
                    url: "/php-cms/post.php?p_id=<?php echo $the_post_id; ?>",
                    type: 'post',
                    data: {
                        'liked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                })
            });

            // UNLIKING
            $('.unlike').click(function () {
                // console.log("It Works!")
                $.ajax({
                    url: "/php-cms/post.php?p_id=<?php echo $the_post_id; ?>",
                    type: 'post',
                    data: {
                        'unliked': 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                })
            });
        })
    </script>
