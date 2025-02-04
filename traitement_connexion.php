<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=nom_de_la_base', 'utilisateur', 'mot_de_passe');

// Vérifier que les données sont envoyées via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Rechercher l'utilisateur dans la base de données
    $sql = 'SELECT * FROM utilisateurs WHERE email = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier le mot de passe
    if ($user && password_verify($pass, $user['pass'])) {
        // Démarrer une session et stocker les informations utilisateur
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nom'] . ' ' . $user['prenom'];

        // Rediriger vers l'espace client
        header('Location: espace_client.html');
        exit;
    } else {
        // Rediriger vers la page de connexion avec un message d'erreur
        header('Location: connexion.html?error=1');
        exit;
    }
}
?>