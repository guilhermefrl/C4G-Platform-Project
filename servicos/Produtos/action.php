<?php

if(isset($_POST['search'])){
    $text = $_POST['search'];
    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
    $sql = "SELECT s.servico_nome, s.servico_id FROM dbo.servico s  WHERE s.servico_nome like '%$text%'  AND Upper(s.servico_tipo) = 'P'";
    $result = sqlsrv_query($conn,$sql);
    if($result){
        while($row = sqlsrv_fetch_array($result)){
            echo '<tr data-toggle="modal" data-target="#loadservico" style="cursor:pointer;" id="row_servico_'.$row['servico_id'].'" onclick="loaddata(\'servico\','.$row['servico_id'].')">';
            echo '<td>'.$row['servico_nome'].'</td>';
            echo '</tr>';
        }
    }

}

