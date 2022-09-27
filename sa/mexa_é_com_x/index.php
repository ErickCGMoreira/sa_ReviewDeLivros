<?php
  require_once 'conexao.php';
  $prodid = 0;
  $produtos = array();
?>
<div class="modal fade popup" id="CadJanela" tabindex="-1" aria-labelledby="CadJanelaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        
          <div class="modal-header">
            <?php
              try {
                $sql = "SELECT * FROM product order by title asc WHERE idproduct = $prodid";
                $stmt = $conexao->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
            
                foreach ($lista as $linha) {
                    echo "<img class='capa' width='200' height='300' src='".$linha['img']."'>
            Genêro: ".$linha['genre']." <br>
            Autor: ".$linha['author']." <br>
            Editora: ".$linha['publisher']." <br>
            Lançamento: ".$linha['pdate']." <br>
            ISBN: ".$linha['isbn']." <br>
            <br>
            ".$linha['synopsis']."
            <br><br>
          

          </div>
<div class='modal-body'>  Preço médio<br>
            Livro:".$linha['price']."</div>";
                }
            
              } catch (PDOException $e) {
                  echo "Ocorreu um erro ao tentar Buscar Todos. " . $e->getMessage();
              }
            ?>
          <div class="modal-footer">
                <?php
              try {
                $sql = "SELECT * FROM review JOIN user on review.iduser = user.iduser WHERE idproduct = $prodid";
                $stmt = $conexao->query($sql);
                $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $list = array();
            
                foreach ($lista as $linha) {
                    echo "Nota: ".$linha['score']."
            Por: ".$linha['name']." <br>
            ".$linha['text']."";
                }
            
              } catch (PDOException $e) {
                  echo "Ocorreu um erro ao tentar Buscar Todos. " . $e->getMessage();
              }
            ?>
            </div>
        <div id="feed">
              <form id="FBUsuario">
                <label for="caixaFB" class="coment_fb">Deixe sua nota e comentário:</label>
                <select name="score" class="" required>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5" selected="selected"> 5 </option>
                </select>
                <input type="text" name="caixaFB" class="caixaFB" required>
                <label class="msg-fb"></label>
                <input type="submit" class="btn btn-success" class="btn-SubmitFB" value="Enviar" />
              </form>
            </div>
        
      </div>
    </div>
  </div>
    <?php
    try {
      $sql = "SELECT * FROM product order by title asc";
      $stmt = $conexao->query($sql);
      $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $list = array();

      foreach ($lista as $linha) {
          echo "<button type='button' class='btn btn-dark btn-lg' data-bs-toggle='modal' data-bs-target='#CadJanela' onclick='prodid = ".$lista['idproduct']."'>
      <div class='produto'>
        <h3>".$linha['title']."</h3>
        <img src='".$linha['img']."' alt='Imagem do livro'><br/>
        <p>Gênero: ".str_replace('&', ', ', $linha['genre'])." <br/>
            Autor: ".$linha['author']."
        </p>
        
      </div>
  </button>";
      }

  } catch (PDOException $e) {
      echo "Ocorreu um erro ao tentar Buscar Todos." . $e->getMessage();
  }
  ?>