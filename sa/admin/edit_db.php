<?php 

require_once('../conexao.php');

try {
    
    $sql = "UPDATE product SET ISBN = :ISBN, title = :title, author = :author, 
    pdate = :pdate, publisher = :publisher, price = :price, genre = :genre, tags = :tags WHERE idproduct = :idproduct";

    $stmt = $conexao->prepare($sql);

    $stmt->bindParam(':ISBN', $ISBN, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':author', $author, PDO::PARAM_STR);
    $stmt->bindParam(':pdate', $pdate, PDO::PARAM_STR);
    $stmt->bindParam(':publisher', $publisher, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
    $stmt->bindParam(':idproduct', $idproduct, PDO::PARAM_INT);
    $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
    
    $ISBN = verificar($_POST['isbn']);
    $title = verificar($_POST['title']);
    $author = verificar($_POST['author']);
    $pdate = verificar($_POST['pdate']);
    $publisher = verificar($_POST['publisher']);
    $price = verificar($_POST['price']);
    $genre = verificar($_POST['genre']);
    $idproduct = verificar($_POST['id']);
    $tags = verificar($_POST['tags']);

    $stmt->execute();

    echo "<script>
                alert('Dados Alterados com Sucesso!');
                location.href = 'admin.php';
         </script>";

} catch (PDOException $e) {
    
    echo "ERROR!! Não foi Possível alterar os dados!! " . $e->getMessage();

}

$conexao = null;

function verificar($dados) {
    $dados = trim($dados);
    $dados = stripcslashes($dados);
    $dados = htmlspecialchars($dados);

    return $dados;
}

?>