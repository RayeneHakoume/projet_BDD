<?php include_once("header.php");?>
<h1 class="text-logo"><span class="glyphicon glyphicon-circle-arrow-left"><a href="./parCategorie.php">Retour </a></span></h1>

<? require 'admin/database.php';


                            /*Recuperation de données de la photo */

        $idImage=$_GET['idImage'];
        $db = Database::connect();

        $statement = $db->prepare("SELECT Photo.nomFich,Photo.description,Photo.image,Categorie.nomCat FROM Photo JOIN Categorie WHERE Photo.photoId=? AND Categorie.catId=Photo.catId");
        $statement->execute(array($idImage));
        $photoData = $statement->fetch();

                            /*Affichage de la photo */
        echo '<div class="col-md-4">
                <div class="thumbnail">
                            <img src="assets/images/' . $photoData['image'] . '" alt="">
                </div>
            </div>';

                            /*Affichage des données de la photo */
        echo  '<div class="col-lg-4">
                    <div>';
                        echo  '<h3> ' . $photoData['nomFich'] . '.jpg </h3> ';
                        echo  '<h5>  Catégorie: </h5>' ;       
                        echo  '<h5> '. $photoData['nomCat']. '</h5>' ;
                        echo  '<h5>  Description: </h5>' ;       
                        echo  '<p>' . $photoData['description'].'</p>';
                        
        echo   '</div>';

        Database::disconnect();     
?>

