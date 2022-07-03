</br>
        <!-- Adicionar -->
        <div class="modal fade" id="addservicos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 520px;"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar Serviços</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-row">
                    <div class="col-md-12 mb-3">
                            <label for="servico_nome">Nome</label>
                            <input type="text" name="servico_nome" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um nome válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="servico_tipo">Tipo de Serviço</label>
                            <select class="form-control" name="servico_tipo">
                                <option value="E">Equipamentos</option>
                                <option value="D">Dados</option>
                                <option value="F">Formação</option>
                                <option value="P">Produtos</option>
                                <option value="S">Serviços</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row"> 
                        <div class="col-md-12 mb-3">
                            <label for="servico_coord">Coordenador</label>
                            <select class="form-control" name="servico_coord">
                            <?php
                            include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
                            $sql = "SELECT * FROM utilizador";
                            $result = sqlsrv_query($conn,$sql);
                            if($result){
                                while($lab = sqlsrv_fetch_array($result)){
                                    echo '<option value="'.$lab['u_id'].'">'.$lab['nome'].' ('.$lab['u_nome'].')</option>';
                                }
                            };?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row"> 
                        <div class="col-md-12 mb-3">
                            <label for="servico_gt">Grupo de Trabalho</label>
                            <select class="form-control" name="servico_gt">
                            <?php
                            include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
                            $sql = "SELECT * FROM grupoTrabalho";
                            $result = sqlsrv_query($conn,$sql);
                            if($result){
                                while($lab = sqlsrv_fetch_array($result)){
                                    echo '<option value="'.$lab['grp_id'].'">'.$lab['grp_nome'].' ('.$lab['grp_acro'].')</option>';
                                }
                            };?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row"> 
                        <div class="col-md-12 mb-3">
                            <label for="servico_r">Recursos</label>
                            <select class="form-control" name="servico_r">
                            <?php
                            include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
                            $sql = "SELECT * FROM recurso";
                            $result = sqlsrv_query($conn,$sql);
                            if($result){
                                while($lab = sqlsrv_fetch_array($result)){
                                    echo '<option value="'.$lab['rec_id'].'">'.$lab['rec_designacao_pt'].'</option>';
                                }
                            };?>
                            </select>
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

        
        <!-- Editar -->
        <div class="modal fade" id="editservicos" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"><form class="needs-validation" novalidate>
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Serviços</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-row">
                    <div class="col-md-12 mb-3">
                            <label for="servico_nome">Nome</label>
                            <input type="text" name="servico_nome" class="form-control" required>
                            <div class="invalid-feedback">
                                Insira um nome válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="servico_tipo">Tipo de Serviço</label>
                            <select class="form-control" name="servico_tipo">
                                <option value="E">Equipamentos</option>
                                <option value="D">Dados</option>
                                <option value="F">Formação</option>
                                <option value="P">Produtos</option>
                                <option value="S">Serviços</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row"> 
                        <div class="col-md-12 mb-3">
                            <label for="servico_coord">Coordenador</label>
                            <select class="form-control" name="servico_coord">
                            <?php
                            $sql = "SELECT * FROM utilizador";
                            $result = sqlsrv_query($conn,$sql);
                            if($result){
                                while($lab = sqlsrv_fetch_array($result)){
                                    echo '<option value="'.$lab['u_id'].'">'.$lab['nome'].' ('.$lab['u_nome'].')</option>';
                                }
                            };?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row"> 
                        <div class="col-md-12 mb-3">
                            <label for="servico_gt">Grupo de Trabalho</label>
                            <select class="form-control" name="servico_gt">
                            <?php
                            $sql = "SELECT * FROM grupoTrabalho";
                            $result = sqlsrv_query($conn,$sql);
                            if($result){
                                while($lab = sqlsrv_fetch_array($result)){
                                    echo '<option value="'.$lab['grp_id'].'">'.$lab['grp_nome'].' ('.$lab['grp_acro'].')</option>';
                                }
                            };?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row"> 
                        <div class="col-md-12 mb-3">
                            <label for="servico_r">Recursos</label>
                            <select class="form-control" name="servico_r">
                            <?php
                            $sql = "SELECT * FROM recurso";
                            $result = sqlsrv_query($conn,$sql);
                            if($result){
                                while($lab = sqlsrv_fetch_array($result)){
                                    echo '<option value="'.$lab['rec_id'].'">'.$lab['rec_designacao_pt'].'</option>';
                                }
                            };?>
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
        <div class="modal fade" id="eraseservicos" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">			
                        <h4 class="modal-title">Tem a certeza?</h4>	
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>    
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ao eliminar este serviço não voltará a vê-lo.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar('servicos',this.value)" value="0">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addservicos">
           <div class="show-mobile">+</div><div class="show-pc">Adicionar</div>
            </button>

            <div class="float-right text-right">
                <form id="search-servicos">
                    <input type="search" class="form-control d-inline-block align-middle w-auto"  name="search_servicos" placeholder="Pesquise aqui..." onkeyup="$('#search-servicos [name=search]').click()"/>
                    <button type="submit" name="search" class="btn">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                    </button>
                </form>
            </div>
        </div>

        </br>
        </br>
        <div class="w-100 h-auto" style="overflow: auto;">
        <?php
            require "servicos/table.php";
        echo '</div>';?>
