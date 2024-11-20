<?php
// Conexão com o banco de dados SQLite
$db = new PDO('sqlite:receitas.db');

// Obtém o ID da receita pela URL
$receita_id = $_GET['id'] ?? 0;

// Envia um novo comentário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = 1; // Simula usuário logado
    $comentario = $_POST['comentario'] ?? '';
    $stmt = $db->prepare('INSERT INTO comentarios (receita_id, usuario_id, comentario) VALUES (?, ?, ?)');
    $stmt->execute([$receita_id, $usuario_id, $comentario]);
}

// Busca comentários existentes
$stmt = $db->prepare('SELECT * FROM comentarios WHERE receita_id = ? ORDER BY data DESC');
$stmt->execute([$receita_id]);
$comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Comentários</title>
</head>
<body>
    <h1>Comentários</h1>
    <form method="post">
        <textarea name="comentario" required></textarea>
        <button type="submit">Enviar</button>
    </form>
    <ul>
        <?php foreach ($comentarios as $comentario): ?>
            <li><?= htmlspecialchars($comentario['comentario']) ?> - <?= $comentario['data'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
