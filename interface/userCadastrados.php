<?php
    include 'includes/sidenav.php';
    include_once $raiz.'/config/universal.php';
?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->

<div class="container-fluid" style="padding: 30px 20px;">
    <div id="registros">
        <div>
            <table class="table table-hover table-bordered table-striped table-dark text-center">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">tagID</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de Cadastro</th>
                </tr>
            </thead>
            <tbody id="mostraUsers">
            <!-- aqui mostra os dados de cada cadastro -->
            
                <?php
                    $universal->mostraUsuariosCadastrados();
                ?>

            </tbody>
            </table>
        </div>
    </div>
</div>
</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->

<?php include_once 'includes/footer.php'; ?>