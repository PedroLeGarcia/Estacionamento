<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processar os dados do formulário
$nome = $_POST["nome"];
$data_nascimento = $_POST["data_nascimento"];
$tipo_vaga = $_POST["tipo_vaga"];
$senha = $_POST['senha'];
// Adicione outros campos do formulário conforme necessário

// criptografar a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);
// Validar os dados
if (empty($nome) || empty($data_nascimento) || empty($tipo_vaga)) {
    echo "Por favor, preencha todos os campos obrigatórios.";
} else {
    // Inserir os dados na tabela "clientes"
    $sql = "INSERT INTO clientes (nome, data_nascimento, tipo_vaga, senha) VALUES ('$nome', '$data_nascimento', '$tipo_vaga', '$senha_hash')";
    // Adicione outras colunas e valores conforme necessário
    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso.";
    } else {
        echo "Erro ao realizar cadastro: " . $conn->error;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
