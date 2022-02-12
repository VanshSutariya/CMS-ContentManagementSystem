<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/php-cms/index">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--<li class="dropdown">-->
                <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                    Post Category <span class="caret"></span></a>-->
                <!--<ul class="dropdown-menu">-->
                <?php
                /*$query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                }*/
                ?>
                <?php
                $query = "SELECT * FROM categories LIMIT 3";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    $category_class = '';
                    $registration_class = '';
                    $contact_class = '';

                    $pageName = basename($_SERVER['PHP_SELF']);

                    $registration = 'registration.php';
                    $contact = 'contact.php';

                    if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
                        $category_class = 'active';
                    } else if ($pageName == $registration) {
                        $registration_class = 'active';
                    } else if ($pageName == $contact) {
                        $contact_class = 'active';
                    }

                    /*echo "<li class='$category_class'><a href='category.php?category=$cat_id'>$cat_title</a></li>";*/

                    echo "<li class='$category_class'><a href='/php-cms/category/$cat_id'>$cat_title</a></li>";

                }
                ?>
                <!--</ul>-->
                <!--</li>-->

                <?php if (isset($_SESSION['user_role'])): ?>
                    <li><a href="/php-cms/admin">Admin</a></li>
                <?php endif; ?>
                <li class="<?php echo $contact_class; ?>"><a href="/php-cms/contact.php">Contact</a></li>
                <?php if (!isset($_SESSION['user_role'])): ?>
                    <li class="<?php echo $registration_class; ?>"><a href="/php-cms/registration">Registration</a></li>
                <?php endif; ?>
                <?php
                if (isset($_SESSION['user_role'])) {
                    if (isset($_GET['p_id'])) {
                        $the_post_id = $_GET['p_id'];
                        echo "<li><a href='/php-cms/admin/posts.php?source=edit_post&p_id=$the_post_id'>Edit Post</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>