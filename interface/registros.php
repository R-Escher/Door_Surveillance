<?php
include 'includes/sidenav.php';
?>
<!-- Tags em aberto: <html>, <body>, <div class="d-flex" id="wrapper">, <div id="page-content-wrapper"> -->

<div class="container-fluid" style="padding: 30px 20px;">

    <div id="registros">
        <div>
            <table class="table table-hover table-bordered table-striped table-dark text-center">
            <thead>
                <tr>
                <th scope="col">Nome</th>
                <th scope="col">tagID</th>
                <th scope="col">Estado</th>
                <th scope="col">Data</th>
                </tr>                
            </thead>
            <tbody id="mostraRegistos">
                <!-- aqui mostra os dados de cada cadastro -->

                <?php
                    //echo "<tr><th>Id</th></tr>";
                    class TableRows extends RecursiveIteratorIterator { 
                        function __construct($it) { 
                            parent::__construct($it, self::LEAVES_ONLY); 
                        }

                        function current() {
                            return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
                        }

                        function beginChildren() { 
                            echo "<tr>"; 
                        } 

                        function endChildren() { 
                            echo "</tr>" . "\n";
                        } 
                    } 

                    include_once 'database.php';

                    $stmt = $database->prepare("SELECT nome,tagId,estado,data FROM registros");
                    $stmt->execute();
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

                    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                        echo $v;
                    }
                ?>

            </tbody>
            </table>
        </div>
    </div>
</div>
</div> <!-- / id="page-content-wrapper" | todo o conteúdo deve ficar aqui dentro -->
</div> <!-- / class="d-flex" id="wrapper" -->

<?php include_once 'includes/footer.php'; ?>