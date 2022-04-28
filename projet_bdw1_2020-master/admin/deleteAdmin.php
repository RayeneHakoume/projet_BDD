<?php
    require 'database.php';
 
    if(!empty($_GET['id'])) 
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) 
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM Photo WHERE photoId = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location: ./index.php"); 
    }

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>
<? require_once("./header.php"); ?>


<!DOCTYPE html>
<html>
    <body>
                    <h1><strong>Supprimer une photo</strong></h1>
                    <br>
                    <form class="form" action="deleteAdmin.php" role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $id;?>"/>
                        <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                        <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Oui</button>
                        <a class="btn btn-default" href="./index.php">Non</a>
                        </div>
                    </form>
            </div>
        </div>   
    </body>
</html>

