<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php

if (isset($_POST['submit'])) {

    $to = "majhirockzz.me@gmail.com";
    $subject = wordwrap($_POST['subject'], 70);
    $body = $_POST['body'];
    $header = "From: " . $_POST['email'];

    mail($to, $subject, $body, $header);
}
?>

    <!-- Navigation -->

<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="text-center">

                                    <h2 class="text-center">Contact</h2>

                                    <form role="form" action="contact.php" method="post" id="login-form"
                                          autocomplete="off">
                                        <div class="form-group">
                                            <label for="email" class="sr-only">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                   placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="subject" class="sr-only">Subject</label>
                                            <input type="subject" name="subject" id="subject" class="form-control"
                                                   placeholder="Subject">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="body" id="body" placeholder="Message"></textarea>
                                        </div>

                                        <input type="submit" name="submit" id="btn-login"
                                               class="btn btn-lg btn-primary btn-block"
                                               value="Submit">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>

        <hr>

<?php include "includes/footer.php"; ?>