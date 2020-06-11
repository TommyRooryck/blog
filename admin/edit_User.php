<?php

include ("includes/header.php");



if (!$session->is_signed_in()){
    redirect("login.php");
}

$user= new User(); //Creëer een niewe instantie van het object user met de naam $user
if (isset($_POST['submit'])){
    if ($user){
        $user->username = trim($_POST['username']);
        $user->password = trim($_POST['password']);
        $user->first_name = trim($_POST['first_name']);
        $user->last_name= trim($_POST['last_name']);
        $user->set_file($_FILES['image']);
        $user->save_user_and_image();
        redirect('users.php');
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
            <h1>Add User</h1>
            <form action="add_User.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="file">User Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                        <input type="submit" name="submit" value="Add User" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include("includes/footer.php"); ?>
