<?php

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;

if (
    !isset($postData['email'])
    || !filter_var($postData['email'], FILTER_VALIDATE_EMAIL)
    || empty($postData['message'])
    || trim($postData['message']) === ''
) {
    echo ('Il faut un email et un message valides pour soumettre le formulaire.');
    return;
}

$isFileUploaded = false;
//Testons si un fichier a été envoyé avec "isset" et s'il n'y a pas d'erreur 
if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] === 0) {
    //---Vérifiez la taille du fichier----//
    //On vérifie si la taille du fichier est inférieure ou égale à 1 Mo (1 Mo = 1000000 octets)
    if ($_FILES['screenshot']['size'] <= 1000000) {
        echo "L'envoi n'a pas pu être effectué, erreur ou image trop volumineuse";
        return;
    }

    //---Testons si l'extension , n'est pas autorisée---//

    //On récupère l'extension du fichier envoyé
    //La fonction pathinfo renvoie un tableau (array) contenant entre autres l'extension du fichier dans  $fileInfo['extension']  .
    $fileInfo = pathinfo($_FILES['screenshot']['name']);
    //j'ai utilisé la fonction "strtolower()" pour convertir l'extension du fichier en minuscules
    //On stocke ça dans une variable  $extension 
    $extension = strtolower($fileInfo['extension']);
    $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];
    //Une fois l'extension récupérée, on peut la comparer à un tableau d'extensions autorisées, et vérifier si l'extension récupérée fait bien partie des extensions autorisées à l'aide de la fonction in_array() .
    if (!in_array($extension, $allowedExtensions)) {
        echo "L'envoi n'a pas pu être effectué,l'extension {$extension} n'est pas autorisée";
        return;
    }

    // On verifier si le dossier uploads est manquant
    $path = __DIR__ . '/uploads';
    //Pour vérifier si notre dossier uploads existe, nous allons utiliser la fonction  is_dir()
    if (!is_dir($path)) {
        echo "L'envoi n'a pas pu être effectué, le dossier uploads est manquant";
        return;
    }

    // Générons un nom de fichier unique pour éviter l'écrasement
    //On peut générer un nom de fichier unique pour éviter l'écrasement de fichiers en utilisant la fonction  uniqid()  qui génère un identifiant unique basé sur la date et l'heure actuelles.
    $filename = uniqid() . '.' . $extension;
    // On peut valider le fichier et le stocker définitivement. Si tout est bon, on accepte le fichier en appelant la fonction move_uploaded_file() et on lui 2 paramètres : le fichier temporaire et le chemin de destination, pour déplacer le fichier temporaire vers le dossier sur le server uploads.
    move_uploaded_file($_FILES['screenshot']['tmp_name'], $path . $filename);

    echo "Fichier envoyé avec succès sous le nom : $filename";
}


//Lorsque vous mettrez le script sur Internet à l'aide d'un logiciel FTP, vérifiez que le dossier « Uploads » sur le serveur existe, et qu'il a les droits d'écriture. Pour ce faire, sous FileZilla par exemple, faites un clic droit sur le dossier et choisissez « Attributs du fichier ».
//Cela vous permettra d'éditer les droits du dossier (on parle de CHMOD). Mettez les droits à 733, ainsi PHP pourra placer les fichiers téléversés dans ce dossier.


//Comme  $_FILES['screenshot']['name']  contient le chemin entier vers le fichier d'origine (  C:\dossier\fichier.png  , par exemple), il nous faudra extraire le nom du fichier.
//On peut utiliser pour cela la fonction  basename  qui renverra juste « fichier.png ».
// move_uploaded_file($_FILES['screenshot']['tmp_name'], $path . basename($_FILES['screenshot']['name']));
// $isFileUploaded = true;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Contact reçu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Message bien reçu !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Email</b> : <?php echo ($postData['email']); ?></p>
                <!-- On utilise la fonction strip_tags pour éviter que l'utilisateur ne puisse injecter du code HTML dans le formulaire -->
                <!-- On peut utilise également la fonction htmlspecialchars pour éviter ca -->
                <!--La différence entre strip_tags et htmlspecialchars est que strip_tags supprime les balises HTML, tandis que htmlspecialchars les encode, mais les laisse visibles.-->
                <p class="card-text"><b>Message</b> : <?php echo (strip_tags($postData['message'])); ?></p>
            </div>
        </div>
    </div>
</body>

</html>