<?php

require_once ("includes/header.php");

if (!$session->is_signed_in()){
    redirect("login.php");
}
//$photos = Photo::find_all();
if (empty($_GET['id'])){
    redirect("photos.php");
}else{
    $photo = Photo::find_by_id($_GET['id']);
    if (isset($_POST['update'])){
        if ($photo){
            $photo->title = trim($_POST['title']);
            $photo->description = trim($_POST['description']);
            $photo->caption = trim($_POST['caption']);
            $photo->alternate_text = trim($_POST['alternate_text']);
            $photo->
            $photo->update();
            redirect('photos.php');
        }
    }
}


/*
     * Eerst controleren we of de parameter id die binnen komt niet leeg is.
     * Wanneer dit leeg is, verwijzen we onmiddelijk terug naar de photos.php pagina.
     * In het ander geval gebruiken we de method find_by_id() die een query uitvoert in de database en het resultaat in de object variabele $photo steekt.
     * Het updaten zal kunnen gebeuren wanneer een gebruiker in het formulier op de update button klikt.
     * In de object variabele $photo wordt nu ieder veld gevuld met de global post variabelen die werden overgedragen uit het formulier.
     * Op die manier kunnen we terug gebruiken maken van onze object variabelen in het verder verloop van onze pagina.
     * We voegen hier ook de update functie toe om de wijzigingen van het formulier weg te schrijven naar de database.
*/
?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/content-top.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-13">
            <h1>Edit Page</h1>
            <form action="edit_Photo.php?id=<?php  echo $photo->id; ?>" method="post">
                <div class="row">
                    <div class="col-8 col-md-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                        </div>
                        <div class="form-group">
                            <a href="#" class="thumbnail"><img src="<?php echo $photo->picture_path(); ?> " height="100"
                                                               alt=""></a>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="" cols="30" rows="10"
                                      class="form-control"><?php echo $photo->description; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" name="caption" class="form-control"
                                   value="<?php echo $photo->caption ?>">
                        </div>

                        <div class="form-group">
                            <label for="alternate_text">Alternate text</label>
                            <input type="text" name="alternate_text" class="form-control"
                                   value="<?php echo $photo->alternate_text; ?>">
                        </div>
                    </div>

                    <div class=" col-12 col-md-4">
                        <div class="photo-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="fas fa-arrow-up"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="fas fa-calendar">Uploaded on: April 01, 2020 @ 5:26</span>
                                    </p>
                                    <p class="text font-weight-bold">
                                         Photo Id: <span class="data photo_id_box font-weight-normal"> <?php echo $photo->id; ?></span>
                                    </p>
                                    <p class="text font-weight-bold">
                                        Filename:   <span class="data font-weight-normal"><?php echo $photo->filename; ?></span>
                                    </p>
                                    <p class="text font-weight-bold">
                                        Filetype:  <span class="data font-weight-normal"><?php echo $photo->type; ?></span>
                                    </p>
                                    <p class="text font-weight-bold">
                                        File Size: <span class="data font-weight-normal"> <?php echo $photo->size; ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer">
                                    <div class="info-box-delete float-left">
                                        <a href="delete_Photo.php?id=<?php echo $photo->id; ?>"
                                           class="btn btn-danger btn-lg">Delete</a>
                                    </div>
                                    <div class="info-box-update float-right">
                                        <input type="submit" name="update" value="Update"
                                               class="btn btn-primary btn-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
