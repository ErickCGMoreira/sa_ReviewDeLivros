<?php

    require_once 'conexao.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (isset($POST["submit"])){
        $img  = $_FILES["img"];
        $fileName = $_FILES["img"]["name"];
        $fileTmpName = $_FILES["img"]["tmp_name"];
        $fileSize = $_FILES["img"]["size"];
        $fileError = $_FILES["img"]["error"];
        $fileType = $_FILES["img"]["type"];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        if (in_array($fileActualExt, $allowed)){
            if ($fileError === 0){
                if ($fileSize < 2000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = "uploads/".$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    header("Location: test.html");
                } else {
                    echo "A imagem é muito grande. ";
                }
            } else {
                echo "Ouve um erro no upload. ";
            }
        } else {
            echo "Não é permitido imagens deste tipo. ";
        }

        try{
            $sql = "INSERT INTO product (isbn, title, author, publisher, pdate, price, genre, tags, synopsis, img) VALUES (:isbn, :title, :author, :publisher, :pdate, :price, :genre, :tags, :synopsis, :img)";
    
            $banco = $conexao->prepare($sql);
    
            $banco->bindParam(':isbn', $dados['isbn'], PDO::PARAM_STR);
            $banco->bindParam(':title', $dados['title'], PDO::PARAM_STR);
            $banco->bindParam(':author', $dados['author'], PDO::PARAM_STR);
            $banco->bindParam(':publisher', $dados['publisher'], PDO::PARAM_STR);
            $banco->bindParam(':pdate', $dados['pdate'], PDO::PARAM_STR);
            $banco->bindParam(':price', $dados['price'], PDO::PARAM_STR);
            $banco->bindParam(':genre', $dados['genre'], PDO::PARAM_STR);
            $banco->bindParam(':tags', $dados['tags'], PDO::PARAM_STR);
            $banco->bindParam(':synopsis', $dados['sinopsis'], PDO::PARAM_STR);
            $banco->bindParam(':img', $fileDestination, PDO::PARAM_STR);
    
            $banco->execute();
    
        } catch(PDOException $erro) {
            
            echo "Ocorreu um erro no DB: " . $erro;
            
        }

    }

?>