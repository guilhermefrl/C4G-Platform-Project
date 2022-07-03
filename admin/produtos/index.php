<?php
if(!(session_status() === PHP_SESSION_ACTIVE)){
    session_start(); 
}
if(isset($_SESSION['u_id'])){
    echo'
</br>
        <!-- Adicionar -->
        <div class="modal fade" id="addprodutos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar Produtos</h5>
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
                        <div class="col-md-3 mb-3">
                            <label for="prod_nivel">Nivel</label>
                            <select class="form-control" name="prod_nivel">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>

                        <div class="col-md-9 mb-3">
                            <label for="prod_web">Página Web</label>
                            <input type="text" name="prod_web" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira uma página web válida.
                            </div>
                        </div>     
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="prod_tipo">Tipo de Produto</label>
                            <select class="form-control" name="prod_tipo">
                                <option value="sf">Software</option>
                                <option value="md">Modelo</option>
                                <option value="m">Mapa</option>
                                <option value="c">Carta</option>
                                <option value="bd">Base de Dados</option>
                                <option value="col">Coleção</option>
                                <option value="s">Série</option>
                                <option value="bol">Boletim</option>
                                <option value="rel">Relatório</option>
                                <option value="cat">Catálogo</option>
                                <option value="sis">Sistema</option>
                                <option value="mat">Materiais Didáticos</option>
                            </select>
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
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addprodutos">
            <div class="show-mobile">+</div><div class="show-pc">Adicionar</div>
            </button>

            <div class="float-right text-right">
                <form id="search-produtos">
                    <input type="search" class="form-control d-inline-block align-middle w-auto"  name="search_produtos" placeholder="Pesquise aqui..." onkeyup="$(\'#search-produtos [name=search]\').click()"/>
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
        <div class="modal fade" id="editprodutos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Produtos</h5>
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
                        <div class="col-md-3 mb-3">
                            <label for="prod_nivel">Nivel</label>
                            <select class="form-control" name="prod_nivel">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>

                        <div class="col-md-9 mb-3">
                            <label for="prod_web">Página Web</label>
                            <input type="text" name="prod_web" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira uma página web válida.
                            </div>
                        </div>     
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="prod_tipo">Tipo de Produto</label>
                            <select class="form-control" name="prod_tipo">
                                <option value="sf">Software</option>
                                <option value="md">Modelo</option>
                                <option value="m">Mapa</option>
                                <option value="c">Carta</option>
                                <option value="bd">Base de Dados</option>
                                <option value="col">Coleção</option>
                                <option value="s">Série</option>
                                <option value="bol">Boletim</option>
                                <option value="rel">Relatório</option>
                                <option value="cat">Catálogo</option>
                                <option value="sis">Sistema</option>
                                <option value="mat">Materiais Didáticos</option>
                            </select>
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
        <div class="modal fade" id="eraseprodutos" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">			
                        <h4 class="modal-title">Tem a certeza?</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>    
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ao eliminar este produto não voltará a vê-lo.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(\'produtos\',this.value)" value="0">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        
        </br>
        </br>
        <div class="w-100 h-auto" style="overflow: auto;">';
            require "produtos/table.php";
        echo '</div>';
        
}else{
    header("Location: ../../login/");
}
