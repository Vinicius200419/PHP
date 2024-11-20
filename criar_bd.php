<?php
try {
    // Conecta ao banco de dados SQLite
    $db = new PDO('sqlite:receitas.db');
    
    // Criação da tabela 'receitas'
    $db->exec("
        CREATE TABLE IF NOT EXISTS receitas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            ingredientes TEXT NOT NULL,
            preparo TEXT NOT NULL,
            imagem TEXT,
            categoria TEXT
        );
    ");

    // Criação da tabela 'usuarios'
    $db->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            email TEXT UNIQUE NOT NULL,
            senha TEXT NOT NULL
        );
    ");

    // Criação da tabela 'favoritos'
    $db->exec("
        CREATE TABLE IF NOT EXISTS favoritos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            usuario_id INTEGER NOT NULL,
            receita_id INTEGER NOT NULL,
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
            FOREIGN KEY (receita_id) REFERENCES receitas(id)
        );
    ");

    // Criação da tabela 'comentarios'
    $db->exec("
        CREATE TABLE IF NOT EXISTS comentarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            receita_id INTEGER NOT NULL,
            usuario_id INTEGER NOT NULL,
            comentario TEXT NOT NULL,
            data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (receita_id) REFERENCES receitas(id),
            FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
        );
    ");

    echo "Banco de dados e tabelas criados com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao criar o banco de dados: " . $e->getMessage();
}
?>
