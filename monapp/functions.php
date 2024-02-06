<?php

//fonction qui affiche l'auteur de la recette en fonction de son email et de la liste des utilisateurs 
function displayAuthor(string $authorEmail, array $users): string
{
    foreach ($users as $user) {
        if ($authorEmail === $user['email']) {
            return $user['full_name'] . '(' . $user['age'] . ' ans)';
        }
    }
    return 'Auteur inconnu';
}

//fonction qui vérifie si une recette est valide
function isValidRecipe(array $recipe): bool
{
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }


    return $isEnabled;
}

//fonction qui retourne les recettes valides
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
