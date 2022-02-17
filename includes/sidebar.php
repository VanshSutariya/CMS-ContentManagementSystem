<?php
if (ifItIsMethod('post')) {
    if (isset($_POST['login'])) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            loginUser($_POST['username'], $_POST['password']);
        } else {
            redirect('/php-cms/index.php');
        }
    }
}
?>

<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="/php-cms/search.php" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <div class="well">
        <?php if (isset($_SESSION['user_role'])): ?>
            <h4>Logged in as <?php echo ucwords($_SESSION['username']) ?></h4>
            <a href="/php-cms/includes/logout.php" class="btn btn-danger">Logout</a>
        <?php else: ?>

            <form method="POST">
                <p>Username : admin & Password : admin</p>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-default" name="login">Submit</button>
                <div style="color: #919191; padding: 10px 20px;">
                    <p>forgot your password? <a href="/php-cms/forgot.php?forgot=<?php echo uniqid(true) ?>">click
                            here</a></p>
                    <p>new user? <a href="./registration.php">create new account</a></p>
                </div>
            </form>

        <?php endif; ?>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM categories LIMIT 4";
                    $select_categories_sidebar = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?category=$cat_id'>$cat_title</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include 'widget.php'; ?>

</div>