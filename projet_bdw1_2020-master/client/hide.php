<? require_once("../admin/database.php"); 
    require_once("./header.php");

$db=DataBase::connect();
$idPhoto=$_GET['id'];





$stmt = $db->prepare('UPDATE Photo SET Photo.visible=:cache WHERE Photo.photoId=:photoId');
                        $N='Non';
                        $photoId=$idPhoto;

                        $stmt->bindValue(':photoId',$photoId );
                        $stmt->bindValue(':cache', $N);
                        $stmt->execute();


?>
                        <!DOCTYPE html>
                        <html>
                            <body>
                                            <h1><strong>Cacher une photo</strong></h1>
                                            <br>
                                            <form class="form" action="hide.php" role="form" method="post">
                                                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                                                <p class="alert alert-warning">La photo a été cache avec succées</p>
                                                <a class="btn btn-default" href="./login_success.php">Cliquez ici pour revenir à votre espace client</a>
                                                </div>
                                            </form>
                                    </div>
                                </div>   
                            </body>
                        </html>
                        