<?php
if(!(session_status() === PHP_SESSION_ACTIVE)){
    session_start(); 
}
if(isset($_SESSION['u_id'])){
echo '
<br>
<!-- Eliminar -->
<div class="modal fade" id="erasegroup" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">			
                <h4 class="modal-title">Eliminar grupo de trabalho?</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>    
                </button>
            </div>
            <div class="modal-body">
                <p>Ao eliminar este grupo de trabalho todas as suas associações serão eliminadas.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="eliminar(\'grp\',this.value)" value="0">Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- Adicionar -->
<div class="modal fade" id="addgroup" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="seegroup" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">			
                <h4 class="modal-title">Adicionar Grupo de Trabalho</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-label="Close-modal">
                <span aria-hidden="true">&times;</span>    
                </button>
            </div>
            <div class="modal-body">
            <form class="needs-validation" novalidate>
                <div class="form-row my-3">
                    <label for="nome">Acrónimo</label>
                    <input type="text" name="grp_acro" class="form-control" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-row">
                    <label for="u_nome">Nome</label>
                    <input type="text" name="grp_nome" class="form-control" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-row my-3">
                    <label for="grp_desc">Descrição</label>
                    <textarea style="resize:none" name="grp_desc" class="form-control"></textarea>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" name="submit" class="btn btn-success">Submeter</button>
                </div>
                
            </form>
            </div>
            <div class="modal-footer">
                <div id="search-gtpess" style="position:relative;width:100%;">
                    <div class="form-group d-inline-block m-auto" style="width: calc(100% - 50px);">
                    <input type="search" class="form-control"  name="seach_person" placeholder="Pesquise para adicionar pessoas ao grupo" readonly/>
                    <small class="form-text text-muted">Aqui poderá pesquisar pelo nome de utilizador ou número da pessoa</small>
                    </div>
                    <button type="button" name="search" class="btn align-top">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                    </button>
                    <div class="results bg-light" style="position:absolute;top: calc(100% - 25px);left:0;width: calc(100% - 50px);">
                        <table class="table table-bordered" style="margin:0;">
                        <?php require "tableedit1.php" ?>
                        </table>
                    </div>
                </div>
                <br>
                <table class="table">
                    <tr>
                        <th colspan="4" class="text-center">Pessoas no grupo</th>
                    </tr>
                    <?php require "tableedit2.php" ?>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Editar -->
<div class="modal fade" id="editgroup" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="seegroup" aria-hidden="true">
    <div class="modal-dialog w-75">
        <div class="modal-content">
            <div class="modal-header">			
                <h4 class="modal-title">Editar Grupo de Trabalho <div class="id d-none"></div></h4>	
                <button type="button" class="close" data-dismiss="modal" aria-label="Close-modal">
                <span aria-hidden="true">&times;</span>    
                </button>
            </div>
            <div class="modal-body">
            <form class="needs-validation" novalidate>
                <div class="form-row my-3">
                    <label for="nome">Acrónimo</label>
                    <input type="text" name="grp_acro" class="form-control" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-row">
                    <label for="u_nome">Nome</label>
                    <input type="text" name="grp_nome" class="form-control" required>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-row my-3">
                    <label for="grp_desc">Descrição</label>
                    <textarea style="resize:none" name="grp_desc" class="form-control"></textarea>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" name="submit" class="btn btn-success">Submeter</button>
                </div>
                
            </form>
            </div>
            <div class="modal-footer">
                <div id="search-gtpess" style="position:relative;width:100%;">
                    <div class="form-group d-inline-block m-auto" style="width: calc(100% - 50px);">
                    <input type="search" class="form-control "  name="seach_person" placeholder="Pesquise para adicionar pessoas ao grupo"  onkeyup="$(\'#search-gtpess [name=search]\').click()"/>
                    <small class="form-text text-muted">Pode pesquisar pelo nome de utilizador ou número da pessoa</small>
                    </div>
                    <button type="button" name="search" class="btn align-top" onclick="pesquisar(\'gt-pess\',$(\'#editgroup #search-gtpess [type=search]\').val())">
                    <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                    </svg>
                    </button>
                    <div class="results bg-light" style="position:absolute;top: calc(100% - 25px);left:0;width: calc(100% - 50px);">
                        <table class="table table-bordered" style="margin:0;">
                        <?php require "tableedit1.php" ?>
                        </table>
                    </div>
                </div>
                <br>
                <table class="table table-added">
                    <thead><tr>
                        <th colspan="4" class="text-center">Pessoas no grupo</th>
                    </tr></thead><tbody>
                    <?php require "tableedit2.php" ?>
                </tbody></table>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addgroup">
    <div class="show-mobile">+</div><div class="show-pc">Adicionar</div>
    </button>

    <div class="float-right text-right">
        <form id="search-grp">
            <input type="search" class="form-control d-inline-block align-middle w-auto"  name="seach_grp" placeholder="Pesquise aqui..."  onkeyup="$(\'#search-grp [name=search]\').click()"/>
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
 require "grupos/table.php";
    
}else{
    header("Location: ../../login/");
}