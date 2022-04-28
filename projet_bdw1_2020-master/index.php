<?php require_once("./header.php"); ?>

    
            <a type="button" class="btn btn-outline-secondary" href="./parCategorie.php">Afficher photo par catégorie</a>
			<a type="button" class="btn btn-outline-warning" 
			href="./client/loginForm.php">Se connecter</a>
            <?php



                /*Recuperation de la liste des categories */

				require './admin/database.php';
                $db = Database::connect();
                $statement = $db->query('SELECT * FROM Categorie');
                $categories = $statement->fetchAll();
            
                echo '<div class="tab-content">';
				
                /*Affichage de toutes de la liste des categories dans la barre de navigation */

                foreach ($categories as $category) 
                {echo '<div class="tab-pane active" id="' . $category['catId'] .'">';
                    
                    echo '<div class="row">';


                    /*Recuperation de la liste des photos visible pour tout le monde */
                    $stmt = $db->prepare("SELECT * FROM Photo WHERE Photo.catId = :catId AND Photo.visible= :visible");
                                    
                                    $N='Oui';
                                    $photoId=$category['catId'];

                                    $stmt->bindValue(':catId',$photoId );
                                    $stmt->bindValue(':visible', $N);
                                   
                                    $stmt->execute();
                
                    /*Affichage des photos visible */
                    while ($item = $stmt->fetch()) 
                    {
                        echo '<div class="col-sm-6 col-md-4">
                                <div class="thumbnail" >
                                    <img src="assets/images/' . $item['image'] . '" alt="...">
                                </div>
                            </div>';
                    }
                   
                   echo    '</div>
                        </div>';
                }
			
                Database::disconnect();
                echo  '</div>';
?>


