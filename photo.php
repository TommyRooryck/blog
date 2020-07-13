
<?php require_once ("includes/header.php");?>
<?php

/* $photo = Photo::find_by_id($_GET['id']); //Test object fetching
    echo $photo->title; */

/* if (isset($_POST['submit'])){ //test submit button
    echo "hello"; */

$photo = Photo::find_by_id($_GET['id']);

if (isset($_POST['submit'])){
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo->id, $author, $body);

    if ($new_comment && $new_comment->save()){
    redirect("photo.php?id={$photo->id}");
    }else{
        $message = "There are some problems saving";
    }
}else{
    $author = "";
    $body = "";
}

if (empty($_GET['id'])){
    redirect("index.php");
}




$comments = Comment::find_the_comments($photo->id);

/*
     * We halen het id van de photo uit de url op want dit hebben we nodig om het commentaar aan de photo te koppelen
     * We controleren via een if statement of er wel degelijk een comment aanwezig is en deze gelijktijdig bewaren en tonen door te redirecten naar de photo pagina.
*/


?>



<!-- Page Content -->
<div class="container pb-5">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4"><?php echo $photo->title; ?></h1>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="<?php echo 'admin' . DS . $photo->picture_path(); ?>" width="400" alt="">

            <hr>

            <!-- Post Content -->
            <p>
                <?php echo $photo->description; ?>
            </p>
            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea name="body" rows="3" class="form-control"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            <?php foreach ($comments as $comment) : ?>
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0"><?php echo $comment->author; ?></h5>
                    <p><?php echo $comment->body; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php include ("includes/footer.php"); ?>

