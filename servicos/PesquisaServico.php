<?php
if(isset($_POST['servico'])){
echo "
<table class=\"table table-bordered table-hover\">
  
  <thead>
      <tr>
    <th>Designação</th><th>Tipo</th>
      </tr>
  </thead>
  <tbody>
  
  ";
  include "../includes/conn/conn.php";
  $sql = "SELECT s.servico_id,s.servico_nome, s.servico_tipo
  FROM dbo.servico s 
  WHERE s.servico_nome like '%".$_POST['servico_nome']."%'";
          
  $result = sqlsrv_query($conn,$sql); 
  if($result){
      while($row = sqlsrv_fetch_array($result)){
          echo '
              <tr data-toggle="modal" data-target="#loadservico" style="cursor:pointer;" id="row_servico_'.$row['servico_id'].'" onclick="loaddata(\'servico\','.$row['servico_id'].')">
                <td>'.$row['servico_nome'].'</td><td>'.$row['servico_tipo'].'</td>
              </tr>';
      }
  }
}
  ?>
