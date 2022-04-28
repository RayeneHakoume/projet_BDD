<?php  
 //login_success.php  
 require_once("./header.php");
 session_start();  
 
 if(isset($_SESSION["username"]))  
 {  
      echo '<h3>Connecté avec succés, Bienvenue - '.$_SESSION["username"].'</h3>';  
      echo '<br /><br /><a href="../index.php">Se déconnecter</a>';  
      
 }  
 echo '<br>';
 ?>  
 <?php
    require '../admin/database.php';


    
          /* Chagement du nom d'utilisateur */

    $nomU=$_SESSION["username"];
    $db = Database::connect();
    $uId =$db->query('SELECT Utilisateurs.uId FROM Utilisateurs WHERE Utilisateurs.nomU= \''.$nomU.'\'');


          /*Recuperation de la liste des photos de l'utilisateur connecte */
    $uId =$uId->fetch();
    $elements = $db->query('SELECT C.*,P.* FROM Categorie C JOIN Photo P ON C.catId=P.catId WHERE P.uId = \''.$uId['uId'].'\' ');   


echo '<div class="row">
                <h1><strong>Liste des elements   </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></h1>
                <table class="table table table-bordered">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Description</th>
                      <th>Catégorie</th>
                      <th>Visible</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>';
                        while($element = $elements->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $element['nomFich'] . '</td>';
                            echo '<td>'. $element['description'] . '</td>';
                            echo '<td>'. $element['nomCat'] . '</td>';
                            echo '<td>'. $element['visible'] . '</td>';
                            echo '<td width=300>';

                              echo '<div>';
                                   echo '<img class="img_tab" src="../assets/images/' . $element['image'] . '" alt="Image pas chargé">';
                                   echo ' ';
                              echo '</div>';
                              echo '<div>';
                                   echo '<a class="btn btn-primary" href="update.php?id='.$element['photoId'].'"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                                   echo ' ';
                                   echo '<a class="btn btn-danger" href="delete.php?id='.$element['photoId'].'"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                              echo '</div>';
                              echo ' ';
                                   echo '<a class="btn btn-warning" href="hide.php?id='.$element['photoId'].'"><span class="glyphicon icon-eye-close"></span> Cacher</a>';
                              echo '</div>';
                              echo ' ';
                                   echo '<a class="btn btn-succes" href="unhide.php?id='.$element['photoId'].'"><span class="glyphicon icon-eye-open"></span> Afficher</a>';
                              echo '</div>';

                            echo '</td>';
                            echo '</tr>';
                        }
                        Database::disconnect();
                      ?>
                    </tbody>
               </table>
      </div>;

