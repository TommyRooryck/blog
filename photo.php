<?php include ("includes/header.php");?>
<?php require_once ("admin/includes/init.php");

/* $photo = Photo::find_by_id($_GET['id']); //Test object fetching
    echo $photo->title; */

/* if (isset($_POST['submit'])){ //test submit button
    echo "hello"; */

if (empty($_GET['id'])){
    redirect("index.php");
}

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

            <!-- Author -->
            <p class="lead">
                by
                <a href="#">Start Bootstrap</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p>Posted on January 1, 2019 at 12:00 PM</p>

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

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">Web Design</a>
                                </li>
                                <li>
                                    <a href="#">HTML</a>
                                </li>
                                <li>
                                    <a href="#">Freebies</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="#">JavaScript</a>
                                </li>
                                <li>
                                    <a href="#">CSS</a>
                                </li>
                                <li>
                                    <a href="#">Tutorials</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Side Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
<?php include ("includes/footer.php"); ?>

