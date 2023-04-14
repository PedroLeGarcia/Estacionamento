// Conexão com o banco de dados
<?php
$host = "localhost";
$user = "usuario";
$pass = "senha";
$dbname = "estacionamento";

$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verificação da conexão
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Criação da tabela de vagas
$sql = "CREATE TABLE vagas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    data_nascimento DATE NOT NULL,
    tipo_vaga ENUM('Individual', 'Conveniado', 'Mensal') NOT NULL,
    entrada DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabela criada com sucesso!";
} else {
    echo "Erro ao criar a tabela: " . mysqli_error($conn);
}

// Fechamento da conexão
mysqli_close($conn);
?>