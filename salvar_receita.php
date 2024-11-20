<?php
// Conexão com o banco de dados SQLite
$db = new PDO('sqlite:receitas.db');

// Simula o ID do usuário logado
$usuario_id = 1;

// Obtém o ID da receita pela URL
$receita_id = $_GET['id'] ?? 0;

// Verifica se a receita já está salva
$stmt = $db->prepare('SELECT * FROM favoritos WHERE usuario_id = ? AND receita_id = ?');
$stmt->execute([$usuario_id, $receita_id]);

if ($stmt->fetch()) {
    // Remove dos favoritos
    $stmt = $db->prepare('DELETE FROM favoritos WHERE usuario_id = ? AND receita_id = ?');
    $stmt->execute([$usuario_id, $receita_id]);
    echo "Receita removida dos favoritos.";
} else {
    // Adiciona aos favoritos
    $stmt = $db->prepare('INSERT INTO favoritos (usuario_id, receita_id) VALUES (?, ?)');
    $stmt->execute([$usuario_id, $receita_id]);
    echo "Receita salva nos favoritos.";
}
?>
