<?php
// definir as informações de conexão com o banco de dados
$servername = "localhost";
$username = "usuario";
$password = "senha";
$dbname = "estacionamento";

// criar uma conexão com o banco de dados
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // definir o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // criar a tabela clientes
    $sql = "CREATE TABLE clientes (
        codigo INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(50) NOT NULL,
        data_nascimento DATE NOT NULL,
        cpf VARCHAR(11) NOT NULL,
        ALTER TABLE clientes ADD senha VARCHAR(255) NOT NULL;
        placa VARCHAR(7) NOT NULL,
        tipo_vaga ENUM('Individuais', 'Conveniados', 'Mensais') NOT NULL
    )";
    // executar a query SQL
    $conn->exec($sql);
    echo "Tabela criada com sucesso!";
} catch(PDOException $e) {
    echo "Erro ao criar a tabela: " . $e->getMessage();
}

// Inserção dos clientes
$clientes = [
    [
        "nome" => "Cliente 1 Individual",
        "cpf" => "111.111.111-11",
        "placa" => "ABC-1234",
        "tipo_vaga" => "Individual"
    ],
    [
        "nome" => "Cliente 2 Individual",
        "cpf" => "222.222.222-22",
        "placa" => "DEF-5678",
        "tipo_vaga" => "Individual"
    ],
    [
        "nome" => "Cliente 3 Individual",
        "cpf" => "333.333.333-33",
        "placa" => "GHI-9012",
        "tipo_vaga" => "Individual"
    ],
    [
        "nome" => "Cliente 4 Individual",
        "cpf" => "444.444.444-44",
        "placa" => "JKL-3456",
        "tipo_vaga" => "Individual"
    ],
    [
        "nome" => "Cliente 5 Individual",
        "cpf" => "555.555.555-55",
        "placa" => "MNO-7890",
        "tipo_vaga" => "Individual"
    ],
    [
        "nome" => "Cliente 6 Individual",
        "cpf" => "666.666.666-66",
        "placa" => "PQR-1234",
        "tipo_vaga" => "Individual"
    ],
    [
        "nome" => "Cliente 7 Individual",
        "cpf" => "777.777.777-77",
        "placa" => "STU-5678",
        "tipo_vaga" => "Individual"
    ],
    [
        "nome" => "Cliente 1 Conveniado",
        "cpf" => "888.888.888-88",
        "placa" => "VWX-9012",
        "tipo_vaga" => "Conveniado"
    ],
    [
        "nome" => "Cliente 2 Conveniado",
        "cpf" => "999.999.999-99",
        "placa" => "YZA-3456",
        "tipo_vaga" => "Conveniado"
    ],
    [
        "nome" => "Cliente 3 Conveniado",
        "cpf" => "303.303.303-33",
        "placa" => "BCD-7890",
        "tipo_vaga" => "Conveniado"
    ],
    [
        "nome" => "Cliente 4 Conveniado",
        "cpf" => "101.101.101-10",
        "placa" => "DEF-1234",
        "tipo_vaga" => "Conveniado"
    ],
    [
        "nome" => "Cliente 5 Conveniado",
        "cpf" => "202.202.202-20",
        "placa" => "GHI-5678",
        "tipo_vaga" => "Conveniado"
    ],
    [
        "nome" => "Cliente 6 Conveniado",
        "cpf" => "303.303.303-30",
        "placa" => "JKL-9012",
        "tipo_vaga" => "Conveniado"
    ],
    [
        "nome" => "Cliente 7 Conveniado",
        "cpf" => "404.404.404-40",
        "placa" => "MNO-3456",
        "tipo_vaga" => "Conveniado"
    ],
    [
        "nome" => "Cliente 1 Mensal",
        "cpf" => "505.505.505-50",
        "placa" => "PQR-7890",
        "tipo_vaga" => "Mensal"
    ],
    [
        "nome" => "Cliente 2 Mensal",
        "cpf" => "606.606.606-60",
        "placa" => "STU-1234",
        "tipo_vaga" => "Mensal"
    ],
    [
        "nome" => "Cliente 3 Mensal",
        "cpf" => "707.707.707-70",
        "placa" => "VWX-5678",
        "tipo_vaga" => "Mensal"
    ],
    [
        "nome" => "Cliente 4 Mensal",
        "cpf" => "808.808.808-80",
        "placa" => "YZA-9012",
        "tipo_vaga" => "Mensal"
    ],
    [
        "nome" => "Cliente 5 Mensal",
        "cpf" => "909.909.909-90",
        "placa" => "BCD-3456",
        "tipo_vaga" => "Mensal"
    ],
    [
        "nome" => "Cliente 6 Mensal",
        "cpf" => "101.010.101-01",
        "placa" => "DEF-7890",
        "tipo_vaga" => "Mensal"
    ],
    [
        "nome" => "Cliente 7 Mensal",
        "cpf" => "202.020.202-02",
        "placa" => "GHI-1234",
        "tipo_vaga" => "Mensal"
    ],
];

foreach ($clientes as $cliente) {
    $sql = "INSERT INTO clientes (nome, cpf, placa, tipo_vaga, created_at, updated_at) VALUES (:nome, :cpf, :placa, :tipo_vaga, NOW(), NOW())";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":nome", $cliente["nome"]);
    $stmt->bindParam(":cpf", $cliente["cpf"]);
    $stmt->bindParam(":placa", $cliente["placa"]);
    $stmt->bindParam(":tipo_vaga", $cliente["tipo_vaga"]);
    $stmt->bindParam(":senha", $cliente["senha"]);

    $stmt->execute();
}


// fechar a conexão com o banco de dados
$conn = null;
?>