<?php
// Conexão com o banco de dados SQLite
$db = new PDO('sqlite:receitas.db');

// Busca receitas do banco de dados
$query = $db->query('SELECT id, titulo, imagem FROM receitas LIMIT 10');
$receitas = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Receitas em Destaque</h1>
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
