<?php

require_once ("includes/header.php");
if (!$session->is_signed_in()){
    redirect('login.php');
}
$comments = Comment::find_all();

?>

<?php include "includes/sidebar.php" ;?>
<?php include "includes/content-top.php"; ?>

