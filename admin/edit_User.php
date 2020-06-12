<?php

include ("includes/header.php");



if (!$session->is_signed_in()){
    redirect("login.php");
}

if (empty($_GET['id'])){
    redirect('users.php');
}

$user = User::find_by_id($_GET['id']);
if (isset($_POST['update_user'])){
    if ($user){
        $user->username = trim($_POST['username']);
        $user->password = trim($_POST['password']);
        $user->first_name = trim($_POST['first_name']);
        $user->last_name= trim($_POST['last_name']);

        if (empty($_FILES['image'])){ //Als er geen nieuwe image is gekozen: voer enkel een save() uit
            $user->save();
        } else{ //Als er een nieuwe image is gekozen:
            $user->set_file($_FILES['image']); //set_file() method met de nieuw gekozen image uit de form
            $user->save_user_and_image();
            $user->save();
            redirect("users.php");
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
        <div class="col-12">
            <h1>Edit User</h1>
            <form action="edit_User.php?id=<?php echo $user->id; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                        </div>
                        <div class="form-group">
                            <label for="image">User Image</label> <br>
                            <img src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""  height="100" >
                            <input type="file" name="image" class="form-control"">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                        </div>
                        <a href="delete_User.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Delete User</a>
                        <input type="submit" name="update_user" value="Update User" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
