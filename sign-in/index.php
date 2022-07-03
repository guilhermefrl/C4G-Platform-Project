<?php

$html = '
    
';
require "../header/head.php";

if(isset($_GET['error'])){
    echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro na base de dados, por favor tente mais tarde.</div>';
    echo '<script>window.setTimeout(function(){$(\'.alert\').alert(\'close\');},1500);</script>';
}else if(isset($_GET['usertaken'])){
    echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">O nome de utilizador não é válido.</div>';
    echo '<script>window.setTimeout(function(){$(\'.alert\').alert(\'close\');},1500);</script>';
}else if(isset($_GET['success'])){
    echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Registado com sucesso!</div>';
    echo '<script>window.setTimeout(function(){$(\'.alert\').alert(\'close\');},1500);</script>';
}

?>

        <section class="shadow-sm mx-auto w-50 shadow clearfix mt-5 rounded bg-white p-5 resize-login">
            <h2 class="text-left u-select-none">Registe-se!</h2>
            <div class="">
                <form class="needs-validation" method="post" action="action.php" oninput='u_pass_r.setCustomValidity(u_pass_r.value != u_pass.value ? "As passwords não correspondem." : "")' novalidate>
                    <div class="form-row my-3">
                        <label>Nome de Utilizador *</label>
                        <input type="text" class="form-control" name="u_name" placeholder = "Escreva o seu username..." required>
                        <small class="form-text text-muted">O seu nome de utilizador tem que ser único.</small>
                        <div class="invalid-feedback">
                            Insira um nome de utilizador válido!
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label>Email *</label>
                        <input type="email" class="form-control" name="u_email" placeholder = "Escreva o seu email..."
                        <?php if(isset($_GET['usertaken'])){
                            echo 'value="'.$_GET['u_email'].'"';
                        }?>
                        required>
                        <div class="invalid-feedback">
                            Insira um email válido!
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label for ="u_pass">Password *</label>
                        <input type="password" class="form-control" name="u_pass" id="u_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}" required>
                        <small class="form-text text-muted">A password deve conter pelo menos 1 número, uma letra maiúscula,uma minúscula e 8 a 15 caracteres.</small>
                        <div class="invalid-feedback">
                            A sua password não é válida!
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label for ="u_pass_r">Confirme a Password *</label>
                        <input type="password" class="form-control" id="u_pass_r" name="u_pass_r" required>
                        <div class="invalid-feedback">
                            As passwords não coincidem!
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox u-select-none">
                            <input class="custom-control-input" type="checkbox" id="privacidade" name="privacidade" required>
                            <label class="custom-control-label" for="privacidade">
                                Aceitar a <a href="" class="link">Politica de Privacidade</a>
                            </label>
                            <div class="invalid-feedback">
                                Tem que aceitar a politica de privacidade para conseguir registar-se
                            </div>
                        </div>
                    </div>
                    <p class="float-left">Já possui uma conta? <a class="link" href="/projetobd/login" >Voltar para o Login</a></p>
                    <button type="submit" class="btn btn-primary float-right" name="submit">Registar!</button>
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
                var new_password = document.getElementById("u_pass_r");
                if (!new_password.checkValidity()){
                    new_password.nextElementSibling.innerHTML = new_password.validationMessage;
                }
            }
            form.classList.add('was-validated');
            }, false);
            });
            }, false);
        })();
    </script>
    
</html>