<?php   
 //logout.php  
 session_start();  
 session_destroy();
 if(isset($_SESSION["username"]))
 {
    echo '<a href="../index.php"> Cliquer ici </a>';
    echo "Deconnecte avec succes !";
 }
 ?>  