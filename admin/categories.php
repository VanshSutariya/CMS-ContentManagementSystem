<?php include 'includes/admin_header.php'; ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo ucfirst($_SESSION['username']); ?></small>
                    </h1>
                    <div class="col-xs-6">
                        <?php insertCategories($_SESSION['user_id'] ? $_SESSION['user_id'] : 0); ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title" id="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php // UPDATE AND INCLUDE QUERY
                        if (isset($_GET['edit'])) {
                            $cat_id = $_GET['edit'];
                            include 'includes/update_categories.php';
                        }
                        ?>
                    </div>

                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th><i class="fa fa-fw fa-edit fa-lg"></i></th>
                                    <th><i class="fa fa-fw fa-trash fa-lg"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php findAllCategories(); ?>

                                <?php deleteCategories(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include 'includes/admin_footer.php'; ?>