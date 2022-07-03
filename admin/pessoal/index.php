<?php
if(!(session_status() === PHP_SESSION_ACTIVE)){
    session_start(); 
}
if(isset($_SESSION['u_id'])){
echo'
</br>
        <!-- Adicionar -->
        <div class="modal fade" id="addpessoal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar Utilizador
            </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row my-3">
                    <label for="nome">Nome Próprio</label>
                    <input type="text" name="nome" class="form-control" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <label for="u_nome">Nome de utilizador</label>
                        <input type="text" name="u_nome" class="form-control" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <div class="col">
                    <label for ="u_pass">Password</label>
                    <input type="password" class="form-control" name="u_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}" required>
                    <small class="form-text text-muted">A password deve conter pelo menos 1 número, uma letra maiúscula,uma minúscula e 8 a 15 caracteres.</small>
                    <div class="invalid-feedback">
                        A password não é válida!
                    </div>
                </div>
                </div>
                <div class="form-row my-3">
                    <label for="u_email">E-mail</label>
                    <input type="email" name="u_email" class="form-control" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-row my-3">
                    <label for="nome">Função</label>
                    <input type="text" name="u_funcao" class="form-control" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
                
                <div class="form-row my-3">
                    <div class="col-1-sm">
                        <label for="u_membro">Membro?</label>
                        <select class="form-control" name="u_membro">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="u_lab">Laboratório</label>
                        <select class="form-control" name="u_lab">';
                        echo '<option value="0">Nenhum</option>';
                        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
                        $sql = "SELECT * FROM laboratorio";
                        $result = sqlsrv_query($conn,$sql);
                        if($result){
                            while($lab = sqlsrv_fetch_array($result)){
                                echo '<option value="'.$lab['lab_id'].'">'.$lab['lab_nome'].' ('.$lab['lab_acronimo'].')</option>';
                            }
                        };echo'
                        </select>
                    </div>
                    
                </div>
                <div class="form-row my-3">
                    <label for="u_tipo">Permissões</label>
                    <select class="form-control" name="u_tipo">
                        <option value="0"><span>Utilizador</span> (Poucas Permissões)</option>
                        <option value="1"><span>Utilizador Moderado</span> (Algumas Permissões)</option>
                        <option value="2"><span>Utilizador Priviligiado</span> (Acede a tudo menos a utilizadores)</option>
                        <option value="3"><span>Administrador</span> (Acede a tudo)</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" name="submit" class="btn btn-success">Adicionar</button>
            </div>
            </div></form>
        </div>
        </div>

       <div class="container">
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addpessoal">
            <div class="show-mobile">+</div><div class="show-pc">Adicionar</div>
            </button>

            <div class="float-right text-right">
                    <form id="search-people">
                    <input type="search" class="form-control d-inline-block align-middle w-auto"  name="seach_people" placeholder="Pesquise aqui..."  onkeyup="$(\'#search-people [name=search]\').click()"/>
                    <button type="submit" name="search" class="btn">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                    </button>
                </form>
            </div>
       </div>
        <!-- Eliminar -->
        <div class="modal fade" id="erasepessoal" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">			
                        <h4 class="modal-title">Eliminar utilizador?</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>    
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ao eliminar este utilizador ele não poderá continuar a ver o conteúdo do C4G.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(\'pess\',this.value)" value="0">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Editar -->
        <div class="modal fade" id="editpessoal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Utilizador 
            </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-row my-3">
                <label for="nome">Nome Próprio</label>
                <input type="text" name="nome" class="form-control" required>
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="u_nome">Nome de utilizador</label>
                    <input type="text" name="u_nome" class="form-control" required>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="col">
                <label for ="u_pass">Password</label>
                <input type="password" class="form-control" name="u_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15}" placeholder="Mudar a palavra passe...">
                <small class="form-text text-muted">A password deve conter pelo menos 1 número, uma letra maiúscula,uma minúscula e 8 a 15 caracteres.</small>
                <div class="invalid-feedback">
                    A password não é válida!
                </div>
            </div>
            </div>
            <div class="form-row my-3">
                <label for="u_email">E-mail</label>
                <input type="email" name="u_email" class="form-control" required>
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="form-row my-3">
                <label for="nome">Função</label>
                <input type="text" name="u_funcao" class="form-control" required>
                <div class="invalid-feedback">
                </div>
            </div>
            
            <div class="form-row my-3">
                <div class="col-1-sm">
                    <label for="u_membro">Membro?</label>
                    <select class="form-control" name="u_membro">
                        <option value="1">Sim</option>
                        <option value="0" selected>Não</option>
                    </select>
                </div>
                <div class="col">
                    <label for="u_lab">Laboratório</label>
                    <select class="form-control" name="u_lab">';
                    echo '<option value="0">Nenhum</option>';
                    $sql = "SELECT * FROM laboratorio";
                    $result = sqlsrv_query($conn,$sql);
                    if($result){
                        while($lab = sqlsrv_fetch_array($result)){
                            echo '<option value="'.$lab['lab_id'].'">'.$lab['lab_nome'].' ('.$lab['lab_acronimo'].')</option>';
                        }
                    };echo'
                    </select>
                </div>
                
            </div>
            <div class="form-row my-3">
                <label for="u_tipo">Permissões</label>
                <select class="form-control" name="u_tipo">
                    <option value="0" title="Este utilizador tem poucas permissões" selected>Utilizador</option>
                    <option value="1"title="Este utilizador tem algumas permissões">Utilizador Moderado</option>
                    <option value="2"title="Este utilizador acede a tudo menos a utilizadores">Utilizador Priviligiado</option>
                    <option value="3" title="O administrador acede a tudo">Administrador</option>
                </select>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" name="submit" value="1" class="btn btn-success">Submeter</button>
            </div>
            </div></form>
            </div>
        </div>

        </br>
        </br>
        <div class="w-100 h-auto" style="overflow: auto;">';
            require "pessoal/table.php";
        echo '</div>';
}else{
    header("Location: ../../login/");
}
        
        