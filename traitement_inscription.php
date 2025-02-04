<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=nom_de_la_base', 'utilisateur', 'mot_de_passe');

// Vérifier que les données sont envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $civility = $_POST['civility'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT); // Hacher le mot de passe

    // Préparer et exécuter la requête d'insertion
    $sql = 'INSERT INTO utilisateurs (civility, nom, prenom, email, telephone, pass) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$civility, $nom, $prenom, $email, $telephone, $pass])) {
        // Rediriger vers la page de connexion après l'inscription réussie
        header('Location: connexion.html');
        exit;
    } else {
        // Afficher une erreur si l'insertion échoue
        echo 'Erreur lors de l\'inscription.';
    }
} else {
    // Rediriger si le formulaire n'a pas été soumis correctement
    header('Location: inscription.html');
    exit;
}
?>