<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera as credenciais de login enviadas pelo formulário
    $username = $_POST["username"];
    $password = $_POST["password"];

// obter dados do formulário de login
$email = $_POST['email'];
$senha = $_POST['senha'];

// obter dados do cliente com base no email
$sql = "SELECT * FROM clientes WHERE email = '$email'";
// restante do código aqui

// verificar a senha
if (password_verify($senha, $cliente['senha'])) {
    // login bem sucedido
} else {
    // senha incorreta
}

    // Verifica se as credenciais são válidas
    if ($username == "usuario" && $password == "senha") {
        // Se as credenciais são válidas, cria uma variável de sessão indicando que o usuário está logado
        $_SESSION["logged_in"] = true;

        // Redireciona o usuário para a página principal do site
        header("Location: index.php");
    } else {
        // Se as credenciais são inválidas, exibe uma mensagem de erro e redireciona o usuário para a página de login novamente
        $_SESSION["login_error"] = "Usuário ou senha incorretos.";
        header("Location: login.php");
    }
}
?>
