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
            <div class="boiteAcreneaux">    
                <div class="creneaux">
                    <h3>Mardi 6 Octobre</h3>
                    <div class="horaire">
                        <h4>-- 8h30 --</h4>
                        <p>COTIER Alexandre</p>
                        <p>Adrien Autef</p>
                        <h4>-- 12h30 --</h4>
                    </div>
                    <div class="horaire">
                        <h4>-- 12h30 --</h4>
                        <p>COTIER Alexandre</p>
                        <p>Adrien Autef</p>
                        <h4>-- 18h30 --</h4>
                    </div>
                </div>
                <div class="creneaux">
                    <h3>Mercredi 7 Octobre</h3>
                    <div class="horaire">
                        <h4>-- 8h30 --</h4>
                        <p>COTIER Alexandre</p>
                        <p>Adrien Autef</p>
                        <h4>-- 12h30 --</h4>
                    </div>
                    <div class="horaire">
                        <h4>-- 12h30 --</h4>
                        <p>COTIER Alexandre</p>
                        <p>Adrien Autef</p>
                        <h4>-- 18h30 --</h4>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>