<!DOCTYPE html>
<html>
     <head>
          <meta charset="UTF-8">
          <title>bloublou</title>
     </head>
     <body>
          <form method="GET" action="autrepage.php">
               <input type="text" name='message' value="t"/><!--permet d'envoyer le texte rentré a la page autrepage2.php--></br>
               <input type="submit" value="Valider"/>
          </form>
          <a href="autrepage.php?message= <?php echo $c ?>">lien</a><!--permet d'envoyer la variable c dans l'url de la seconde page-->

<?php //attention cest modifiable par l'utilisateur donc:

include("autrepage2.php");//permet d'introduire le code d'(une autre page ici afin d'eviter de recopier patout)

?>



          <form method="POST" action="autrepage3.php">
               <input type="texte" name="message2" value="<strong>msg</strong>"/><!--permet d'envoyer le texte rentré a la page autrepage2.php-->
               <input type="submit" value="Valider"/>
          </form>
          <form method="POST" action="autreapage3.php" enctype="multipart/form-data"><!--permet d'envoyer un fichier qui se recupere grace a "$_FILES". 
                                                                                     Il faut controler leur taille, leur modele, leur existence, etc
                                                                                     Refuser les fichier php
                                                                                     fonction "move_uploaded_file", permet de conserver le fichier-->
               <input type="file"/>
          </form>

<?php 
//Les SESSIONS ||ATTENTION|| : il faut demarrer la session AVANT d'ecrire le code html
//session_start()   et session_destroy() permettent de démarrer et finir une session 
//on peut rappeler cette session comme get et post mais cette fois avec $_SESSION[''] (par exemple 'nom' ou 'age' etc)
//les session ont des ID souvent tres long

//Les COOKIES ||ATTENTION|| : il faut demarrer le cookie AVANT d'ecrire le code html
//setcookie() permet de creer un cookie avec 3 parametre (souvent) : Nom , valeur ; date d'esxpiration en "timestamp"(nombre de secondes écoulées depuis le 1er janvier 1970; donc on fait time() + le temps que le cookie dure)
//securité: httpOnly et secure
/*Exemple : setcookie(
     "LOGGED_USER" , 
     "utilisateur@exemple.com" , 
     [
          "expires" => time() + 365*24*3600 ),
          "secure" => true,
          "httpOnly => true,
     ]
*/    
//on rappelle cette fonction avec $_COOKIE['']      
?>

<?php 




//BASE DE DONNEES MySQL
try //essaie ce qui suit
{
$mysql = new PDO //va chercher une base de données
(
          'mysql:host=localhost;dbname=cours;charset=utf8', // l'endroit ou est stocké la base de données; le nom de la base de données; et le charset
          'root', // l'identifiant (quasi toujours root)
          '' // le mot de passe (normalement vide car yen a pas)
);
}
catch(Exeption $e) //si le try marche pas, envoie le message qu'on veut
{
     die('Erreur : ' . $e->getMessage()); //envoie le message
}
//try et catch permet de detecter si ya une erreur pour que ce soit nous qui decidons le message d'erreur pour eviter la fuite d'informations



$Statement = $mysql->prepare('SELECT * FROM test'); //extrait(select) toutes(*) les données de(from) la table "2"(2)
$Statement->execute(); //jsp
$données = $Statement->fetchAll(); //convertit les données illisible en données lisible

// On affiche chaque recette une à une
foreach ($données as $donnée) 
{
?>
     <p><?php echo $donnée['age']; ?></p>
     <?php //donne toute les données age de chaque ligne du tableau
}


//on peut aussi faire d'une autre maniere:

$sqlQuery = 'SELECT * FROM test';
$testStatement2 = $mysql->prepare($sqlQuery);
$testStatement2->execute();
$donnees2= $testStatement2->fetchAll();
foreach ($donnees2 as $donnee2) 
{
?>
     <p><?php echo $donnee2['email']; ?> </p>
     <?php //donne toute les données age de chaque ligne du tableau
}


?>
<?php
try
{
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table recipes
$sqlQueryy = 'SELECT * FROM test';
$recipesStatement = $mysqlClient->prepare($sqlQueryy);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

// On affiche chaque recette une à une
foreach ($recipes as $recipe) {
?>
    <p><?php echo $recipe['age']; ?></p>
<?php
}

$sqlQuery = 'SELECT title, age FROM test';//pour recuperer ce quon veut
$sqlQuery = 'SELECT * FROM test WHERE is_enabled = TRUE'; //« Sélectionner tous les champs de la table recipes lorsque le champ is_enabled est égal à vrai ».
$sqlQuery = 'SELECT * FROM test WHERE is_enabled = TRUE LIMIT 2 ORDER BY email'; // prends que les 2 premiers resultats et trie dans l'ordre alphabetique la colonne email

$sqlQuery = 'SELECT * FROM test WHERE email = :email AND age = :age';//permet dinserer des variables apparemment et ca rendrait le code plus dynamique (g pa compris XD)

$yug=$mysqlClient->prepare($sqlQuery);
$yug->execute([
    'email' => 'test2',
    'age' => 16,
]);

$db = new PDO(
     'mysql:host=localhost;dbname=cours;charset=utf8',
     'root',
     '',
     [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],//permet de mieux afficher les erreurs
 );
 $sqlQuery = 'SELECT * FROM test';
 $recipesStatement = $db->prepare($sqlQuery);
 $recipesStatement->execute();
 $recipes = $recipesStatement->fetchAll();
 

//PARTIE 2 SQL


/* 
$sqlQuery = 'INSERT INTO test(email, age, full_name, password) VALUES (:email, :age, :full_name, :password)';//permet de mettre dans la table test des nouvelles données

$insertRecipe = $db->prepare($sqlQuery);
$insertRecipe->execute([
     'email' => 'contributeur@exemple.com',
     'age' => '45',
     'full_name' => 'contributeur',
     'password' => 'blabla'
     ]);//assimile a ces variables des valeurs 

*/ 
     
// mis en commentaire car sexecutait a chaque actualisation de la page

?>
     <form action = "cours.php" method="POST">
          <div class="mb-3" >
               <label for="email" class="form-label">email</label>
               <input type="text" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3" >
               <label for="full_name" class="form-label">full_name</label>
               <input type="text" class="form-control" id="full_name" name="full_name">
               <button type="submit" class="btn btn-primary">envoyer</button>
          </div>
     </form>

<?php 
$email= $_POST['email'];
$full_name= $_POST['full_name'];
if(1==2){//juste pour pas que ce soit executé ^^
$insertRecipe = $db->prepare('INSERT INTO test(email, age, full_name, password) VALUES (:email, :age, :full_name, :password)');
$insertRecipe->execute([
    'email' => $email,
    'age' => '45',
    'full_name' => $full_name,
    'password' => 'blabla'
    ]);
}
$id= $_POST['id'];
$updateRecipe = $db->prepare('UPDATE test SET email = :email, full_name = :full_name WHERE user_id = :id ');
// (UPDATE) modifie; nom de la table; (SET) separe la table des champs à modifier;champs a modifier; (WHERE) montre quelle entrée doit etre modifiée ( souvent l'id)
$updateRecipe->execute([
     'email' => $email,
     'full_name' => $full_name,
     'id' => $id
     ]);

?>

     </body>
</html>



