<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php
/*if (!isset($_GET['email']) && !isset($_GET['token'])) {
    redirect('/php-cms/index');
}*/

$token = '67c30c7ef3dbaef1b672b524a1c69cf82ed20b588f40c514bcb31b5eaf1e034b75264c473f80f276cdecc2c6f5216acc81e4';

if ($stmt = mysqli_prepare($connection, 'SELECT username, user_email, token FROM users WHERE token=?')) {
    mysqli_stmt_bind_param($stmt, 's', $token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    /*if ($_GET['token'] !== $token || $_GET['email'] !== $email) {
        redirect('/php-cms/index');
    }*/
}
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-lock color-blue"></i></span>
                                            <input id="password" name="password" placeholder="Enter Password"
                                                   class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"
                                                   class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="resetPassword" class="btn btn-lg btn-primary btn-block"
                                               value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->

