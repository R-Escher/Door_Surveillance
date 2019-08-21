<!doctype html>
<html lang="pt-BR">
  <?php include_once 'head.html'; ?>
  <body>

        <div class="d-flex toggled" id="wrapper" display="inline-block">

            <!-- Sidebar--> 
            <div class="bg-dark" id="sidebar-wrapper">
                <div class="sidebar-heading" style="background-color: #1a1d20; color: #eaebeb; padding: 0px 16px"></div>
                <div class="list-group list-group-flush" >
                <a href="index.php" class="list-group-item list-group-item-action bg-dark" id="cadastro-toggle" style="color: #c2c3c5">Cadastro</a>
                <a href="registros.php" class="list-group-item list-group-item-action bg-dark" id="registros-toggle" style="color: #c2c3c5">Registros</a>
                <a href="userCadastrados.php" class="list-group-item list-group-item-action bg-dark" id="userCadastrados-toggle" style="color: #c2c3c5">Usuários Cadastrados</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">

                <!-- navbar superior -->
                <nav class="navbar navbar-expand-lg navbar-light border-bottom" style="background-color: #1a1d20; color: #eaebeb; padding: 7.2px 16px; ">
                    <button class="btn btn-dark" id="menu-toggle" style="padding: 3px 9px"><i class="fas fa-bars fa-2x"></i></button>

                    <div class="collapse navbar-collapse pl-3" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        </ul>
                    </div>
                </nav> 
