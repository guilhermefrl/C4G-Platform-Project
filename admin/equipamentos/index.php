<?php 
if(!(session_status() === PHP_SESSION_ACTIVE)){
    session_start(); 
}
if(isset($_SESSION['u_id'])){

echo '
<br>
        <!-- Adicionar -->
        <div class="modal fade" id="addequipamentos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 620px;"><form class="needs-validation" method="post" action="" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar Equipamentos</h5>
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
                            <label for="eq_marca">Marca</label>
                            <input type="text" name="eq_marca" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um marca válida.
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="eq_manuseio_terceiros">Manuseio de Terceiros</label>
                            <select class="form-control" name="eq_manuseio_terceiros">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="eq_foto">Foto</label>
                            <input type="text" name="eq_foto" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira uma foto válida.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="eq_modelo">Modelo</label>
                            <input type="text" name="eq_modelo" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um modelo válido.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="eq_n_serie">Número de Série</label>
                            <input type="number" name="eq_n_serie" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um número de série válido.
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="eq_data_aq">Data de Aquisição</label>
                            <input type="date" name="eq_data_aq" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira uma data de aquisição válida.
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="eq_fornecedor">Fornecedor</label>
                            <input type="text" name="eq_fornecedor" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um fornecedor válido.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="eq_garantia">Garantia</label>
                            <input type="date" name="eq_garantia" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira uma garantia válida.
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="eq_loc_hab">Local Habitual</label>
                            <input type="text" name="eq_loc_hab" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um local habitual válido.
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="eq_cond_uso">Condição de Uso</label>
                            <select class="form-control" name="eq_cond_uso">
                                <option value="1">Operacional</option>
                                <option value="0">Não Operacional</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="eq_mobilidade">Mobilidade</label>
                            <select class="form-control" name="eq_mobilidade">
                                <option value="F">Fixo</option>
                                <option value="P">Portátil</option>
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="eq_tipo_uso">Tipo de Uso</label>
                            <select class="form-control" name="eq_tipo_uso">
                                <option value="E">Partilha do Equipamento</option>
                                <option value="D">Partilha de Dados</option>
                                <option value="P">Uso Pessoal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="eq_nome">Nome</label>
                            <input type="text" name="eq_nome" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um nome válido.
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="eq_aq_C4G">Adquirido pelo C4G</label>
                            <select class="form-control" name="eq_aq_C4G">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row my-3">
                    <label>Observações</label>
                    <textarea style="resize: none;" class="form-control" name="rec_obs"></textarea>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label>Custo</label>
                        <input type="number" name="rec_custo" class="form-control" required>
                        <div class="invalid-feedback">
                            Insira um custo.
                        </div>
                    </div>

                    <div class="col">
                        <label for="eq_zelador">Zelador</label>
                        <select class="form-control" name="eq_zelador">
                        ';
                        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
                        $sql = "SELECT * FROM utilizador";
                        $result = sqlsrv_query($conn,$sql);
                        if($result){
                            while($lab = sqlsrv_fetch_array($result)){
                                echo '<option value="'.$lab['u_id'].'">'.$lab['nome'].' ('.$lab['u_nome'].')</option>';
                            }
                        };echo '
                        </select>
                    </div>
                </div> 
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" name="submit" value="Adicionar" class="btn btn-success">Adicionar</button>
            </div>
            </div> </form>
        </div>
        </div>

       <div class="container">
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addequipamentos">
            <div class="show-mobile">+</div><div class="show-pc">Adicionar</div>
            </button>

            <div class="float-right text-right">
                <form id="search-equipamentos">
                    <input type="search" class="form-control d-inline-block align-middle w-auto"  name="search_equipamentos" placeholder="Pesquise aqui..." onkeyup="$(\'#search-equipamentos [name=search]\').click()"/>
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
        <div class="modal fade" id="editequipamentos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 620px;"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Equipamentos</h5>
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
                            <label for="eq_marca">Marca</label>
                            <input type="text" name="eq_marca" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um marca válida.
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="eq_manuseio_terceiros">Manuseio de Terceiros</label>
                            <select class="form-control" name="eq_manuseio_terceiros">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="eq_foto">Foto</label>
                            <input type="text" name="eq_foto" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira uma foto válida.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="eq_modelo">Modelo</label>
                            <input type="text" name="eq_modelo" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um modelo válido.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="eq_n_serie">Número de Série</label>
                            <input type="number" name="eq_n_serie" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um número de série válido.
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="eq_data_aq">Data de Aquisição</label>
                            <input type="date" name="eq_data_aq" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira uma data de aquisição válida.
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="eq_fornecedor">Fornecedor</label>
                            <input type="text" name="eq_fornecedor" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um fornecedor válido.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="eq_garantia">Garantia</label>
                            <input type="date" name="eq_garantia" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira uma garantia válida.
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="eq_loc_hab">Local Habitual</label>
                            <input type="text" name="eq_loc_hab" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um local habitual válido.
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="eq_cond_uso">Condição de Uso</label>
                            <select class="form-control" name="eq_cond_uso">
                                <option value="1">Operacional</option>
                                <option value="0">Não Operacional</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="eq_mobilidade">Mobilidade</label>
                            <select class="form-control" name="eq_mobilidade">
                                <option value="F">Fixo</option>
                                <option value="P">Portátil</option>
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label for="eq_tipo_uso">Tipo de Uso</label>
                            <select class="form-control" name="eq_tipo_uso">
                                <option value="E">Partilha do Equipamento</option>
                                <option value="D">Partilha de Dados</option>
                                <option value="P">Uso Pessoal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="eq_nome">Nome</label>
                            <input type="text" name="eq_nome" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um nome válido.
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="eq_aq_C4G">Adquirido pelo C4G</label>
                            <select class="form-control" name="eq_aq_C4G">
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row my-3">
                    <label>Observações</label>
                    <textarea style="resize: none;" class="form-control" name="rec_obs"></textarea>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label>Custo</label>
                        <input type="number" name="rec_custo" class="form-control" required>
                        <div class="invalid-feedback">
                            Insira um custo.
                        </div>
                    </div>

                    <div class="col">
                        <label for="eq_zelador">Zelador</label>
                        <select class="form-control" name="eq_zelador">';
                        $sql = "SELECT * FROM utilizador";
                        $result = sqlsrv_query($conn,$sql);
                        if($result){
                            while($lab = sqlsrv_fetch_array($result)){
                                echo '<option value="'.$lab['u_id'].'">'.$lab['nome'].' ('.$lab['u_nome'].')</option>';
                            }
                        };echo'
                        </select>
                    </div>
                </div> 
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" name="submit" class="btn btn-success">Submeter</button>
            </div>
            </div> </form>
        </div>
        </div>

        <!-- Eliminar -->
        <div class="modal fade" id="eraseequipamentos" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">			
                        <h4 class="modal-title">Tem a certeza?</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>    
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ao eliminar este equipamento não voltará a vê-lo.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(\'equipamentos\',this.value)" value="0">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        </br>
        </br>
        <div class="w-100 h-auto" style="overflow: auto;">';
         require "equipamentos/table.php";
        echo '</div>';
    }else{
        header("Location : ../../login/");
    }