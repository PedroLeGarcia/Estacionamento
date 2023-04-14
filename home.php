<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    // Se o usuário não está logado, redireciona para a página de login
    header("Location: login.php");
    exit;
}

require_once("db.php");

$sql = "SELECT * FROM clientes";
$stmt = $conn->prepare($sql);
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Clientes - Estacionamento</title>
    <h1>Buscar Cliente</h1>
    <form method="post" action="buscar_cliente.php">
        <label for="pesquisa">Pesquisar por nome:</label>
        <input type="text" id="pesquisa" name="pesquisa">
        <br><br>
        <button type="submit">Pesquisar</button>
    </form>

</head>
<body>
    <h1>Clientes - Estacionamento</h1>
    <p><a href="logout.php">Sair</a></p>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Placa</th>
                <th>Tipo de Vaga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente) { ?>
                <tr>
                    <td><?php echo $cliente["codigo"]; ?></td>
                    <td><?php echo $cliente["nome"]; ?></td>
                    <td><?php echo $cliente["data_nascimento"]; ?></td>
                    <td><?php echo $cliente["cpf"]; ?></td>
                    <td><?php echo $cliente["placa"]; ?></td>
                    <td><?php echo $cliente["tipo_vaga"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
