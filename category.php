<?php include 'includes/db.php' ?>
<?php include 'includes/header.php' ?>

    <!-- Navigation -->
<?php include 'includes/navigation.php' ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if (isset($_GET['category'])) {
                $the_category_id = $_GET['category'];

                /*if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {*/
                if (isAdmin($_SESSION['username'])) {
                    // $query = "SELECT * FROM posts WHERE post_category_id = {$the_category_id} ";
                    $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? ");
                } else {
                    $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ");
                    $published = 'published';
                }

                // $select_all_posts_query = mysqli_query($connection, $query);

                if (isset($stmt1)) {
                    mysqli_stmt_bind_param($stmt1, "i", $the_category_id);
                    mysqli_stmt_execute($stmt1);
                    mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

                    $stmt = $stmt1;
                } else {
                    mysqli_stmt_bind_param($stmt2, "is", $the_category_id, $published);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

                    $stmt = $stmt2;
                }

                /*if (!$select_all_posts_query) {
                    die('Query Failed : ' . mysqli_error($connection));
                }*/

                /*if (mysqli_num_rows($select_all_posts_query) < 1) {*/
                if (mysqli_stmt_num_rows($stmt) === 0) {
                    echo "<h4 class='text-muted'>No Posts, Please login to see draft posts.</h4>";
                } /*else {*/

                /*while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 200);*/
                while (mysqli_stmt_fetch($stmt)) :
                    ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by
                        <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo ucwords($post_author); ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted
                        on <?php $date = date_create($post_date);
                        echo date_format($date, "F j, Y"); ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>"
                         alt="<?php echo $post_title; ?>">
                    <hr>
                    <p><?php echo $post_content; ?></p>

                    <hr>

                <?php
                endwhile;
                mysqli_stmt_close($stmt);
                /*}*/
            } else {
                header("Locations: index.php");
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include 'includes/footer.php' ?>