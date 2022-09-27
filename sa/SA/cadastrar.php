<?php

    require_once '../conexao.php';
    
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    if(empty($dados["CadNome"]) || empty($dados["CadEmail"]) || empty($dados["CadSenha"])){
        $retorna = ['erro' => true, 'msg' => 'Existem campos vazios'];
    } elseif ($dados["CadSenha"] != $dados["CadSenhaconf"]){
        $retorna = ['erro' => true, 'msg' => 'As senhas não conferem'];
    } else {
        $sql = "INSERT INTO user(name, email, password) VALUES (:nome, :email, :pass)";

        $banco = $conexao->prepare($sql);

        $subNome = verificar($dados["CadNome"]);
        $subEmail = verificar($dados["CadEmail"]);
        $subSenha = hash('sha256', verificar($dados["CadSenha"]), false);

        $banco->bindParam(':nome', $subNome, PDO::PARAM_STR);
        $banco->bindParam(':email', $subEmail, PDO::PARAM_STR);
        $banco->bindParam(':pass', $subSenha, PDO::PARAM_STR);

        $banco->execute();

        if($banco->rowCount()){
            $retorna = ['erro' => false, 'msg' => 'Cadastro: sucesso', 'dados' => [$dados["CadEmail"], $dados["CadSenha"]]];
        }  else {
            $retorna = ['erro' => true, 'msg' => 'Cadastro: falha'];
        }
        
    }

    $conexao = null;
    $retorna['dados'] = $dados;
    $conexao = null;
    echo json_encode($retorna);

    function verificar($dados) {
        $dados = trim($dados);
        $dados = stripcslashes($dados);
        $dados = htmlspecialchars($dados);
    
        return $dados;
    }
?>