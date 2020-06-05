<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="page-header">
            Variabele titel
            </h1>
            <hr>
            <h2>Connection test</h2>
            <?php
                if ($database->connection)
                {
                    echo "Connection success";
                }
            ?>
            <hr>
            <h2>Ophalen van users</h2>
            <?php

            /**Dit is de PROCEDURELE manier van schrijven.**/
            /*
                $sql = "SELECT * FROM users WHERE id=1";
                $result = $database->query($sql);
                $user_found = mysqli_fetch_array($result);
                echo $user_found["username"];
            */

            /*We vragen hier de object variabele database op van de class, op die manier hebben we toegang tot alle methodes die we daarnet hebben geschreven.*/

            /**Object geörienteerde manier van schrijven**/
            /*
            // MANIER 1
                $user = new User(); //Nieuw object variabele $user van de class User()
                $result = $user->find_all_users(); //We spreken de methode find_all_users() aan van deze klassa waarvan het resultaat in de variabele $result zal bevinden
                while ($row = mysqli_fetch_array($result))
                {
                    echo $row['username'] . "<br>"; //Variabele $result loopen om door de date te doorlopen
                }
                //Hiervoor dienen we eerst een object te creeëren ($user = new User();). Bovenstaande is reeds zeer goede OOP code maar we kunnen dit nog korter schrijven
            */

            //Manier 2: STATIC
            /*
                De statische manier van het gebruik van classes binnen OOP is de manier volgens de laatste standaarden te schrijven.
                Dit wordt zo toegepast in frameworks zoals LARAVEL.
             */

            /*
                $result = User::find_all_users();
                    while ($row = mysqli_fetch_array($result))
                    {
                        echo $row['username'] . "<br>";
                    }
            */

            /*
                * Dit is niet efficiënt eens we met vele velden te werk gaan. Daarom maken we enkele aanpassingen en gaan we d.m.v. de method instantie() met een foreach loop
                  door de objecten gaan lussen.
             */

            $users= User::find_all();
            foreach ($users as $user)
            {
                echo $user->username . "<br>";
            }
            /*
                * We spreken de methode find_all_users() aan uit de class User.
                * Daarna lussen we door alle users.
                * Opmerking: we lussen hier door objecten! M.a.w. vooraleer we het kunnen gebruiken moeten zowel de velden alsook hun waarden per record uit een tabel kunnen lezen.
            */
            ?>

            <hr>
            <h2>Ophalen van een user</h2>
            <?php

            /*
                $result = User::find_user_by_id(1);
                echo $result ['username'];
                //Hier retourneren we steeds arrays. We willen echter geen arrays retourneren maar objecten in OOP (zoals $user->username / $user->id / ...).
            */

            /*
                $result = User::find_user_by_id(1);
                $user = new User();
                $user->id = $result['id'];
                $user->username = $result['username'];
                $user->password = $result['password'];
                $user->first_name = $result['first_name'];
                $user->last_name = $result['last_name'];
                echo $user->username . ' ' . $user->id;
            */

            /*
                 * We voeren de methode find_user_by_id() uit en plaatsen het resultaat in de variabele $result. Tussen de ronde haakjes () voeren we de parameter in, namelijk 1.
                   Dit zorgt ervoor dat de methode naar alle informatie zoekt dat zich in de rij bevindt waar het id gelijkgesteld is aan 1.
                 * Daarna maken we een nieuw object van de klasse User() namelijk $user.
                 * De properties die we hebben aangemaakt in de klasse zijn voor dit object momenteel leeg.
                 * Daarom moeten we de properties invullen met het resultaat die we bekomen d.m.v. de method find_user_by_id(1).
                 * Tussen de vierkante haakjes [] komt welke kolom bij de propertie hoort, zodat de correcte informatie ingevoerd wordt.
                 * Op het einde geven we het object weer op het scherm met de gevraagde properties namelijk de properties username ($user->username) en id ($user->id).
            */

            //Bovenstaande code kan vereenvoudigd worden door een stuk ervan in een method instantie() van de class User()  te gaan gieten. Dan krijgen we het volgende:

                $result = User::find_by_id(1);
                echo $result->username;

            /*
                * In $result zit het volledige resultaat vna de query. Deze object variabele gebruiken we om ons object via de methode instantie() in de User() class in te vullen.
                * De variabele $user bevat bijgevolg het volledige gevulde object die we op een eenvoudige manier kunnen afdrukken op het scherm.
            */
            ?>
            <hr>
            <h2>Toevoegen van een user</h2>
            <?php
            /*
                $user = new User();
                $user->username = "TyeishaV";
                $user->password = "lol";
                $user->first_name = "Tyeisha";
                $user->last_name = "Vansevenhant";

                $user->create();
            */
            ?>
            <hr>
            <h2>Toevoegen van een user via abstracte code: save() methode</h2>
            <?php
            /*
                $user = new User();
                $user->username = "TEST3";
                $user->save();
            */
            ?>
            <hr>
            <h2>Updaten van een user</h2>
            <?php
            /*
                $user=User::find_by_id(8); //Neem alle data die bij id=3 hoort en stop deze in een array. Via de methode instantie() die geïntegreerd is binnen find_user_by_id() wordt $user omgezet in een object.
                $user->last_name = "Williams"; //Doordat $user een object is kunnen we elke propertie aanspreken en er een waarde aan toekennen in dit geval $user->last_name = "Williams"

                $user ->update(); //Voert de update uit via het object met de nieuwe data die we hebben toegekend aan de property.
            */
            ?>
            <hr>
            <h2>Updaten van een user via abstracte code: save() methode</h2>
            <?php
            /*
                $user = User::find_by_id(11);
                $user->username = "Lee";
                $user->save();
             */
            ?>
            <hr>
            <h2>Deleten van een user</h2>
            <?php
            /*
                $user = User::find_by_id(9);
                $user->delete();
            */
            ?>
            <hr>

        </div>
    </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->