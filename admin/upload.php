<?php include ("includes/header.php"); ?>
<?php  if (!$session->is_signed_in()){
    redirect('login.php');
}


$message = "";
if (isset($_POST['submit'])) {
    $photo = new Photo(); //maak nieuw object
    $photo->title = $_POST['title']; //haal info uit de form en steek het in de property
    $photo->caption = $_POST['caption']; //idem
    $photo->description = $_POST['description']; //idem
    $photo->alternate_text = $_POST['alternate_text']; //idem
    $photo->set_file($_FILES['file']); //voer de setfile() method uit


    if ($photo->save()) {
       /* $message = "Photo uploaded successfully";
        $message_output = "<script type='text/javascript'> alert('$message') </script>";
        echo $message_output; */
        redirect('photos.php');
    } else {
        $message = join("<br>", $photo->errors);
    }

}


?>
<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content-top.php"); ?>



<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="page-header">
                UPLOAD
            </h1>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="caption">Caption:</label>
                    <input type="text" name="caption" class="form-control">
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" name="description" class="form-control">
                </div>

                <div class="form-group">
                    <label for="alternate_text">Alternate text:</label>
                    <input type="text" name="alternate_text" class="form-control">
                </div>

                <div class="form-group">
                    <input type="file" name="file" class="form-control">
                </div>

                <input type="submit" name="submit" value="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>


<?php include ("includes/footer.php"); ?>
