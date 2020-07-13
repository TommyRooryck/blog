<?php
include("includes/header.php");


$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
//Wanneer er een page id in de url staat dan halen we die eruit zodat we weten op welke pagina we ons bevinden. In het andere geval tonen we altijd pagina 1

$items_per_page = 8;
// Toont het aantal items die we wensen te zien per pagina

$items_total_count = Photo::count_all();
//Telt het aantal photos in de database.

$paginate = new Paginate($page, $items_per_page, $items_total_count);
//Wordt gevuld met de bovenstaande items. Die worden doorgegeven aan de Paginate.php class voor verdere verwerking in de methodes.

$sql = "SELECT * FROM photos LIMIT {$items_per_page} OFFSET {$paginate->offset()}";
$photos = Photo::find_this_query($sql);

//$photos = Photo::find_all(); //We kunnen dit uitvoeren omdat init.php included is in de header.php die hier included is
?>
<body>
<div class="container-fluid pb-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mx-auto text-center py-5">Homepage: Photos</h1>
            <hr>
            <div class="row d-flex justify-content-around mx-auto flex-wrap">
                <?php foreach ($photos as $photo) : ?>
                    <div class="card m-3">
                        <img src="<?php echo 'admin' . DS . $photo->picture_path(); ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $photo->title; ?></h5>
                            <p class="card-text"><?php echo $photo->caption; ?> </p>
                            <a href="photo.php?id=<?php echo $photo->id; ?>" class="btn btn-primary w-100 align-items-end">View Photo</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row flex-row ">
                <div class="col-lg-12 d-flex justify-content-center">
                    <div class="col-lg-2">
                        <ul class="pager d-flex flex-fill">
                            <?php

                                echo "<li class='previous flex-fill'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";


                            for ($i = 1; $i <= $paginate->page_total(); $i++) {
                                if ($i == $paginate->current_page) {
                                    echo "<li class='active flex-fill'><a href='index.php?page={$i}'>{$i}</a></li>";
                                } else {
                                    echo "<li class='flex-fill'><a href='index.php?page={$i}'>{$i}</a></li>";
                                }
                            }



                                    echo "<li class= 'next flex-fill'> <a href='index.php?page={$paginate->next()}'>Next</a></li>";



                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


<?php include("includes/footer.php"); ?>
