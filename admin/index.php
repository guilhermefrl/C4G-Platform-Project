<?php
session_start();
if(isset($_SESSION['u_id'])){
    require "../header/header.php";
    $session = 1;
echo '
<div id="warnings"></div>
<section class="jumbotron text-center" style="background-color:#ffffff;">
    <h1>Admin</h1>
</section>
        <section class="shadow-sm mx-auto w-75 shadow clearfix my-5 rounded bg-white p-5 resize">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#eq">Equipamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#dad">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#form">Formação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#prod">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#inst">Instituições</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#labs">Laboratórios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#gt">Grupos de tabalho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ui">Investigação</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pess">Utilizadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#serv">Serviços</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane container active" id="eq">
                    <div style="margin: 0 auto; width:100%;">';
                         require "../admin/equipamentos/index.php";echo'
                    </div>
                </div>

                <div class="tab-pane container fade" id="dad">
                    <div style="margin: 0 auto; width:100%;">';
                     require "../admin/dados/index.php";echo'
                    </div>
                </div>

                <div class="tab-pane container fade" id="form">
                    <div style="margin: 0 auto; width:100%;">';
                         require "../admin/formacao/index.php";echo'
                    </div>
                </div>

                <div class="tab-pane container fade" id="prod">
                    <div style="margin: 0 auto; width:100%;">';
                     require "../admin/produtos/index.php";echo'
                    </div>
                </div>

                <div class="tab-pane container fade" id="inst">
                    <div style="margin: 0 auto; width:100%;">';
                         require "../admin/instituicoes/index.php";echo'
                    </div>
                </div>
                <div class="tab-pane container fade" id="labs">
                    <div style="margin: 0 auto; width:100%;">';
                         require "../admin/laboratorios/index.php";echo'
                    </div>
                </div>
                <div class="tab-pane container fade" id="gt">
                    <div style="margin: 0 auto; width:100%;">';
                         require "../admin/grupos/index.php";echo'
                    </div>
                </div>
                <div class="tab-pane container fade" id="ui">
                    <div style="margin: 0 auto; width:100%;">';
                         require "../admin/unidades/index.php";echo'
                    </div>
                </div>
                <div class="tab-pane container fade" id="pess">
                    <div style="margin: 0 auto; width:100%;">';
                         require "../admin/pessoal/index.php";echo'
                    </div>
                </div>
                <div class="tab-pane container fade" id="serv">
                    <div style="margin: 0 auto; width:100%;">';
                         require "../admin/servicos/index.php";echo'
                    </div>
                </div>
            </div>
            <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  \'use strict\';
  window.addEventListener(\'load\', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName(\'needs-validation\');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener(\'submit\', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add(\'was-validated\');
      }, false);
    });
  }, false);
})();
</script>

</body>
</html>';
}else{
    header("Location: ../login/");
}
