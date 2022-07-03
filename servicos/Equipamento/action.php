<?php

if(isset($_POST['search'])){
    $text = $_POST['search'];
    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
    $sql = "SELECT s.servico_nome, s.servico_id, e.eq_marca, e.eq_modelo
    FROM dbo.servico s 
        INNER JOIN dbo.incui i ON ( s.servico_id = i.servico_id  )  
            INNER JOIN dbo.recurso r ON ( i.rec_id = r.rec_id  )  
                INNER JOIN dbo.equipamentos e ON ( r.rec_id = e.rec_id  )  
    WHERE s.servico_nome like '%$text%' ";
    $result = sqlsrv_query($conn,$sql);
    if($result){
        while($row = sqlsrv_fetch_array($result)){
            echo '
                <tr data-toggle="modal" data-target="#loadservico" style="cursor:pointer;" id="row_servico_'.$row['servico_id'].'" onclick="loaddata(\'servico\','.$row['servico_id'].')">
                    <td>'.$row['servico_nome'].'</td><td>'.$row['eq_marca'].'</td><td>'.$row['eq_modelo'].'</td>
                </tr>';
        }
    }

}
