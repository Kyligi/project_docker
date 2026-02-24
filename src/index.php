<?php
$host = 'db';
$db   = 'app_db';
$user = 'user_admin';
$pass = 'user_pass';

$connexionStatus = "";
$messages = [];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $connexionStatus = "Connexion réussie au Back-end et à la Database !";

    if (isset($_POST['ajouter'])) {
        $texte = "Test fait le " . date('H:i:s');
        $pdo->prepare("INSERT INTO messages (texte) VALUES (?)")->execute([$texte]);
    }

   $query = $pdo->query("SELECT texte FROM messages ORDER BY id DESC");
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $connexionStatus = "❌ Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projet Docker</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f4f9; text-align: center; padding: 50px; }
        .container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: inline-block; min-width: 400px; }
        .status { font-weight: bold; margin-bottom: 20px; padding: 10px; border-radius: 5px; background: #e7f3ff; color: #004085; }
        button { background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background: #0056b3; }
        ul { list-style: none; padding: 0; text-align: left; max-height: 200px; overflow-y: auto; }
        li { background: #eee; margin: 5px 0; padding: 8px; border-radius: 4px; border-left: 4px solid #007bff; }
    </style>
</head>
<body>

<div class="container">
    <h1>Conteneurisation Full Stack</h1>
    <div class="status"><?php echo $connexionStatus; ?></div>

    <form method="post">
        <button type="submit" name="ajouter">Ajouter une donnée en DB</button>
    </form>

    <h3>Données stockées (Persistance) :</h3>
    <?php if (empty($messages)): ?>
        <p>Aucune donnée. Cliquez sur le bouton !</p>
    <?php else: ?>
        <ul>
            <?php foreach ($messages as $m): ?>
                <li><?php echo htmlspecialchars($m['texte']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

</body>
</html>
