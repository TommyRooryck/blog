<?php include ("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}

if (empty($_GET['id'])){
    redirect('comments.php');
}

$comment = comment::find_by_id($_GET['id']);
if ($comment){
    $comment->delete();
    redirect('comments.php');
} else{
    redirect('comments.php');
}
?>

<?php include ("includes/sidebar.php");?>
<?php include  ("includes/content-top.php"); ?>
<?php include ("includes/footer.php");
