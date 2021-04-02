<?php
//include auth_session.php file on all user panel pages
require('../functions/authenticate.php');
include_once('../functions/connectsqlbase.php');
include_once('../functions/short_url.php');
include_once('../functions/delete_link.php');
include_once('../functions/deactivate.php');
include_once('../functions/activate.php');
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Dashboard - Client area</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
    <header>
        <div class="page_sec">
        <p>Page Utilisateur</p>
        </div>
        <div class="utilisateur_sec">
        <p>Bienvenue <?php echo $_SESSION['pseudo']; ?></p>
        <p><a href="../functions/logout.php">Déconnecter</a></p>
        </div>
    </header>
    <form name="links" method="post" class="add_links">
        <p>Entrez votre lien</p>
        <?php
        function invalide_url () {
            echo("<div class='false_url'>");
            echo("<p style='color: #a01414; text-align: center'>Cette URL est invalide</p>");
            echo("</div>");
        }
        ?>
        </br>
        <input type="text" name="link"/> <br/>
        <input type="submit" name="valider_link" value="OK"/>
    </form>
    <?php
    $base = connectMaBase();
    $user_id = ($_SESSION["user_id"]);
    $sql = 'SELECT long_url, short_url, id_link, state, views FROM user_links WHERE id_user ='.$user_id.';';
    $result = $base->query($sql); #Récupère les liens de l'utilisateur
    ?>
    <div class="liens_utilisateur">
        <?php
        $link = "http://localhost/urlshort_KELLER_H2/l.php/";
        while($row = mysqli_fetch_array($result)){   #Créer une boucle pour afficher les données récupérées  dans la bdd
            $short_url_sql =  $row['short_url'];
            $url = $link.$short_url_sql;
            $id_link = $row['id_link'];
            $state = $row['state'];
            $views = $row['views'];
            echo "<div class='linkstxt_urls_sec'>"; #Echo pour écrire dans le html, gérer le css plus tard et afficher
            echo "<p class='border_urltxt'>"."URL d'origine"."</p>"; #Les données récupérées
            echo "<p>". $row['long_url']."</p>";
            echo "<p class='border_urltxt'>" ."SHORT URL "."</p>";
            echo "<p>" ."<a target='_blank' href='$url'>". $link. $row['short_url'] ."</a></p>";
            echo "</div>";

            echo "<div class='buttons_urls'>";
            echo "<form name='delete' methode='post'>"."<input type='hidden' name='id_link' value='$id_link'/>"."<input type='submit' name='valider_delete' value='Supprimer'>"."</form>";

            if ($state == 1) { #Affiche le bouton activé ou désactiver en fonction de l'état du bouton sur la bdd
            echo "<form name='deactivate' methode='post'>"."<input type='hidden' name='id_deactivate' value='$id_link'/>"."<input type='submit' name='valider_deactivate' value='Désactiver'>"."</form>";
        } else {
                echo "<form name='activate' methode='post'>"."<input type='hidden' name='id_activate' value='$id_link'/>"."<input type='submit' name='valider_activate' value='Activer'>"."</form>";
            }
            echo "</div>";
            #Affiche le nomre de vues
            echo "<div class='viewscounter'>";
            echo "<p class=''>"."Nombre de vues"."</p>";
            echo "<p>".$views."</p>";
            echo "</div>";

            echo "<div class='line_separation'>";
            echo "</div>";
        }
        $base->close();
        ?>
    </div>
    </body>
    </html>

<?php
if (isset ($_POST['valider_link'])){
    add_link_bdd();
}

if (isset ($_REQUEST['valider_delete'])){
    delete_url();
}

if (isset ($_REQUEST['valider_deactivate'])){
    deactivate_url();
}

if (isset ($_REQUEST['valider_activate'])){
    activate_url();
}
?>

<style>
    body{
        margin: 0 auto;
        height: 100vh;
        width: 100vw;
        font-family: 'Roboto', sans-serif;
        background-color: #945abd;;
    }
    header {
        display: flex;
    }

    .page_sec{
        width: 50vw;
    }

    .page_sec p{
        font-size: 2em;
        font-weight: bold;
        margin-left: 1em;
    }

    .utilisateur_sec{
        display: flex;
        align-self: center;
        justify-content: flex-end;
        width: 50vw;
        font-size: 1.4em
    }

    .utilisateur_sec p{
        color: black;
        padding-right: 4em;
        align-self: center;
    }

    .utilisateur_sec a{
        transition: 0.2s;
        color: white;
        padding-right: 1em;
        text-decoration: none;
        font-size: 1.2em;
    }

    .utilisateur_sec a:hover{
        transition: 0.2s;
        color: #df95f8;
    }

    .add_links{
        text-align: center;
        margin-top: 4em;
    }

    .add_links p{
        color: white;
        font-size: 2em;
    }

    input[type=text] {
        font-size: 1.2em;
        width: 60%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 4px solid #c172ea;
        border-radius: 4px;
        background-color: #d680f2;
        color: white;
    }

    input[type=submit] {
        transition: 0.2s;
        font-size: 1.5em;
        margin-top: 2em;
        padding: 5px 15px;
        background: darkorange;
        border: 0 none;
        cursor: pointer;
        color: white;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }

    input[type=submit]:hover {
        transition: 0.2s;
        background: #9600ff;
    }

    .linkstxt_urls_sec{
        margin-top: 4em;
        text-align: center;
        font-size: 1.2em;
    }

    .border_urltxt{
        font-size: 1em;
        margin: auto;
        width: 8em;
        border-style: solid;
        border-color: #9600ff;
        padding: 10px;
    }

    .buttons_urls{
        margin: auto;
        display: flex;
        justify-content: space-evenly;
        width: 25em;
    }

    .viewscounter{
        margin: auto;
        text-align: center;
        width: 25em;
        color: white;
    }

    .line_separation{
        width: 75vw;
        margin: auto;
        background-color: white;
        height: 1px;
    }

    a:link {
        transition: 0.2s;
        color: white;
    }

    a:link:hover {
        color: white;
        transition: 0.2s;
        color: #df95f8;
        text-decoration: none;
    }

    a:visited {
        transition: 0.2s;
        color: white;
    }

    a:visited:hover {
        color: white;
        transition: 0.2s;
        color: #df95f8;
        text-decoration: none;
    }

    .false_url{
        position: relative;
        bottom:34.5em;
    }
</style>
