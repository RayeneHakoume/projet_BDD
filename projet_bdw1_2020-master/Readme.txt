Le site internet comporte trois profils d'utilisateurs :

    -1 Utilisateur Lambda (invité) il n'as accès  qu'a trois pages 
        -index.php (pour l'affichage de toutes les photos toutes catégories confondues)
        -parCatégorie.php sur la qu'elle il sera renvoyé lorsqu'il clique sur une des catégories dans le menu de navigation 
                et où il aura accès qu'a la liste de la catégorie sélectionnée 
        -affichageImage.php pour accéder à cette dernière il faut tout d'abord au visiteur du site de passer par la page 
                de tri par (parCatégorie.php) et lorsqu'il clique sur une photo il sera redirigé vers la page affichageImage.php 
                qui affiche la photo plus ses données.


    -2 Client du site il a accès en plus du visiteur à toutes les pages présentes dans le repertoire Client.
        -il aura la possibilité de s'inscrire si ce n'est pas déjà fait en cliquant sur (signin) juste en dessous du formulaire de connexion
            un deuxième formulaire sera affiché comportant trois champs de saisis il faut bien faire attention à ce que les deux valeurs
            saisis dans les champs mots de passes correspondent sinon un message d'erreur est affiché si aucun message ne s'affiche 
            l'utilisateur est inscrit sur la base.
        -s'il souhaite il aura la possibilité de cacher afficher supprimer ajouter des photos et modifier aussi les données relatives à chacunes d'elles
        -il a aussi l'accès à une sorte de récapitulatif  dans un un tableau lui indiquant la catégorie, états de la photo (caché ou pas ) 
            et une description

            NB : par défaut si le client ajoute une photo elle est automatiquement affiché les autres visiteurs verront tous les 
                données de sa photo il suffit de cliquer sur cacher pour que  l'état de la photo  change et passe de visible (Oui) à cacher(Non)

    3-Adminisateur 
        -En plus de touts ça l'Administrateur du site peut tout faire ajouter des photos les cacher afficher supprimer modifier leurs données (peut importe l'auteur)
            Il aussi des statistiques de sa base (Nb de photo par utilisateur ,Nb de photo par catégorie, Nb d'utilisateur) et en plus de un petit 
            tableau récapitulatif  l'orsequ'on clique sur gestion qui nous affiche le nombre de photo caché par utilisateur.
            
            NB : par défaut si l'admin ajoute une photo elle est automatiquement caché les autres visiteurs ne la verront pas s'il le souhaite 
                données accès à sa photo il suffit de clique sur afficher l'état de la photo change change alors de cacher(Non)  visible (Oui) 

Pour accéder au profile administrateur on tape dans la barre d'adresse url suivi de /admin


    La base de données comporte trois utilisateurs 
    -Mous 
        idConeexion : Mous   motDpasse : 1234
                      
                      Uilisateur 1       1234