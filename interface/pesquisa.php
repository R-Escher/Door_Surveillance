<?php
  error_reporting(E_ERROR | E_PARSE);
  include 'includes/sidenav.php';
  $tagId = "79379111"
?>

<?php
if(isset($_POST['sessao'])){
  $key =  $_POST['usuario'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //$key = test_input($_POST["key"]);
  session_start();
  $_SESSION['key'] = $key;
  //header('Location: database.php');
  //die;
  include_once '../database/database.php';
  $err = $DB->verifica($key);
  if ($err == null){
      echo 'Usuário não encontrado';
  } else {
      echo 'Usuário encontrado';
  }

}

?>




<div class="container">
<!--Cadastro -->
  <div class="row" id="cadastro-login">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Pesquisa</h5>
          <form class="form-signin" action="" method="post">
            <div class="form-label-group">

              <label for="inputCpf">TagID</label>
              <input name="usuario" type="nome" id="inputCpf" class="form-control" placeholder="TagId" required>
            </div>

            <input type="hidden" name="sessao" value="cadastro">

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->

<?php include_once 'includes/footer.php'; ?>