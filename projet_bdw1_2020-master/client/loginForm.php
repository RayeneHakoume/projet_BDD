<?php  
 session_start();  
 require_once("./header.php");
require_once("../admin/database.php");
$db=DataBase::connect();
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>Tout les champs sont requis</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM Utilisateurs WHERE nomU = :username AND mP = :password";  
                $statement = $db->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"] 
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["username"] = $_POST["username"];  
                     header("location:login_success.php");  
                }  
                else  
                {  
                     $message = '<label>Mot d\'utilisateur ou mot de passe incorrect</label>';
                     echo' <p>Si vous n\'avez pas de compte cliquer sur s\'inscrire </p>';
                     
                }  
           }  
      }

      if(isset($_POST["signin"]))  
      {  
           if(empty($_POST["Nusername"]) || empty($_POST["Npassword"]) || empty($_POST["NNpassword"]))  
           {  
                $message = '<label>Tout les champs sont requis</label>';  
           }else{
               if($_POST['Npassword']==$_POST['NNpassword'])
               {
                              /*Recuperation de l'id du dernier utilisateur */

               $stmt= $db->query('SELECT MAX(uId) FROM Utilisateurs');
               $maxUid=$stmt->fetch();
               
                              /*Insertion des donnees du nouvel utilisateur */

               $stmt = $db->prepare("INSERT INTO `Utilisateurs` (`uId`, `nomU`, `nom`, `mP`) VALUES (:uId,:nomU, :nom,:mP)");
                                    $u=$maxUid['MAX(uId)']+1;
                                    $Uname=$_POST['Nusername'];
                                    $name=$_POST['Nname'];
                                    $pass =$_POST['NNpassword'];

                                    $stmt->bindValue(':uId',$u );
                                    $stmt->bindValue(':nomU', $Uname);
                                    $stmt->bindValue(':nom', $name);
                                    $stmt->bindValue(':mP', $pass);
                                   
                                    $stmt->execute();
               }else
               {         //Verification de la ressaisi du mot de passe
                    
                    if($_POST['Npassword']!=$_POST['NNpassword'])
                    {
                              $message = '<label>Les deux mots de passe ne correspondent pas faites attention à remplir les deux champs de mot de passe avec la même valeur</label>'; 
                    }
       
               } 

     }
}
echo '<br>';
     if(isset($_POST["signin"]))
    {
      echo '<h3>Formulaire d\'inscription</h3><br />';  
      echo '<form method="post">  
                   <label>Nom</label>  
                   <input type="text" name="Nname" class="form-control" />  
                   <br />  
                   <label>Nom Utilisateur</label>  
                   <input type="text" name="Nusername" class="form-control" />  
                   <br /> 
                   <label>Mot de passe</label>  
                   <input type="password" name="Npassword" class="form-control" /> 
                   <label>Ressaisir le passe</label>  
                   <input type="password" name="NNpassword" class="form-control" /> 
                   <input type="submit" name="signin" class="btn btn-info" value="Valider" />
      </form> ';
    }
      
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | PHP Login Script using PDO</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <a type="button" class="btn btn-outline-secondary" href="../index.php">Afficher Toutes les catégories</a>
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3>Espace Client</h3><br />  
                <form method="post">  
                     <label>Nom Utilisateur</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Mot de passe</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Login" />
                     <input type="submit" name="signin" class="btn btn-info" value="Signin" />  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>  
 
    
