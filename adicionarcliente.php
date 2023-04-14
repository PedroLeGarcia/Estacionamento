<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // verificar se o campo 'nome' foi preenchido
    if (empty(trim($_POST["nome"]))) {
        $nome_err = "Por favor, insira um nome.";
    } else {
        $nome = trim($_POST["nome"]);
    }

    // verificar se o campo 'data_nascimento' foi preenchido e se é uma data válida
    if (empty(trim($_POST["data_nascimento"]))) {
        $data_nascimento_err = "Por favor, insira uma data de nascimento.";
    } else {
        $data_nascimento = trim($_POST["data_nascimento"]);
        if (!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $data_nascimento)) {
            $data_nascimento_err = "Por favor, insira uma data de nascimento válida no formato AAAA-MM-DD.";
        }
    }

    // verificar se o campo 'cpf' foi preenchido e se é um CPF válido
    if (empty(trim($_POST["cpf"]))) {
        $cpf_err = "Por favor, insira um CPF.";
    } else {
        $cpf = trim($_POST["cpf"]);
        if (!preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/", $cpf)) {
            $cpf_err = "Por favor, insira um CPF válido no formato XXX.XXX.XXX-XX.";
        }
    }

    // verificar se o campo 'placa' foi preenchido e se é uma placa válida
    if (empty(trim($_POST["placa"]))) {
        $placa_err = "Por favor, insira uma placa.";
    } else {
        $placa = trim($_POST["placa"]);
        if (!preg_match("/^[A-Z]{3}-[0-9]{4}$/", $placa)) {
            $placa_err = "Por favor, insira uma placa válida no formato XXX-9999.";
        }
    }

    // verificar se o campo 'tipo_vaga' foi selecionado
    if (empty(trim($_POST["tipo_vaga"]))) {
        $tipo_vaga_err = "Por favor, selecione um tipo de vaga.";
    } else {
        $tipo_vaga = trim($_POST["tipo_vaga"]);
    }

    // se não houver erros de validação, inserir os dados no banco de dados
    if (empty($nome_err) && empty($data_nascimento_err) && empty($cpf_err) && empty($placa_err) && empty($tipo_vaga_err)) {
        // incluir o arquivo de configuração do banco de dados
        require_once "config.php";

        // preparar a instrução SQL para inserir os dados na tabela clientes
        $sql = "INSERT INTO clientes (nome, data_nascimento, cpf, placa, tipo_vaga) VALUES (:nome, :data_nascimento, :cpf, :placa, :tipo_vaga)";
        $stmt = $pdo->prepare($sql);

        // vincular os parâmetros
        $stmt->bindParam(":nome", $param_nome);
        $stmt->bindParam(":data_nascimento", $param_data_nascimento);
        $stmt->bindParam(":cpf", $param_cpf);
        $stmt->bindParam(":placa", $param_placa);
        $stmt->bindParam(":tipo_vaga", $param_tipo_vaga);

        // definir os parâmetros
        $param_nome = $nome;
        $param_data_nascimento = $data_nascimento;
        $param_cpf = $cpf;
        $param_placa = $placa;
        $param_tipo_vaga = $tipo_vaga;
    
        // executar a instrução SQL
        if ($stmt->execute()) {
            // redirecionar para a página principal
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    
        // fechar a conexão com o banco de dados
        unset($pdo);
    }
}
?>
