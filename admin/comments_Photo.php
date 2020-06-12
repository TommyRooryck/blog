<?php

require_once ("includes/header.php");
if (!$session->is_signed_in()){
    redirect('login.php');
}
$comments = Comment::find_all();

?>

<?php include "includes/sidebar.php" ;?>
<?php include "includes/content-top.php"; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Comments</h2>
            <td><a href="add_Comment.php" class="btn btn-primary rounded-0"><i class="fas fa-comment-plus"></i>Add Comment</a></td>
            <table class="table table-header">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Body</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($comments as $comment) :
                ?>
                <tr>
                    <td><?php echo $comment->id; ?></td>
                    <td><?php echo $comment->author; ?></td>
                    <td><?php echo $comment->body; ?></td>
                    <td><a href="delete_Comment.php?id=<?php echo $comment->id; ?>" class="btn btn-danger rounded-0"><i class="far fa-trash-alt"></i></a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include ("includes/footer.php")?>

