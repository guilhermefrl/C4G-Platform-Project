<?php 
if(!(session_status() === PHP_SESSION_ACTIVE)){
    session_start(); 
}
if (isset($_SESSION['u_id'])){
        echo '
        </br>
        <!-- Adicionar -->
        <div class="modal fade" id="addformacao" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar Formação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row my-3">
                        <label>Designação - PT</label>
                        <input style="resize:none" name="rec_designacao_pt" class="form-control" required>
                        <div class="invalid-feedback">
                            Insira uma descrição em português.
                        </div>
                    </div> 
                    <div class="form-row my-3">
                        <label>Designação - EN</label>
                        <input style="resize:none" name="rec_designacao_en" class="form-control" required>
                        <div class="invalid-feedback">
                            Insira uma descrição em inglês.
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="form_tipo">Tipo de formação</label>
                            <select class="form-control" name="form_tipo">
                                <option value="e-learning">e-learning</option>
                                <option value="presencial">presencial</option>
                                <option value="software">software</option>
                                <option value="modelação">modelação</option>
                                <option value="equipamento">equipamento</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="form_vagas">Número de vagas</label>
                            <input type="number" name="form_vagas" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um número de vagas válido.
                            </div>
                        </div>     
                    </div>
                    <div class="form-row my-3">
                        <label>Observações</label>
                        <textarea style="resize: none;" class="form-control" name="rec_obs"></textarea>
                    </div>
                    <div class="form-row my-3">
                    <div class="col-5">
                        <label>Custo</label>
                        <input type="number" name="rec_custo" class="form-control" required>
                        <div class="invalid-feedback">
                            Insira um custo.
                        </div>
                    </div> 
                </div> 
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" name="submit" value="Adicionar" class="btn btn-success">Adicionar</button>
            </div>
            </div></form>
        </div>
        </div>

       <div class="container">
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addformacao">
            <div class="show-mobile">+</div><div class="show-pc">Adicionar</div>
            </button>

            <div class="float-right text-right">
                <form id="search-formacao">
                    <input type="search" class="form-control d-inline-block align-middle w-auto"  name="search_formacao" placeholder="Pesquise aqui..." onkeyup="$(\'#search-formacao [name=search]\').click()"/>
                    <button type="submit" name="search" class="btn">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                    </button>
                </form>
            </div>
       </div>

        <!-- Editar -->
        <div class="modal fade" id="editformacao" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Formação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="form-row my-3">
                        <label>Designação - PT</label>
                        <input style="resize:none" name="rec_designacao_pt" class="form-control" required>
                        <div class="invalid-feedback">
                            Insira uma descrição em português.
                        </div>
                    </div> 
                    <div class="form-row my-3">
                        <label>Designação - EN</label>
                        <input style="resize:none" name="rec_designacao_en" class="form-control" required>
                        <div class="invalid-feedback">
                            Insira uma descrição em inglês.
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="form_tipo">Tipo de formação</label>
                            <select class="form-control" name="form_tipo">
                                <option value="e-learning">e-learning</option>
                                <option value="presencial">presencial</option>
                                <option value="software">software</option>
                                <option value="modelação">modelação</option>
                                <option value="equipamento">equipamento</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="form_vagas">Número de vagas</label>
                            <input type="number" name="form_vagas" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um número de vagas válido.
                            </div>
                        </div>     
                    </div>
                    <div class="form-row my-3">
                        <label>Observações</label>
                        <textarea style="resize: none;" class="form-control" name="rec_obs"></textarea>
                    </div>
                    <div class="form-row my-3">
                    <div class="col-5">
                        <label>Custo</label>
                        <input type="number" name="rec_custo" class="form-control" required>
                        <div class="invalid-feedback">
                            Insira um custo.
                        </div>
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
        <div class="modal fade" id="eraseformacao" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">			
                        <h4 class="modal-title">Tem a certeza?</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>    
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ao eliminar esta formação não voltará a vê-la.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(\'formacao\',this.value)" value="0">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        </br>
        </br>
        <div class="w-100 h-auto" style="overflow: auto;">';
            require "formacao/table.php";
        echo '</div>';

    }else{
        header("Location: ../../login/");
    }