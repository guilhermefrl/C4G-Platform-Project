<?php
require "../header/header.php";

if (isset($_SESSION['u_id'])){
    if(isset($_GET['success'])){
        echo '<div class="alert alert-success fade show position-fixed mw-25" style="right:20px;bottom:20px;z-index:100;" role="alert">Dados alterados com sucesso.</div>';
        echo '<script>window.setTimeout(function(){$(\'.alert\').alert(\'close\');},1500);</script>';
    }
    if(isset($_GET['usertaken'])){
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="right:20px;bottom:20px;z-index:100;" role="alert">Nome de utilizador já escolhido.</div>';
        echo '<script>window.setTimeout(function(){$(\'.alert\').alert(\'close\');},1500);</script>';
    }
    if(isset($_GET['success'])){
        echo '<div class="alert alert-success fade show position-fixed mw-25" style="right:20px;bottom:20px;z-index:100;" role="alert">Dados alterados com sucesso.</div>';
        echo '<script>window.setTimeout(function(){$(\'.alert\').alert(\'close\');},1500);</script>';
    }
    if(isset($_GET['error'])){
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="right:20px;bottom:20px;z-index:100;" role="alert">Ocorreu um erro ';
        if($_GET['error'] == "select"){
            echo 'ao selecionar os dados.';
        }else if($_GET['error'] == "update"){
            echo 'ao atualizar os dados.';
        }else if($_GET['error'] == "deleting"){
            echo 'ao eliminar a conta.';
        }else if($_GET['error'] == "password"){
            echo 'ao mudar a password.';
        }
        echo '.</div>';
        echo '<script>window.setTimeout(function(){$(\'.alert\').alert(\'close\');},1500);</script>';
    }
    require "../includes/conn/conn.php";
    $sql = "SELECT u.u_nome AS u_nome, u.u_email AS u_email, u.u_membro AS u_membro, u.u_tipo AS u_tipo, l.lab_nome AS lab
    FROM utilizador AS u 
        FULL OUTER JOIN pertence AS p ON ( u.u_id = p.u_id  )  
            FULL OUTER JOIN laboratorio AS l ON ( p.lab_id = l.lab_id  )  
    WHERE u.u_id = ?";
    $result = sqlsrv_query($conn,$sql,array($_SESSION['u_id']));
    if($result){
        if($row = sqlsrv_fetch_array($result)){

            $html = '
            
            <section class="shadow-sm mx-auto w-50 shadow clearfix my-5 rounded bg-white p-5 resize">
                <div class="phone-padding">
                <h1 class="mb-4">A minha conta</h1>
                <form class="needs-validation" method="post" action="action.php" novalidate>
                <div class="form-row">
                        <label for="u_id" class="col-md-5 col-form-label font-weight-bold px-0">Numero de utilizador</label>
                        <div class="col-md-5">
                            <p class="u-select-none form-control-plaintext" id="u_id">'.$_SESSION['u_id'].'</p>
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label for="u_name" class="form-label font-weight-bold ">Nome de utilizador</label>
                        <input type="text" class="form-control" id="u_name" name="u_name" placeholder = "Escreva o seu Nome de Utilizador..." value="'.$row['u_nome'].'" required>
                        <div class="invalid-feedback">
                            Insira um nome de utilizador válido!
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label for="u_email" class="form-label font-weight-bold">Email</label>
                        <input type="text" class="form-control" id="u_email" name="u_email" placeholder = "Escreva o seu Email..." value="'.$row['u_email'].'" required>
                        <div class="invalid-feedback">
                            Insira um email válido!
                        </div>
                    </div>
                    ';
                    if($row['lab'] != NULL){
                        $html .= '
                        <div class="form-row">
                            <label for="u_lab" class="col-md-5 col-form-label font-weight-bold px-0">Laboratório</label>
                            <div class="col-md-5">
                                <p class="u-select-none form-control-plaintext" id="u_lab">'.$row['lab'].'</p>
                            </div>
                        </div>
                        ';
                    }
                    $html .='
                    <div class="form-row">
                        <label for="u_cargo" class="col-md-5 col-form-label font-weight-bold px-0">Cargo</label>
                        <div class="col-md-5">            
                            <p class="u-select-none form-control-plaintext" id="u_cargo">';
                            if($row['u_tipo'] == 0){
                                $html .= 'Utilizador';
                            }else if($row['u_tipo'] == 1){
                                $html .= 'Utilizador moderado';
                            }else if($row['u_tipo'] == 2){
                                $html .= 'Utilizador priviligiado';
                            }else if($row['u_tipo'] == 3){
                                $html .= 'Administrador';
                            }else{
                                $html .= 'Nenhum tipo definido';
                            }
                            $html .='
                            </p>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="u_membro" class="col-md-5 col-form-label font-weight-bold px-0">Membro C4G?</label>
                        <div class="col-md-5">
                            <p class="u-select-none form-control-plaintext" id="u_membro">';
                            if($row['u_membro'] == 1)
                                $html .= 'Sim';
                            else
                                $html .= 'Não';
                            $html .='</p>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm float-right my-3" type="submit" name="submit" value="atualizar">Atualizar</button>
                    <button class="btn btn-danger btn-sm float-left my-3" type="button" data-toggle="modal" data-target="#ModalEliminar">Eliminar conta</button>
                    <button class="btn btn-secondary btn-sm float-right mx-2 my-3" type="button" data-toggle="modal" data-target="#ModalPassword">Mudar password</button>
                    
                    <!-- Modal Eliminar -->
                    <div class="modal fade" id="ModalEliminar" tabindex="-1" role="dialog" aria-labelledby="ModalEliminar" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tem a certeza que quer eliminar a sua conta?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-sm btn-link text-danger" name="submit" value="eliminar">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Modal mudar password -->
                <div class="modal fade" id="ModalPassword" tabindex="-1" role="dialog" aria-labelledby="ModalPassword" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <form class="needs-validation" method="post" action="action.php" oninput=\'u_new_password_r.setCustomValidity(u_new_password_r.value != u_new_password.value ? "As passwords não correspondem." : "");u_new_password.setCustomValidity(u_new_password.value == u_password.value ? "A password nova é igual à corrente." : "")\' novalidate>
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Atualizar a password</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="form-row my-3">
                                <label for="u_password" class="form-label font-weight-bold">A password atual</label>
                                <input type="password" class="form-control" id="u_password" name="u_password" placeholder = "Escreva a sua password atual..." required>
                                <div class="invalid-feedback">
                                    Insira a sua password!
                                </div>
                            </div>
                            <div class="form-row my-3">
                                <label for="u_new_password" class="form-label font-weight-bold">A nova password</label>
                                <input type="password" class="form-control" id="u_new_password" name="u_new_password" placeholder = "Escreva a sua password nova..."required>
                                <div class="invalid-feedback">
                                    Insira a nova password
                                </div>
                            </div>
                            <div class="form-row my-3">
                                <label for="u_new_password_r" class="form-label font-weight-bold">Repita a nova password</label>
                                <input type="password" class="form-control" id="u_new_password_r" name="u_new_password_r" placeholder = "Repita a sua nova password..." required>
                                <div class="invalid-feedback">
                                    Insira a verificação da nova password
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-primary" name="submit" value="password">Submeter</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <br>
                <br>';
        }
        
    $html .='
    </div>
</section>
</body>
<script>
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
                var password = document.getElementById("u_password");
                var new_password = document.getElementById("u_new_password");
                var new_password_v = document.getElementById("u_new_password_r");
                
                    
                if (!new_password.checkValidity()){
                    new_password.nextElementSibling.innerHTML = new_password.validationMessage;
                }
                new_password.addEventListener(\'keyup\', function(){
                    new_password_v.setCustomValidity(new_password_v.value == "" ? "Preencha este campo." : (new_password_v.value != new_password.value ? "As passwords não correspondem." : "" ));
                    new_password.setCustomValidity(new_password.value == "" ? "Preencha este campo." : (new_password.value == password.value ? "A password nova é igual à corrente." : ""));
                    if (!new_password.checkValidity()){
                        new_password.nextElementSibling.innerHTML = new_password.validationMessage;
                    }
                });
                if (!new_password_v.checkValidity()){
                    new_password_v.nextElementSibling.innerHTML = new_password_v.validationMessage;
                }
                new_password_v.addEventListener(\'keyup\', function(){
                    new_password_v.setCustomValidity(new_password_v.value == "" ? "Preencha este campo." : (new_password_v.value != new_password.value ? "As passwords não correspondem." : "" ));
                    new_password.setCustomValidity(new_password.value == "" ? "Preencha este campo." : new_password.value == password.value ? "A password nova é igual à corrente." : "");
                    if (!new_password_v.checkValidity()){
                        new_password_v.nextElementSibling.innerHTML = new_password_v.validationMessage;
                    }
                });
            }
            form.classList.add(\'was-validated\');
            }, false);
            });
            }, false);
        })();
    </script>
</html>
            ';echo $html;exit();
    }
    header("Location: ../");
}else{
    header("Location: ../");
}



?>

