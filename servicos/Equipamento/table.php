<?php
    echo"
<table class=\"table table-hover\">
    
    <thead>
        <tr>
        <th></th><th>Marca</th><th>Modelo</th>
        </tr>
    </thead>
    <tbody>
    
    ";
    include "../includes/conn/conn.php";
    $sql = "SELECT s.servico_nome,s.servico_id, e.eq_marca, e.eq_modelo
    FROM dbo.servico s 
        INNER JOIN dbo.incui i ON ( s.servico_id = i.servico_id  )  
            INNER JOIN dbo.recurso r ON ( i.rec_id = r.rec_id  )  
                INNER JOIN dbo.equipamentos e ON ( r.rec_id = e.rec_id  )  
   ";
    $result = sqlsrv_query($conn,$sql); 
    if($result){
        while($row = sqlsrv_fetch_array($result)){
           echo '
                <tr data-toggle="modal" data-target="#loadservico" style="cursor:pointer;" id="row_servico_'.$row['servico_id'].'" onclick="loaddata(\'servico\','.$row['servico_id'].')">
                    <td>'.$row['servico_nome'].'</td><td>'.$row['eq_marca'].'</td><td>'.$row['eq_modelo'].'</td>
                </tr>';
        }
    }
    ?>