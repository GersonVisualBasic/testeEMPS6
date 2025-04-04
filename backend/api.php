<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}


$produtos = [
    ["id" => 1, "nome" => "Camiseta Branca", "descricao" => "100% algodão", "preco" => 59.90],
    ["id" => 2, "nome" => "Calça Jeans", "descricao" => "Denim azul escuro", "preco" => 129.90],
    ["id" => 3, "nome" => "Tênis Esportivo", "descricao" => "Confortável para corrida", "preco" => 299.99],
    ["id" => 4, "nome" => "Mochila", "descricao" => "Espaçosa com compartimento para laptop", "preco" => 149.99],
    ["id" => 5, "nome" => "Relógio Digital", "descricao" => "Resistente à água", "preco" => 199.99]
];

if (isset($_GET["search"])) {
    $search = strtolower($_GET["search"]);
    $produtos = array_filter($produtos, fn($p) => str_contains(strtolower($p["nome"]), $search));
}

echo json_encode(array_values($produtos));
