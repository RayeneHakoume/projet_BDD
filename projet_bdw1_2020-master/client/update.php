<?php

    require '../admin/database.php';

    if(!empty($_GET['id'])) 
    {
        $id = ($_GET['id']);
    }

    $nameError = $descriptionError  = $categoryError  = $name = $description = $category = "";

    if(!empty($_POST)) 
    {
        $name               = $_POST['name'];
        $description        = $_POST['description'];
        $category           = $_POST['category']; 
        $isSuccess          = true;
       
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

                $db=DataBase::connect();
                $statement = $db->prepare("UPDATE Photo  set  nomFich = ?, description = ? WHERE photoId = ?");
                $statement->execute(array($name,$description,$id));
            
        Database::disconnect();
    }

?>

<?  require_once("./header.php"); ?>


<!DOCTYPE html>
<html>
    <head>
    <body>
                    <h1><strong>Modifier un item</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'update.php?id='.$id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom:
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name;?>">
                            <span class="help-inline"><?php echo $nameError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description;?>">
                            <span class="help-inline"><?php echo $descriptionError;?></span>
                        </div>
                        

                        <div class="form-group">
                            <label for="description">Categorie:
                            <input type="text" class="form-control" id="description" name="category" placeholder="Description" value="<?php echo $description;?>">
                            <span class="help-inline"><?php echo $descriptionError;?></span>
                        </div>
                    
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="login_success.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
                
                    </div>
                </div>
            </div>
        </div>   
    </body>
</html>
