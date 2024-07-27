<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full">
            <thead>
                <tr class="bg-blue-800 text-white">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Prénom</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Téléphone</th>
                    <th class="p-3 text-left">Matricule</th>
                    <th class="p-3 text-left">Formations et Niveaux</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td class="p-3"><?php echo htmlspecialchars($student->_id); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_name); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_first_name); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_mail); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_phone_number); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_registration_number); ?></td>
                        <td class="p-3">
                            <select class="w-full border rounded-lg p-2">
                                <?php foreach ($student->trainingwithLevel as $trainingCode => $levelName): ?>
                                    <option><?php echo htmlspecialchars("$trainingCode - $levelName"); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
<?php 
//*  Méthode pour obtenir les training_id des formations déjà inscrites */
public function getTrainingsForStudent(int $studentId): ?array
{
    // Exécution de la première requête pour obtenir les training_id
    $sql1 = "SELECT rt.training_id
             FROM registration_trainings rt
             INNER JOIN registrations r ON rt.registration_id = r.id
             WHERE r.student_id = :student_id";

    $st1 = $this->_pdo->prepare($sql1);
    $st1->bindValue(':student_id', $studentId, \PDO::PARAM_INT);
    $st1->execute();
    $result = $st1->fetchAll(\PDO::FETCH_ASSOC);

    // Convertir les résultats en un tableau de valeurs
    $trainingIds = [];
    foreach ($result as $row) {
        $trainingIds[] = (int) $row['training_id'];
    }

    // Si le tableau est vide, définissez une valeur qui ne correspondra à aucun ID
    if (empty($trainingIds)) {
        return NULL;
    } else {
        return $trainingIds;
    }
}
/* Étape 2 : Méthode pour obtenir les formations disponibles */
public function getAvailableTrainingsForStudent(int $studentId): ?array
{
    $trainingIds = $this->getTrainingsForStudent($studentId);

    if (is_null($trainingIds)) {
        // Si l'utilisateur n'est inscrit à aucune formation, retourner toutes les formations
        $sql = "SELECT t.id, t.code, t.descriptions
                FROM trainings t
                ORDER BY t.code ASC";

        $st2 = $this->_pdo->prepare($sql);
        $st2->execute();
        return $st2->fetchAll(\PDO::FETCH_ASSOC);
    } else {
        // Convertir le tableau en une chaîne de caractères compatible avec SQL
        $trainingIdsString = implode(', ', $trainingIds);

        // Utiliser cette chaîne de caractères dans la clause NOT IN de la deuxième requête
        $sql = "SELECT t.id, t.code, t.descriptions
                FROM trainings t
                WHERE t.id NOT IN ($trainingIdsString)
                ORDER BY t.code ASC";

        try {
            // Préparer et exécuter la requête
            $st2 = $this->_pdo->prepare($sql);
            $st2->execute();

            // Récupérer les résultats
            return $st2->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Gérer les erreurs
            die("Erreur lors de la récupération des formations : " . $e->getMessage());
        }
    }
}
/* Étape 3 : Utiliser ces méthodes dans votre contrôleur et afficher les résultats
Contrôleur */
public function getStudent() {
    $registrationService = new RegistrationServices($this->_pdo);
    $students = $registrationService->getAll();

    foreach ($students as $student) {
        $student->availableTrainings = $registrationService->getAvailableTrainingsForStudent($student->_id);
    }

    include 'path_to_your_view_file.php';
}
/* afficher dans la vue */
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-10">
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full">
            <thead>
                <tr class="bg-blue-800 text-white">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Prénom</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Téléphone</th>
                    <th class="p-3 text-left">Matricule</th>
                    <th class="p-3 text-left">Formations et Niveaux</th>
                    <th class="p-3 text-left">Formations Disponibles</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <td class="p-3"><?php echo htmlspecialchars($student->_id); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_name); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_first_name); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_mail); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_phone_number); ?></td>
                        <td class="p-3"><?php echo htmlspecialchars($student->_registration_number); ?></td>
                        <td class="p-3">
                            <select class="w-full border rounded-lg p-2">
                                <?php foreach ($student->trainingwithLevel as $trainingCode => $levelName): ?>
                                    <option><?php echo htmlspecialchars("$trainingCode - $levelName"); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="p-3">
                            <select class="w-full border rounded-lg p-2">
                                <?php foreach ($student->availableTrainings as $training): ?>
                                    <option><?php echo htmlspecialchars($training['code'] . ' - ' . $training['descriptions']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

<?php 
"SELECT DISTINCT u.*
FROM users u
INNER JOIN registrations r 	ON u.id=r.student_id
INNER JOIN registration_trainings rt On r.id=rt.registration_id
INNER JOIN trainings t ON rt.training_id=t.id
INNER JOIN levels l ON rt.level_id=l.id"
