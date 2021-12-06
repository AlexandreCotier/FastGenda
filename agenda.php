<?php
    session_start();
    if($_SESSION["autoriser"]!="oui"){
        header("location:index.php");
        exit();
    }elseif($_SESSION["droits"]=="administrateur"){
        header("location:agendaAdmin.php");
        exit();
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <header>
            <h1>FastGenda</h1>
            <ul>
            <?php if($_SESSION["droits"]=="administrateur") echo '<li><a href="agendaAdmin.php">Mon Planning</a></li>';
                    else echo '<li><a href="agenda.php">Mon Planning</a></li>'; ?>
                <?php if($_SESSION["droits"]=="administrateur") echo '<li><a href="gererEquipiers.php">Gérer ses équipiers</a></li>'; ?>
                <li><a href="#">Déclarer une absence</a></li>
                <li><a href="deconnexion.php">Deconnexion</a></li>
            </ul>
        </header>
        <div class="corps">
            <h3>Mes prochains shifts :</h3>
            <div class="boiteAcreneaux">    
                
                    <?php
                        include("connexion.php");
                        $sel=$pdo->prepare("select jourCreneau,debutCreneau,finCreneau from creneaux where mail=?");
                        $sel->execute(array($_SESSION["email"]));
                        while($infos = $sel->fetch()){
                            echo '<div class="creneaux">
                                    <h3>'.$infos["jourCreneau"].'</h3>
                                    <div class="horaire">
                                    <h4>-- '.$infos["debutCreneau"].' - '.$infos["finCreneau"].' --</h4>
                                    </div>
                                    </div>';
                        }
                    ?>
            </div>
        </div>
    </body>
</html>