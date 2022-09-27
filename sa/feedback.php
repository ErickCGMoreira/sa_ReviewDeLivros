<?php

    require_once 'conexao.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(empty($dados['caixaFB'])){
        $retorna = ['erro' => true,'msg' => 'Por favor insira algo no comentário'];
    } elseif (empty($dados['iduser'])) {
        $retorna = ['erro' => true,'msg' => 'Usuário não logado'];
    } elseif(empty($dados['score'])){
        $retorna = ['erro' => true,'msg' => 'Avaliação não selecionada'];
    }else {
        
        $sql = "INSERT INTO review(idproduct, iduser, score, text) VALUES (:produto, :usuario, :score, :texto)";

        $banco = $conexao->prepare($sql);

        $banco->bindParam(':produto', $dados['idproduct'], PDO::PARAM_STR);
        $banco->bindParam(':usuario', $dados['iduser'], PDO::PARAM_STR);
        $banco->bindParam(':score', $dados['score'], PDO::PARAM_STR);
        $banco->bindParam(':texto', $dados['caixaFB'], PDO::PARAM_STR);

        $banco->execute();

        $retorna = ['erro' => false, 'msg' => 'Registrado com sucesso'];
    
    }
    $conexao = null;
    echo json_encode($retorna);

?>