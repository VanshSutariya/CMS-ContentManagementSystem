<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php
echo password_hash('secret', PASSWORD_DEFAULT, array('cost' => 12));
echo "<hr/>";
echo loggedInUserId();
echo "<hr/>";
if (userLikedThisPost(152)) {
    echo "USER LIKED IT";
} else {
    echo "DID NOT LIKE IT";
}
