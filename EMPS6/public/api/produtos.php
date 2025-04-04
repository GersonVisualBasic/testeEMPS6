<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once __DIR__ . "/../../empsSys/emps.php";
$emps = new empsSys();

$produtos = [
    ["id" => 1, "nome" => "Camiseta Branca", "descricao" => "100% algodão", "preco" => 59.90],
    ["id" => 2, "nome" => "Calça Jeans", "descricao" => "Denim azul escuro", "preco" => 129.90],
    ["id" => 3, "nome" => "Tênis Esportivo", "descricao" => "Confortável para corrida", "preco" => 299.99],
    ["id" => 4, "nome" => "Mochila", "descricao" => "Espaçosa com compartimento para laptop", "preco" => 149.99],
    ["id" => 5, "nome" => "Relógio Digital", "descricao" => "Resistente à água", "preco" => 199.99],
    ["id" => 6, "nome" => "Camiseta Preta", "descricao" => "100% algodão", "preco" => 79.90],
    ["id" => 7, "nome" => "Calça Jeans Slim Fit", "descricao" => "Denim azul escuro", "preco" => 115.90],
    ["id" => 8, "nome" => "Tênis Esportivo Mizuno", "descricao" => "Confortável para corrida", "preco" => 495.99],
    ["id" => 9, "nome" => "Mochila Militar", "descricao" => "Espaçosa com compartimento para laptop e equipamentos", "preco" => 195.99],
    ["id" => 10, "nome" => "Relógio Digital Casio", "descricao" => "Resistente à água e explosao nuclear", "preco" => 143.99]
];

if (isset($_GET["search"])) {
    $search = strtolower($_GET["search"]);
    $produtos = array_filter($produtos, fn($p) => str_contains(strtolower($p["nome"]), $search));
}

header("Content-Type: application/json");
echo json_encode(array_values($produtos));
