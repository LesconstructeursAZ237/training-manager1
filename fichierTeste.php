<?php
// Exemple de tableau de données
$data = [
    'a' => 'apple',
    'b' => 'banana',
    'c' => 'apple',
    'd' => 'orange',
    'e' => 'banana',
    'f' => 'pear',
    'g' => 'apple'
];

// Tableau pour stocker les valeurs déjà rencontrées avec leurs clés
$encountered = [];

// Tableau pour stocker les clés des valeurs dupliquées
$duplicateKeys = [];

// Tableau pour stocker les valeurs avec les mêmes clés
$valuesWithSameKeys = [];

foreach ($data as $key => $value) {
    if (isset($encountered[$value])) {
        // Si la valeur est déjà rencontrée, on ajoute la clé au tableau des dupliquées
        $duplicateKeys[$value][] = $key;
        $valuesWithSameKeys[$value] = $encountered[$value];
    } else {
        // Sinon, on l'ajoute au tableau des rencontrées
        $encountered[$value][] = $key;
    }
}

// Affichage des résultats
echo "Clés des valeurs dupliquées : \n";
print_r($duplicateKeys);

echo "Valeurs avec les mêmes clés : \n";
print_r($valuesWithSameKeys);
?>

<?php
// Exemple de tableau de données
$data = ['DA', 'BA', 'DA', 'CA', 'DA', 'BA', 'EA'];

// Tableau pour stocker les valeurs déjà affichées
$encountered = [];

// Boucle foreach pour parcourir les données
foreach ($data as $value) {
    if (!in_array($value, $encountered)) {
        // Si la valeur n'a pas encore été affichée, on l'affiche
        echo $value . "\n";
        // On ajoute la valeur au tableau des valeurs déjà affichées
        $encountered[] = $value;
    }
} if (!in_array($training, $encountered)) {

$encountered[]=$training; }  
/* j'ai une table trainings, une levels et une table 
association entre trainings et levels(trainings_levels), 
1 ou plusieurs id de trainings se trouve dans trainings_levels, 
un ou plusieurs id de levels se trouve également dans trainings levels,
 ce qui veut dire qu'un trainings appartient a un ou plusieurs levels,
  comment sélectionner tout les trainings avec leurs différent niveau et afficher? 
  afficher  un trainings une seule fois sur ca ligne dans le tableau même s'il même s'il appartient
 a plusieurs niveau et afficher ces différents niveau a coté sous forme de liste de sélection.*/
