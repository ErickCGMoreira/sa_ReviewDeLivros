<?php 

require_once('../conexao.php');

try {
    $idproduct = $_POST['id'];


    $sql2 = "DELETE FROM review WHERE idproduct = :idproduct";
    $stmt2 = $conexao->prepare($sql2);
    $stmt2->bindParam(':idproduct', $idproduct);
    $stmt2->execute();

    $sql = "DELETE FROM product WHERE idproduct = :idproduct";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':idproduct', $idproduct);
    $stmt->execute();    
    

    echo 1;
    echo "<script>
                alert('Dados Excluidos com Sucesso!');
                location.href = 'admin.php';
         </script>";


} catch (PDOException $e) {
  
    echo "<script>
            alert('Erro ao tentar excluir os dados!'". $e->getMessage() ."');
            location.href = 'admin.php';
         </script>";

}

$conexao = null;

?>