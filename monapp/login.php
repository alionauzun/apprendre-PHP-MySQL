<?php

$postData = $_POST;


//Validation du formulaire
if (isset($postData['email']) && isset($postData['password'])) {
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = 'L\'email est invalide';
    } else {
        foreach ($users as $user) {
            if (
                $user['email'] === $postData['email'] &&
                $user['password'] === $postData['password']
            ) {
                $loggedUser = [
                    'email' => $user['email'],
                ];
            }
        }

        if (!isset($loggedUser)) {
            $errorMessages = sprintf(
                'L\'email ou le mot de passe est incorrect : (%s/%s)',
                $postData['email'],
                strip_tags($postData['password'])
            );
        }
    }
}
?>

<!--
    Si l'utilisateur/trice est non identifié(e), affichez un formulaire de connexion avec deux champs : email et mot de passe.
-->
<?php if (!isset($loggedUser)) : ?>
    <form action="index.php" method="Post">
        <!-- si message d'erreur, on l'affiche -->
        <?php if (isset($errorMessages)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessages; ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help">
            <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $loggedUser['email']; ?> et bienvenue sur le site !
    </div>
<?php endif; ?>