<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php
echo password_hash('secret', PASSWORD_DEFAULT, array('cost' => 12));
echo "<hr/>";
echo loggedInUserId();
