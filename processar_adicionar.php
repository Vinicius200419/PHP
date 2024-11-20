<?php
try {
    // Conexão com o banco de dados SQLite
    $db = new PDO('sqlite:receitas.db');
    
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'] ?? '';
    $ingredientes = $_POST['ingredientes'] ?? '';
    $preparo = $_POST['preparo'] ?? '';
    $imagem = $_POST['imagem'] ?? '';
    $categoria = $_POST['categoria'] ?? '';

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (empty($titulo) || empty($ingredientes) || empty($preparo)) {
        die("Preencha todos os campos obrigatórios.");
    }

    // Insere a nova receita no banco de dados
    $stmt = $db->prepare('
        INSERT INTO receitas (titulo, ingredientes, preparo, imagem, categoria)
        VALUES (?, ?, ?, ?, ?)
    ');
    $stmt->execute([$titulo, $ingredientes, $preparo, $imagem, $categoria]);

    echo "Receita adicionada com sucesso!<br>";
    echo "<a href='index.php'>Voltar à página inicial</a>";
} catch (PDOException $e) {
    echo "Erro ao adicionar a receita: " . $e->getMessage();
}
?>
