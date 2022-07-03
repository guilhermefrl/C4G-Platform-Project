<?php
session_start();
if(isset($_SESSION['u_id'])){
echo '
<div class=" form-row my-3">
  <div class="text-center w-100">
    <input type="search" class="form-control d-inline-block align-middle w-75" name="Pesquisa_Produtos" id="Pesquisa_Produtos" placeholder="Pesquise aqui serviços do tipo produtos" onkeyup="$(\'#Pesquisa_Produtos ~ [name=search]\').click()">
    <button type="submit" name="search" id="search_btn_dados" class="btn" onclick="pesquisar(\'Pesquisa_Produtos\',$(\'#Pesquisa_Produtos\').val())">
      <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"></path>
          <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"></path>
      </svg>
    </button>
  </div>
    
</div>
<div class="col pb-5 bg-white" >
      <button type="button" class="btn btn-light" onclick="$(\'#resultado-pesquisa\').removeClass(\'d-block\');$(\'section form\').removeClass(\'d-none\');">
        <svg class="bi bi-arrow-left-circle-fill mb-1" width="0.9em" height="0.9em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.646 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z"/>
        </svg>
      Voltar
      </button>
    </div>


</form>
<br>
    <div id="AProdutos" class="px-3"> 
  ';
  require "Produtos/table.php";

echo "</tbody></table></div>";
}else{
  header("Location: ../../login/");
}
?>