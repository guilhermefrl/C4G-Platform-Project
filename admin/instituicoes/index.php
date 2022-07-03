<?php
if(!(session_status() === PHP_SESSION_ACTIVE)){
    session_start(); 
}
if(isset($_SESSION['u_id'])){
        echo '
        </br>
        <!-- Adicionar -->
        <div class="modal fade" id="addinstituicoes" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 520px;"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar Instituição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="inst_nome">Nome</label>
                            <input type="text" name="inst_nome" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um nome válido.
                            </div>
                        </div> 
                    </div>
                    <div class="form-row">
                        <div class="col-md-7 mb-3">
                            <label for="inst_distrito">Distrito</label>
                            <input type="text" name="inst_distrito" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um distrito válido.
                            </div>
                        </div>
                        
                        <div class="col-md-5 mb-3">
                            <label for="inst_acronimo">Acrónimo</label>
                            <input type="text" name="inst_acronimo" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um acrónnimo válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-7 mb-3">
                            <label for="inst_tipo">Tipo</label>
                            <select class="form-control" name="inst_tipo">
                                <option value="1">Pública</option>
                                <option value="2">Privada</option>
                                <option value="3">Individual</option>
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="inst_parceria">Instituição Parceira</label>
                            <select class="form-control" name="inst_parceira">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" name="submit" class="btn btn-success">Submeter</button>
            </div>
            </div></form>
        </div>
        </div>

        <div class="container">
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addinstituicoes">
            <div class="show-mobile">+</div><div class="show-pc">Adicionar</div>
            </button>

            <div class="float-right text-right">
                <form id="search-inst">
                    <input type="search" class="form-control d-inline-block align-middle w-auto"  name="seach_inst" placeholder="Pesquise aqui..."  onkeyup="$(\'#search-inst [name=search]\').click()"/>
                    <button type="submit" name="search" id="search_btn_instituicao" class="btn">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Editar -->
        <div class="modal fade" id="editinstituicoes" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Instituição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            <div class="form-row">

                    <div class="col-md-12 mb-3">
                            <label for="inst_nome">Nome</label>
                            <input type="text" name="inst_nome" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um nome válido.
                            </div>
                        </div> 
                    </div>
                    <div class="form-row">
                        <div class="col-md-7 mb-3">
                            <label for="inst_distrito">Distrito</label>
                            <input type="text" name="inst_distrito" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um distrito válido.
                            </div>
                        </div>
                        
                        <div class="col-md-5 mb-3">
                            <label for="inst_acronimo">Acrónimo</label>
                            <input type="text" name="inst_acronimo" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um acrónnimo válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-7 mb-3">
                            <label for="inst_tipo">Tipo</label>
                            <select class="form-control" name="inst_tipo">
                                <option value="1">Pública</option>
                                <option value="2">Privada</option>
                                <option value="3">Individual</option>
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="inst_parceria">Instituição Parceira</label>
                            <select class="form-control" name="inst_parceira">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" name="submit" class="btn btn-success">Submeter</button>
            </div>
            </div></form>
        </div>
        </div>

        <!-- Eliminar -->
        <div class="modal fade" id="eraseinstituicoes" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">			
                        <h4 class="modal-title">Tem a certeza?</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>    
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ao eliminar esta instituição não voltará a vê-la.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(\'inst\',this.value)" value="0">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        
        </br>
        </br>'; require "instituicoes/table.php";
    
}else{
    header("Location: ../../login/");
}