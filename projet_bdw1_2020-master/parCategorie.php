<?php require_once"header.php"; ?>
            <a type="button" class="btn btn-outline-secondary" href="index.php">Afficher Toutes les catégories</a>
            <?php
				require 'admin/database.php';
			 
                echo '<nav>
                        <ul class="nav nav-pills">';


                /* Recuperation de la liste des catégories */

                /*Affichage selon la categorie sur la quelle l'utilisateur clique */
                
                $db = Database::connect();
                $statement = $db->query('SELECT * FROM Categorie');
                $categories = $statement->fetchAll();
                
                foreach ($categories as $category) 
                {
                        echo '<li role="presentation"><a href="#'. $category['catId'] . '" data-toggle="tab">' . $category['nomCat'] . '</a></li>';
                }

                echo    '</ul>
                      </nav>';

                echo '<div class="tab-content">';
				

                foreach ($categories as $category) 
                {echo '<div class="tab-pane active" id="' . $category['catId'] .'">';
                    
                    echo '<div class="row">';
                    
                    $stmt = $db->prepare('SELECT * FROM Photo WHERE Photo.catId =:catId AND Photo.visible =:visible');
                        $N='Oui';
                        $photoId=$category['catId'];

                        $stmt->bindValue(':catId',$photoId );
                        $stmt->bindValue(':visible', $N);
                        $stmt->execute();

                    while ($item = $stmt->fetch()) 
                    {
                         $idReq=$item['photoId'];
                        echo '<div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                <a href="afficheImage.php?idImage='. $idReq .'">
                                    <img src="assets/images/' . $item['image'] . '" alt="...">
                                </a>
                                </div>
                            </div>';
                    }
                   
                   echo    '</div>
                        </div>';
                }
			
                Database::disconnect();
                echo  '</div>';
            ?>


