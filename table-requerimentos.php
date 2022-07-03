<?php
if(isset($tipo)){


echo '<table class="table table-hover">
    <thead>
        <tr>
            <th> Nome do Serviço </th>
            <th> Data de inicio </th>
            <th> Data de fim </th>
            <th> Estado </th>
            <th> Coordenador </th>
        </tr>
    </thead>
    <tbody>';
    include "includes/conn/conn.php";//especificar o caminho absoluto
    $sql = "SELECT r.req_inicio, r.req_fim, r.req_estado, s.servico_nome, u.nome
    FROM dbo.requerimento r 
        INNER JOIN dbo.servico s ON ( r.req_servico = s.servico_id  )  
        INNER JOIN dbo.utilizador u ON ( r.req_requerendo = u.u_id  )  ";
    $result = sqlsrv_query($conn,$sql);
    if($result){
        while($row = sqlsrv_fetch_array($result)){
            echo '<tr class="text-center">';
            echo '<td style="min-width:100px">'.$row['servico_nome'].'</td>';
            echo '<td style="min-width:100px">'.$row['req_inicio']->format('d-m-Y').'</td>';
            echo '<td style="min-width:100px">'.$row['req_fim']->format('d-m-Y').'</td>';
            echo '<td style="min-width:100px">';
            if($row['req_estado'] == 0){
                echo 'Inativo</td>';
            }else {
                echo 'Ativo</td>';
            }
            echo '<td style="min-width:100px">'.$row['nome'].'</td>';
            echo '</tr>';
        }
    }
       
    echo '</tbody>
</table>';
}else{
    header ("Location : /");
}
?>