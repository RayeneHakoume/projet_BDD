<?php require_once("./header.php"); ?>


<?php


        require 'database.php';
        $db = Database::connect();

echo '<div>';
echo '<h1>Administration de la base de donnée</h1>';
echo '<ul>';


        $statement = $db->query('SELECT COUNT(uId)FROM Utilisateurs ');
                while($item = $statement->fetch()) 
                    {
                        
                        echo '<li> <p>Le nombre d\'utilisateur est '. $item['COUNT(uId)'] . '</li><br>';
                    
                    }


        $statement = $db->query('SELECT COUNT(photoId)FROM Photo ');
                while($item = $statement->fetch()) 
                    {
                        echo '<li> <p>Le nombre total de photo total est   '. $item['COUNT(photoId)'] . '<br>';
         
                    }
                    
        $statement = $db->query('SELECT U.nomU,COUNT(P.photoId) FROM Photo P JOIN Utilisateurs U ON P.uId=U.uId GROUP BY U.NomU');
echo '<li> Affichage du nombre de photos par utilisateur ';       
        
        echo "";
        while($i=$statement->fetch())
                {
                        echo '<p>- Le nombre de photo de   '. $i['nomU'] . ' est '. $i['COUNT(P.photoId)'] . '     <br>';
                        
                }
       
echo '</li>';

        $statement = $db->query('SELECT C.nomCat,COUNT(P.photoId) FROM Photo P JOIN Categorie C ON P.catId=C.catId GROUP BY C.catId');
//echo '<li> Affichage du nombre de photos par categorie  </li>';
echo '<li> Affichage du nombre de photos par categorie '; 
        while($i=$statement->fetch())
                {
                        echo '<p>- Le nombre de photo de  la categorie '. $i['nomCat'] . ' est '. $i['COUNT(P.photoId)'] . '     <br>';
                        
                }
echo '</li>';

        

        echo'<br>Affichage de toutes les photos de la base <br>';
echo'</div>';

echo '<div>';

$id='root';
echo '<div class="row">
                <h3><strong>Ajouter des photos   </strong><a href="insertAdmin.php?id='.$id.'"class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h>
                <h3><strong>Gestion des comptes   </strong><a href="accountEdition.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-user "></span> Gestion</a></h3>
                <table class="table table table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Description</th>
                      <th>Catégorie</th>
                      <th>Visible</th>
                      <th>Propriaitaire</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>';
$elements=$db->query('SELECT * FROM Utilisateurs NATURAL JOIN Photo NATURAL JOIN Categorie ');
         
while($element = $elements->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $element['nomFich'] . '</td>';
                            echo '<td>'. $element['description'] . '</td>';
                            echo '<td>'. $element['nomCat'] . '</td>';
                            echo '<td>'. $element['visible'] . '</td>';
                            echo '<td>'. $element['nomU'] . '</td>';
                            echo '<td width=300>';

                              echo '<div>';
                                   echo '<img class="img_tab" src="../assets/images/' . $element['image'] . '" alt="Image pas chargé">';
                                   echo ' ';
                              echo '</div>';
                              echo '<div>';
                                   echo '<a class="btn btn-primary" href="updateAdmin.php?id='.$element['photoId'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                                   echo ' ';
                                   echo '<a class="btn btn-danger" href="deleteAdmin.php?id='.$element['photoId'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                              echo '</div>';
                              echo ' ';
                                   echo '<a class="btn btn-warning" href="hideAdmin.php?id='.$element['photoId'].'"><span class="glyphicon icon-eye-close"></span> Cacher</a>';
                              echo '</div>';
                              echo ' ';
                                   echo '<a class="btn btn-succes" href="unhideAdmin.php?id='.$element['photoId'].'"><span class="glyphicon icon-eye-open"></span> Afficher</a>';
                              echo '</div>';


                            echo '</td>';
                            echo '</tr>';
                        }
?>
