<?php 

/*
* Criado este arquivo para efetuar teste CRUD no banco de dados
*/
include './../app/Libraries/Database.php';
// Inicialização da classe Database
$db = new Database;

// Dados a serem inseridos no banco de dados
$usuarioId = 10;
$titulo = 'Titulo do post Teste';
$texto = 'Texto do post de Teste';

// Preparação da consulta SQL usando placeholders
$db -> query("INSERT INTO posts (usuario_id, titulo, texto) VALUES (:usuario_id, :titulo, :texto)");
// Associação de valores aos placeholders
$db->bind(":usuario_id", $usuarioId);
$db->bind(":titulo", $titulo);
$db->bind(":texto", $texto);

// Execução da consulta SQL
$db -> executa();


// Exibição do total de resultados afetados pela última consulta
echo '<hr> Total Resultados: '. $db -> totalResultados();
// Exibição do último ID inserido durante a última consulta INSERT
echo '<hr> Último id: '. $db -> ultimoIdInserido();
?>