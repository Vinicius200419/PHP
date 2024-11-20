<?php
// Conexão com o banco de dados SQLite
$db = new PDO('sqlite:receitas.db');

// Obtém o ID da receita pela URL
$id = $_GET['id'] ?? 0;

// Busca os detalhes da receita
$stmt = $db->prepare('SELECT * FROM receitas WHERE id = ?');
$stmt->execute([$id]);
$receita = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$receita) {
    die("Receita não encontrada.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= $receita['titulo'] ?></title>
</head>
<body>
    <h1><?= $receita['titulo'] ?></h1>
    <img src="<?= $receita['imagem'] ?>" alt="<?= $receita['titulo'] ?>" width="300">
    <h2>Ingredientes</h2>
    <p><?= nl2br($receita['ingredientes']) ?></p>
    <h2>Modo de Preparo</h2>
    <p><?= nl2br($receita['preparo']) ?></p>
    
    <a href="salvar_receita.php?id=<?= $receita['id'] ?>">Salvar Receita</a>
    <a href="comentarios.php?id=<?= $receita['id'] ?>">Comentários</a>
</body>
</html>
