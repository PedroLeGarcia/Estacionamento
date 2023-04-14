<?php

// estabelecer a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // processar o formulário de pesquisa
    $pesquisa = $_POST["pesquisa"];

    // montar a consulta SQL para recuperar os dados do cliente
    $sql = "SELECT * FROM clientes WHERE nome LIKE :pesquisa";

    // preparar a instrução SQL
    $stmt = $pdo->prepare($sql);

    // vincular os parâmetros da consulta
    $param_pesquisa = '%' . $pesquisa . '%';
    $stmt->bindParam(":pesquisa", $param_pesquisa, PDO::PARAM_STR);

    // executar a instrução SQL
    $stmt->execute();

    // exibir os resultados da pesquisa
    echo "<table>";
    echo "<tr><th>Nome</th><th>Data de Nascimento</th><th>CPF</th><th>Placa</th><th>Tipo de Vaga</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>".$row["nome"]."</td><td>".$row["data_nascimento"]."</td><td>".$row["cpf"]."</td><td>".$row["placa"]."</td><td>".$row["tipo_vaga"]."</td></tr>";
    }
    echo "</table>";

    // fechar a instrução SQL
    unset($stmt);
}

// fechar a conexão com o banco de dados
unset($pdo);

?>
