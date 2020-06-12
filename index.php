<?php
include ("includes/header.php");
$photos = Photo::find_all(); //We kunnen dit uitvoeren omdat init.php included is in de header.php die hier included is
?>

<div class="container-fluid pb-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mx-auto text-center py-5">Homepage: Photos</h1>
            <div class="row d-flex justify-content-around mx-auto flex-wrap">
            <?php foreach ($photos as $photo) : ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo 'admin' .DS . $photo->picture_path(); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $photo->title; ?></h5>
                        <p class="card-text"><?php echo $photo->caption; ?> </p>
                        <a href="photo.php?id=<?php echo $photo->id; ?>"  class="btn btn-primary">View Photo</a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include ("includes/footer.php"); ?>
