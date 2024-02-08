<?php
$users = [
    [
        'full_name' => 'Mickaël Andrieu',
        'email' => 'mickael.andrieu@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Mathieu Nebra',
        'email' => 'mathieu.nebra@exemple.com',
        'age' => 34,
    ],
    [
        'full_name' => 'Laurène Castor',
        'email' => 'laurene.castor@exemple.com',
        'age' => 28,
    ],
];

$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => 'Etape 1 : des flageolets !',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => 'Etape 1 : de la semoule',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => 'Etape 1 : prenez une belle escalope',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Salade Romaine',
        'recipe' => 'Etape 1 : prenez une belle salade',
        'author' => 'laurene.castor@exemple.com',
        'is_enabled' => false,
    ],
];



// //----verification de l'activation des recettes----
// //parcours du tableau de recettes
// foreach ($recipes as $recipe) {
//     // Vérifie si la clé 'is_enabled' existe et si sa valeur est égale à true
//     if (isset($recipe['is_enabled']) && $recipe['is_enabled'] === true) {
//         // La recette est activée (is_enabled est vrai)
//         // Affiche le titre de la recette
//         echo "La recette '{$recipe['title']}' est activée.<br>";
//     } else {
//         // La recette est désactivée (is_enabled est faux)
//         // Affiche le titre de la recette
//         echo "La recette '{$recipe['title']}' est désactivée.<br>";
//     }
// }

//-------Si la recette est activée (  is_enabled  à vrai), affichez le titre, la recette et l'auteur de la recette dans des balises HTML appropriées.


foreach ($recipes as $recipe) {
    //verifie si la clé 'is_enabled' existe et si sa valeur est égale à true
    if (isset($recipe['is_enabled']) && $recipe['is_enabled'] === true) {
        //la recette est activée (is_enabled est vrai)
        echo '<div>';
        echo "<h2>{$recipe['title']}</h2>";
        echo "<p>{$recipe['recipe']}</p>";
        echo "<i>{$recipe['author']}</i>";
        echo '</div>';
    } else {
        // La recette est désactivée (is_enabled est faux ou la clé n'existe pas)
        echo "La recette '{$recipe['title']}' est désactivée.<br>";
    }
}
