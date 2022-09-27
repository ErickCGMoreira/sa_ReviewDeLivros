<?php

    require_once '../conexao.php';

try{
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(empty($dados["LogEmail"]) || empty($dados["LogSenha"])){
        $retorna = ['logado' => false, 'msg' => 'Existem campos vazios'];
    } else {
        $sql = "SELECT * from user";
    
        $banco = $conexao->prepare($sql);
        $banco->execute();

        $x = $banco->setFetchMode(PDO::FETCH_ASSOC);
        
        foreach ($banco->fetchAll() as $x => $linha) {
            if($linha['email'] == $dados['LogEmail'] && $linha['password'] == hash('sha256',$dados['LogSenha'],false)){
                if($linha['iduser'] == 1){
                    $retorna = ['logado' => true, 'msg' => 'Usuário logado com sucesso', 'dados' => ['iduser' => $linha['iduser'], 'name' => $linha['name'], 'email' => $linha['email'], 'master' => true]];
                } else {
                    $retorna = ['logado' => true, 'msg' => 'Usuário logado com sucesso', 'dados' => ['iduser' => $linha['iduser'], 'name' => $linha['name'], 'email' => $linha['email'], 'master' => false]];
                }
                break;
            } else {
                $retorna = ['logado' => false, 'msg' => 'Usuário e/ou senha inválido'];
            }
        }
    }
    $conexao = null;
    echo json_encode($retorna);

} catch(PDOException $erro) {
    $conexao = null;
    $retorna = ['logado' => false, 'msg' => $erro];
} catch(Exception $erro) {
    $conexao = null;
    $retorna = ['logado' => false, 'msg' => $erro];
}

?>