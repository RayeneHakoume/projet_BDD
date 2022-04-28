<? require_once("./header.php");
    require_once("./database.php");



$id="root";
echo '<div class="row">
                <h3><strong></strong><a href="index.php?id='.$id.'"class="btn btn-success btn-lg"><span class="glyphicon glyphicon-menu-left
                "></span> Retour</a></h>
                <table class="table table table-bordered">
                  <thead>
                    <tr>
                      <th>Utilisateur</th>
                      <th>Nom</th>
                      <th>Nombre de contenu cachés</th>
                    </tr>
                  </thead>
                  <tbody>';
$db=DataBase::connect();
$contenuVisible=$db->query('SELECT Utilisateurs.*, COUNT(visible) AS nbV FROM Photo JOIN Utilisateurs ON Photo.uId=Utilisateurs.uId WHERE visible="Non" GROUP BY Utilisateurs.uId');


while($element = $contenuVisible->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $element['nomU'] . '</td>';
                            echo '<td>'. $element['nom'] . '</td>';
                            echo '<td>'. $element['nbV'] . '</td>';
                            echo '</td>';
                            echo '</tr>';
                        }