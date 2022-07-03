<?php
if(!(session_status() === PHP_SESSION_ACTIVE)){
    session_start(); 
}
if(isset($_SESSION['u_id'])){
echo'
<br>
<!-- Eliminar -->
<div class="modal fade" id="eraseunid" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">			
                <h4 class="modal-title">Eliminar unidade de investigação?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>    
                </button>
            </div>
            <div class="modal-body">
                <p>Ao eliminar esta unidade de investigação todas as suas associações serão eliminadas.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(\'unid\',this.value)" value="0">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- ADICIONAR -->
<div class="modal fade" id="addunid" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="seegroup" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">			
                <h4 class="modal-title">Unidade de Investigação</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close-modal">
                <span aria-hidden="true">&times;</span>    
                </button>
            </div>
            <div class="modal-body">
                <form id="alter-unidade" class="needs-validation" novalidate>
                    <div class="form-row my-3">
                        <label for="nome">Acrónimo</label>
                        <input type="text" name="unid_acro" class="form-control" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label for="nome">Nome</label>
                        <input type="text" name="unid_nome" class="form-control" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label for="nome">Descrição</label>
                        <textarea name="unid_desc" style="resize:none" class="form-control"></textarea>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="submit" class="btn btn-success">Submeter</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <form style="width:100%">
                <div class="form-row my-3">
                        <div style="width:calc(100% - 50px)">
                            <select name="grp_id" class="form-control" disabled>
                                <option>Adicionar grupo</option>
                            </select>
                            <small class="form-text text-muted">Aqui irá adicionar os grupos pertencentes à unidade de investigação.</small>
                        </div>
                        <button type="button" class="btn btn-sm" style="max-height: 40px;">
                            <svg class="bi bi-plus bg-success text-light" style="font-size: 1.5em;border-radius: 50%" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                                <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                            </svg>
                        </button>
                </div>
                </form>
                <table class="table">
                    <tr>
                        <th colspan="3" class="text-center"> Grupos Associados </th>
                    </tr>
                    <?php require "unidades/tablegroups.php"?>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- EDITAR -->
<div class="modal fade" id="editunid" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="seegroup" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">			
                <h4 class="modal-title">Unidade de Investigação <div class="id d-none"></div></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close-modal">
                <span aria-hidden="true">&times;</span>    
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-unidade" class="needs-validation" novalidate>
                    <div class="form-row my-3">
                        <label for="nome">Acrónimo</label>
                        <input type="text" name="unid_acro" class="form-control" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label for="nome">Nome</label>
                        <input type="text" name="unid_nome" class="form-control" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-row my-3">
                        <label for="nome">Descrição</label>
                        <textarea name="unid_desc" style="resize:none" class="form-control"></textarea>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="submit" class="btn btn-success">Submeter</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-row my-3" id="editunid_pess">
                        <label for="grp_id">Adicionar grupo</label>
                        <select name="grp_id" class="form-control" style="width:calc(100% - 50px)">';
                                include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
                                $sql = "SELECT grp_id,grp_nome FROM grupoTrabalho";
                                $result = sqlsrv_query($conn,$sql);
                                if($result){
                                    while($row = sqlsrv_fetch_array($result)){
                                        echo '<option value="'.$row['grp_id'].'">'.$row['grp_nome'].'</option>';
                                    }
                                }
                            echo'
                        </select>
                        <div class="invalid-feedback">
                        </div>
                        <button class="btn btn-sm" onclick="adiciona(\'unid_grp\',$(\'#editunid .modal-title .id\').html(),$(\'#editunid_pess [name=grp_id]\').val())">
                            <svg class="bi bi-plus bg-success text-light" style="font-size: 1.5em;border-radius: 50%" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                                <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                            </svg>
                        </button>
                </div>
                <br>
                <table class="table table-added">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center"> Grupos Associados </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php require "unidades/tablegroups.php"?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addunid">
    <div class="show-mobile">+</div><div class="show-pc">Adicionar</div>
    </button>

    <div class="float-right text-right">
        <form id="search-unid">
            <input type="search" class="form-control d-inline-block align-middle w-auto"  name="seach_grp" placeholder="Pesquise aqui..."  onkeyup="$(\'#search-unid [name=search]\').click()"/>
            <button type="submit" name="search" class="btn">
            <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
            </svg>
            </button>
        </form>
    </div>
</div>
<br>';
require "unidades/table.php";
}else{
    header("Location: ../../login/");
}