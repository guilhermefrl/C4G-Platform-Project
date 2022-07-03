
<?php

if(isset($_POST['dados'])){
    require "../servicos/Dados/index.php";
}


if(isset($_POST['equipamentos'])){
  require "../servicos/Equipamento/index.php";

}
if(isset($_POST['formacao'])){
  require "../servicos/Formacao/index.php";
}

if(isset($_POST['produtos'])){
  require "../servicos/Produtos/index.php";

}

if(isset($_POST['servico'])){
  $servico_nome = $_POST['servico_nome'];
 
  echo '

    <div class="col pb-5 bg-white" >
    <button type="button" class="btn btn-light" onclick="$(\'#resultado-pesquisa\').removeClass(\'d-block\');$(\'section form .album\').removeClass(\'d-none\');">
      <svg class="bi bi-arrow-left-circle-fill mb-1" width="0.9em" height="0.9em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.646 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z"/>
      </svg>
    Voltar
    </button>
    </div>
    <div id="AServicos" class="px-3"> 
  ';
  require "PesquisaServico.php";

echo "</tbody></table></div>";
}
?>
