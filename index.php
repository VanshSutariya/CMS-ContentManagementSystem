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
            $per_page = 3;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }

            $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);

            if ($count < 1) {
                echo "<h4 class='text-muted'>No Posts, Please login to see draft posts.</h4>";
            } else {

                $count = ceil($count / $per_page);

                $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
                $select_all_posts_query = mysqli_query($connection, $query);

                if (!$select_all_posts_query) {
                    die('Query Failed' . mysqli_error($connection));
                }

                /*if (mysqli_num_rows($select_all_posts_query) == 0) {
                    echo "<h1 class='text-center'>No Post Found 😒</h1>";
                }*/

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    // $post_author = $row['post_author'];
                    $post_author = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 200);
                    // $post_status = $row['post_status'];

                    /*if ($post_status !== 'published') {
                        echo "<h1 class='text-center'>No Post Found 😒</h1>";
                    } else {*/

                    ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by
                        <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo ucwords($post_author); ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php $date = date_create($post_date);
                        echo date_format($date, "F j, Y"); ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id ?>">
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>"
                             alt="<?php echo $post_title; ?>">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <hr>

                    <?php
                    // }
                }
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Pagination -->
    <ul class="pagination">
        <?php
        for ($i = 1; $i <= $count; $i++) {
            if ($i == $page) {
                echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>
    </ul>

<?php include 'includes/footer.php' ?>