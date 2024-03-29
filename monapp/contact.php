<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Contactez nous</h1>
        <!-- formulaire de contact -->
        <!--envoi des données vers la page submit_contact.php avec la méthode Post, pour eviter que les données soient visibles dans l'url-->
        <!--Il y a deux attributs très importants à connaître pour la balise <form>  :
            La méthode :  method  
            Et la cible :  action (la page qui recevra les données du formulaire, et qui sera chargée de les traiter.) -->
        <!-- enctype="multipart/form-data" est utilisé pour envoyer des fichiers-->
        <form action="submit_contact.php" method="Post" enctype="multipart/form-data">
            <!-- Ajout champ email ! -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help">
                <div id="email-help" class="form-text">Nous ne revendrons pas votre email.</div>
            </div>
            <!-- Ajout champ message ! -->
            <div class="mb-3">
                <label for="message" class="form-label">Votre message</label>
                <textarea class="form-control" placeholder="Exprimez vous" id="message" name="message"></textarea>
            </div>
            <!-- Ajout champ d'upload ! -->
            <div class="mb-3">
                <label for="screenshot" class="form-label">Votre capture d'écran</label>
                <input type="file" class="form-control" id="screenshot" name="screenshot" />
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>

</html>