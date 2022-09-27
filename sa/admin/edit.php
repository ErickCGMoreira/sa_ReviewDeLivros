<?php require_once('../conexao.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Editar Dados </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

    <?php 
    
    try {
       
        $sql = "SELECT * FROM product WHERE idproduct = :idproduct";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idproduct', $idproduct, PDO::PARAM_INT);

        $idproduct = $_POST['id'];
        $stmt->execute();

        $dados = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($stmt->fetchAll() as $dados => $linha) {
            
            $idproduct = $linha['idproduct'];
            $isbn = $linha['ISBN'];
            $title = $linha['title'];
            $author = $linha['author'];
            $publisher = $linha['publisher'];
            $pdate = $linha['pdate'];
            $price = $linha['price'];
            $genre = $linha['genre'];
            $tags = $linha['tags'];

        }

    } catch (PDOException $e) {
        
        echo $e->getMessage();
    }
    
    ?>

    <h2> Editar Dados </h2>

    <form action="edit_db.php" method="post" name="cad">

        <label> title: </label>
        <input type="hidden" name="id" id="id" value="<?php echo $idproduct ?>"/>
        <input type="text" name="title" id="title" value="<?php echo $title ?>" required/>
        <br/> <br/>
        <label> isbn: </label>
        <input type="text" name="isbn" id="isbn" value="<?php echo $isbn ?>" required/>
        <br/> <br/>
        <label> Publisher Date: </label>
        <input type="date" name="pdate" id="pdate" value="<?php echo $pdate ?>" required/>
        <br/> <br/>
        <label> author: </label>
        <input type="text" name="author" id="author" value="<?php echo $author ?>" required/>
        <br/> <br/>
        <label> publisher: </label>
        <input type="text" name="publisher" id="publisher" value="<?php echo $publisher ?>" required/>
        <br/> <br/>
        <label> price: </label>
        <input type="text" name="price" id="price" value="<?php echo $price ?>" required/>
        <br/> <br/>
        <label> genre: </label>
        <input type="text" name="genre" id="genre" value="<?php echo $genre ?>" required/>
        <br/> <br/>
        <label> tags: </label>
        <input type="text" name="tags" id="tags" value="<?php echo $tags ?>" required/>
        <br/> <br/>
        <input type="submit" name="enviar" id="enviar" value="ALTERAR DADOS"/>

    </form>

    </body>
</html>