<?php

$html = '
    
';
require "../header/head.php";
if(isset($_SESSION['u_id'])){
    header("Location: ../");
}
else if(isset($_GET['account-deleted'])){
    echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">A sua conta foi apagada com sucesso.</div>';
    echo '<script>window.setTimeout(function(){$(\'.alert\').alert(\'close\');},1500);</script>';
}

?>

        <section class="shadow-sm mx-auto w-50 shadow clearfix mt-5 rounded bg-white p-5 resize-login">
            <h2 class="text-left u-select-none">
                <svg class="bi bi-people-circle mr-2 align-middle mb-2" width="0.9em" height="0.9em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 008 15a6.987 6.987 0 005.468-2.63z"/>
                    <path fill-rule="evenodd" d="M8 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M8 1a7 7 0 100 14A7 7 0 008 1zM0 8a8 8 0 1116 0A8 8 0 010 8z" clip-rule="evenodd"/>
                </svg>
Login</h2>
            <div class="">
                <form class="needs-validation" method="post" action="action.php" novalidate>
                    <div class="form-row my-3">
                        <label>Nome de Utilizador</label>
                        <input type="text" class="form-control" name="u_name" placeholder = "Escreva o seu username..." required>
                        <div class="invalid-feedback">
                            Insira um nome de utilizador válido!
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="u_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}" required>
                        <div class="invalid-feedback">
                            A sua password não é válida!
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <div class="custom-control custom-checkbox u-select-none">
                            <input class="custom-control-input" type="checkbox" id="login_save" name="login_save">
                            <label class="custom-control-label" for="login_save">
                                Guardar dados de login
                            </label>
                        </div>
                    </div>-->
                    <label class="mt-1">Ainda não tem conta? <a href="../sign-in" class="link">Registe-se!</a></label>
                    <button type="submit" class="btn btn-primary float-right" name="submit">Entrar!</button>
                </form>
            </div>
        </section>
    </body>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
            }, false);
            });
            }, false);
        })();
    </script>
</html>