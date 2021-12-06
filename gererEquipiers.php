<?php
    session_start();
    if($_SESSION["droits"]!="administrateur" and $_SESSION["autoriser"]!="oui"){
        header("location:index.php");
        exit();
    } elseif($_SESSION["droits"]!="administrateur" and $_SESSION["autoriser"]="oui"){
        header("location:agenda.php");
        exit();
    }
    @$mailUtilisateur=$_POST["listUser"];
    @$creneauHeure=$_POST["listCreneaux"];
    @$dateCreneau=strtotime($_POST["dateCreneau"]);
    @$dateCreneau=date('Y-m-d H:i:s', $dateCreneau);
    @$ajouter=$_POST["ajouter"];
    $erreur="";
    if(isset($ajouter)){
        if($mailUtilisateur == "empty") $erreur="Utilisateur non selectionné!";
        elseif($creneauHeure == "empty") $erreur="Horaire non selectionné!";
        elseif(empty($dateCreneau)) $erreur="Date du créneau non selectionné!";
        else{
            include("connexion.php");
            $ins=$pdo->prepare("insert into creneaux(mail,jourCreneau,debutCreneau,finCreneau) values (?,?,?,?)");
            if($creneauHeure == "matin"){
                if($ins->execute(array($mailUtilisateur,$dateCreneau,"7:30","12:30"))){
                    echo 'Créneau ajouté !';
                    header("location:gererEquipiers.php");
                }
            }elseif($creneauHeure == "apres-midi"){
                if($ins->execute(array($mailUtilisateur,$dateCreneau,"12:30","18:30"))){
                    echo 'Créneau ajouté !';
                    header("location:gererEquipiers.php");
                }
            }
        }
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
            <div class="addCreneaux">
                <h3>Ajouter un créneau à un équipier</h3>
                <form name="ajoutEquip" method="post" action="">
                    <select name="listUser">
                        <option value="empty">Selectionner un utilisateur</option>
                        <?php  
                            include("connexion.php");
                            $sel=$pdo->prepare("select Mail,nom,prenom from utilisateurs");
                            $sel->execute();
                            while($pseudo = $sel->fetch()){
                                echo '<option value="'.$pseudo["Mail"].'">'.$pseudo["nom"].' '.$pseudo["prenom"].'</option>';
                            }
                        ?>
                                    
                    </select>
                    <select name="listCreneaux">
                        <option value="empty">Selectionner un créneau</option>
                        <option value="matin">7h30 - 12h30</option>
                        <option value="apres-midi">12h30 - 18h30</option>
                    </select>
                    <input type="date" name="dateCreneau" placeholder="Date de naissance">
                    <input type="submit" name="ajouter" value="Ajouter"/>
                </form>    
                <p><?php echo $erreur ?></p>
            </div>
        </div>
    </body>
</html>