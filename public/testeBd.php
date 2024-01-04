<?php 

/*
* Criado este arquivo para efetuar teste CRUD no banco de dados
*/
include './../app/Libraries/Database.php';
// Inicialização da classe Database
$db = new Database;

// Define o fuso horário padrão para funções de data e hora no script para "America/Sao_Paulo"
date_default_timezone_set('America/Sao_Paulo');

/*
*Inserindo Dados

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

*/

//UPDATE

// Dados a serem inseridos no banco de dados
$id = 2;
$usuarioId = 100;
$titulo = 'Titulo do post Teste UPDATE';
$texto = 'Texto do post de Teste ATUALIZADO';
//$criado_em = '2024-01-03 06:58:16'; Utilizando o horario atual
$criado_em = date('Y-m-d H:i:s');

// Preparação da consulta SQL usando placeholders
$db -> query("UPDATE posts SET usuario_id = :usuario_id, titulo = :titulo, texto = :texto, criado_em = :criado_em WHERE id = :id");
// Associação de valores aos placeholders
$db->bind(":id", $id);
$db->bind(":usuario_id", $usuarioId);
$db->bind(":titulo", $titulo);
$db->bind(":texto", $texto);
$db->bind(":criado_em", $criado_em);

// Execução da consulta SQL
$db -> executa();


// Exibição do total de resultados afetados pela última consulta
echo '<hr> Total Resultados: '. $db -> totalResultados();

?>