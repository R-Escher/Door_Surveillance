<?php
  error_reporting(E_ERROR | E_PARSE);
  include 'index-include/sidenav.php';
  $tagId = "79379111"
?>

<div class="container">
<!--Cadastro -->
  <div class="row" id="cadastro-login">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Cadastro</h5>
          <form class="form-signin" action="config/sessao.php" method="post">
            <div class="form-label-group">

              <label for="inputCpf">TagID</label>
              <input name="usuario" type="" id="inputCpf" class="form-control" placeholder=<?php echo $tagId;?> disabled autofocus>
            </div>

            <div class="form-label-group">
              <label for="inputPassword">Digite o seu nome</label>
              <input name="senha" type="nome" id="inputPassword" class="form-control" placeholder="Nome" required>
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

<?php include_once 'footer.php'; ?>

</html>