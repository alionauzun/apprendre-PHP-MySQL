<?php
// la fonction displayAuthor retourne une chaîne de caractères contenant le nom de l'auteur de la recette, son âge et le nombre de recettes qu'il a publiées. 
function displayAuthor(string $authorEmail, array $users): string
{
    foreach ($users as $user) {
        if ($authorEmail === $user['email']) {
            return $user['full_name'] . '(' . $user['age'] . ' ans)';
        }
    }

    return 'Auteur inconnu';
}

// la fonction isValidRecipe retourne un booléen en fonction de la validité d'une recette donnée en paramètre 
function isValidRecipe(array $recipe): bool
{
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }

    return $isEnabled;
}

// la fonction getRecipes retourne un tableau contenant les recettes valides d'un tableau de recettes donné en paramètre 
function getRecipes(array $recipes): array
{
    $valid_recipes = [];

    foreach ($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $valid_recipes[] = $recipe;
        }
    }

    return $valid_recipes;
}

// la fonction redirectToUrl redirige l'utilisateur vers une autre page, dans ce cas, la page d'accueil du site, qui est située à l'URL index.php. 
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}//exit()  est utilisé pour arrêter immédiatement le reste du code PHP. Cela garantit que la redirection s'effectue sans problème, sans que d'autres instructions perturbent ce processus.
