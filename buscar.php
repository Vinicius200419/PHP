<?php
// Conexão com o banco de dados SQLite
$db = new PDO('sqlite:receitas.db');

// Obtém o termo de busca
$termo = $_GET['q'] ?? '';

// Busca receitas pelo título
$stmt = $db->prepare('SELECT id, titulo, imagem FROM receitas WHERE titulo LIKE ?');
$stmt->execute(["%$termo%"]);
$receitas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Buscar Receitas</title>
</head>
<body>
    <h1>Resultados da Busca</h1>
    <form method="get" action="buscar.php">
        <input type="text" name="q" value="<?= htmlspecialchars($termo) ?>" placeholder="Buscar receitas">
        <button type="submit">Buscar</button>
    </form>
    
    <ul>
        <?php foreach ($receitas as $receita): ?>
            <li>
                <a href="receita.php?id=<?= $receita['id'] ?>">
                    <img src="<?= $receita['imagem'] ?>" alt="<?= $receita['titulo'] ?>" width="100">
                    <h2><?= $receita['titulo'] ?></h2>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
