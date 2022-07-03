<table class="table table-hover">
    <tbody>
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
    $sql = "SELECT s.servico_nome,s.servico_id FROM dbo.servico s WHERE Upper(s.servico_tipo) = 'P'";
    $result = sqlsrv_query($conn,$sql);
    if($result){
        while($row = sqlsrv_fetch_array($result)){
            echo '<tr data-toggle="modal" data-target="#loadservico" style="cursor:pointer;" id="row_servico_'.$row['servico_id'].'" onclick="loaddata(\'servico\','.$row['servico_id'].')">';
            echo '<td>'.$row['servico_nome'].'</td>';
            echo '</tr>';
        }
    }
       
    echo '</tbody>
</table>';
?>
