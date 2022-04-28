<?php
     
    require './database.php';
    session_start();  
 
    $nameError = $descriptionError  = $categoryError = $imageError = $name = $description  = $category = $image = "";

    if( $_POST ) 
    {
        
        $name               = $_POST['nomFich'];
        $description        = $_POST['description'];
        $category           = $_POST['nomCat'];
        $image              = $_FILES['image']['name'];
        $imagePath          = '../assets/images/'. basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true;
        $isUploadSuccess    = false;
        
        
        
        
        
        if(empty($name)) 
        {
            $nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($description)) 
        {
            $descriptionError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($category)) 
        {
            $categoryError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($image)) 
        {
            $imageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        else
        {
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension !='GIF') 
            {
                $imageError = "Les fichiers autorises sont: .jpg, png ,GIF";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath)) 
            {
                $imageError = "Le fichier existe deja";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 100000) 
            {
                $imageError = "Le fichier ne doit pas depasser les 100KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) 
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                {
                    $imageError = "Il y a eu une erreur lors de l'upload";
                    $isUploadSuccess = false;
                } 
            } 
        }
        
        if($isSuccess && $isUploadSuccess) 
        {
                        /* Connexion à la base */

            $db = Database::connect();

                        /* Recuperation maxPhotoId */
            $ptId = $db->query('SELECT MAX(photoId) FROM Photo');
            $result =$ptId->fetch(PDO::FETCH_ASSOC);
            $maxPhtId = $result['MAX(photoId)'] + 1;


   
                                    /*Verification si nouvelle categorie */


            $stmt=$db->prepare("SELECT * FROM Categorie  WHERE nomCat = :nomCat");
            $stmt->bindValue(':nomCat', $category);
            $stmt->execute();
           
            $i=0;
            while($res=$stmt->fetch())
            {
                $i++;
            }

            if($i==0)//Cas ou la categorie n'existe pas dans la base de donnée
            {

                    /*   Recuperation  de maxCatId */

                $catId = $db->query('SELECT MAX(catId) FROM Categorie');
                $result =$catId->fetch(PDO::FETCH_ASSOC);
                $maxCatId = $result['MAX(catId)'];
                $maxCatId =$maxCatId+ 1;
                
                                /*Insertion des nouvelles donnes de l'image  dans la base par defaut les images ajoute par l'adminisateur sont cachées */
                $stmt = $db->prepare("INSERT INTO Photo (photoId,nomFich,description,image,catId,uId,visible) VALUES (:photoId,:nomFich, :description,:image,:catId,:uId,:visible)");
                $phoId=$maxPhtId;
                $fichier=$name;
                $desc=$description;
                $img =$image;
                $cat=$maxCatId;;
                
                $stmt->bindValue(':photoId', $phoId);
                $stmt->bindValue(':nomFich', $fichier);
                $stmt->bindValue(':description', $desc);
                $stmt->bindValue(':image', $img);
                $stmt->bindValue(':catId', $cat);
                $stmt->bindValue(':uId', 0);
                $stmt->bindValue(':visible', 'Non');
                $stmt->execute();
                

                /* Mise a jour de la table Categorie */

                $stmt=$db->prepare('INSERT INTO Categorie(catId,nomCat) VALUES (:catId,:nomCat)');
                $stmt->bindValue(':catId', $maxCatId);
                $stmt->bindValue(':nomCat', $category);
                $stmt->execute();


            }else{//Cas ou la categorie existe deja dans la base de donnée

                        /*Recuperation de lid de la categorie passe en parametre  */

                $statement = $db->prepare('SELECT DISTINCT C.catId FROM Categorie C JOIN Photo P ON C.catId=P.catId WHERE C.nomCat = ?');
                $statement->execute(array($category));
                $categorieId;
                                while($res =$statement->fetch())
                                {
                                   
                                                /*Insertion des nouvelles donnes de l'image  dans la base par defaut les images ajoute par l'adminisateur sont cachées */

                                    $stmt = $db->prepare("INSERT INTO Photo (photoId,nomFich,description,image,catId,uId,visible) VALUES (:photoId,:nomFich, :description,:image,:catId,:uId,:visible)");
                                    $phoId=$maxPhtId;
                                    $fichier=$name;
                                    $desc=$description;
                                    $img =$image;

                                    $stmt->bindValue(':photoId', $phoId);
                                    $stmt->bindValue(':nomFich', $fichier);
                                    $stmt->bindValue(':description', $desc);
                                    $stmt->bindValue(':image', $img);
                                    $stmt->bindValue(':catId', $res['catId']);
                                    $stmt->bindValue(':uId',0);
                                    $stmt->bindValue(':visible', 'Non');
                                    $stmt->execute();
                                }
                                $db->disconnect();
                
                }     
            }
        }

 

?>
<? require_once("./header.php"); ?>
<!DOCTYPE html>
<html>
    <body>
         <div class="container admin">
         
            <div class="row">
                <h1><strong>Ajouter une photo</strong></h1>
                <br>
                <form class="form" action="insertAdmin.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="nomFich" placeholder="Nom" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description;?>">
                        <span class="help-inline"><?php echo $descriptionError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie:</label>
                        <input type="text" class="form-control" id="description" name="nomCat" placeholder="Catégorie" value="<?php echo $description;?>">
                        <span class="help-inline"><?php echo $categoryError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="image">Sélectionner une image:</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline"><?php echo $imageError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="./index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>