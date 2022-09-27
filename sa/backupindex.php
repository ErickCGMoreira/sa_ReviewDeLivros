<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>AdoroLivros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>

  <header class="position-relative">
    <img src="logo.png" alt="">
    <h3 id="nome">AdoroLivros</h3>
    <nav>
      <a href="#footer">Contato</a>
    </nav>
    <div id="aba_user"></div>
  </header>
  <?php
  require_once 'conexao.php';
  $prodid = 1;
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
          echo "<button type='button' class='btn btn-dark btn-lg' data-bs-toggle='modal' data-bs-target='#CadJanela>
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

    <footer id="footer">
      <div class="row v">
        <div class='dados'>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-telephone-fill icon_footer" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
              d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
          </svg>
          <h3>31 99999-9999</h3>
        </div>
        <div class='dados'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-envelope-fill icon_footer" viewBox="0 0 16 16">
            <path
              d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
          </svg>
          <h3> adorolivros@gmail.com</h3>
        </div>
        <div class="dados"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class='bi bi-house-door-fill icon_footer ' viewBox="0 0 16 16">
            <path
              d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />

          </svg>
          <h3> Av. Afonso Pena n° 1500</h3>
        </div>

        <div>
          <div class='redes'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-twitter redes_sociais" viewBox="0 0 16 16">

              <path
                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-facebook redes_sociais" viewBox="0 0 16 16">
              <path
                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-instagram redes_sociais" viewBox="0 0 16 16">
              <path
                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
            </svg>
          </div>
        </div>
      </div>
  </div>

  </footer>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
    crossorigin="anonymous"></script>

  <script src="script.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css" />

</body>

</html>