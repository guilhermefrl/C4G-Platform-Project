<?php
if(isset($_POST['addequipamentos'])){
    $rec_designacao_pt = $_POST['rec_designacao_pt'];
    $rec_descignacao_en = $_POST['rec_designacao_en'];
    $rec_obs = $_POST['rec_obs'];
    $rec_custo = $_POST['rec_custo'];
    $eq_n_serie = $_POST['eq_n_serie'];
    $eq_marca = $_POST['eq_marca'];
    $eq_modelo = $_POST['eq_modelo'];
    $eq_fornecedor = $_POST['eq_fornecedor'];
    $eq_loc_hab = $_POST['eq_loc_hab'];
    $eq_manuseio_terceiros = $_POST['eq_manuseio_terceiros'];
    $eq_foto = $_POST['eq_foto'];
    $eq_data_aq = $_POST['eq_data_aq'];
    $eq_garantia = $_POST['eq_garantia'];
    $eq_cond_uso = $_POST['eq_cond_uso'];
    $eq_mobilidade = $_POST['eq_mobilidade'];
    $eq_tipo_uso = $_POST['eq_tipo_uso'];
    $eq_nome = $_POST['eq_nome'];
    $eq_aq_C4G = $_POST['eq_aq_C4G'];
    $eq_zelador = $_POST['eq_zelador'];

    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
    if(sqlsrv_begin_transaction($conn) === false){
        sqlsrv_close($conn);
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
        exit(0);
    }
    $sql1 = "INSERT INTO recurso (rec_designacao_pt,rec_obs,rec_designacao_en,rec_custo) VALUES (?,?,?,?)";
    $result1 = sqlsrv_query($conn,$sql1,array($rec_designacao_pt,$rec_obs,$rec_descignacao_en,$rec_custo));
    if(!$result1){
        sqlsrv_rollback($conn);
        sqlsrv_close($conn);
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
        exit(0);
    }
    $sql2 = "SELECT MAX(rec_id) FROM recurso";
    $result2 = sqlsrv_query($conn,$sql2);
    if(!$result2){
        sqlsrv_rollback($conn);
        sqlsrv_close($conn);
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
        exit(0);
    }
    $row = sqlsrv_fetch_array($result2);
    $rec_id = $row[0];

    $sql3 = "INSERT INTO equipamentos (rec_id,eq_zelador,eq_n_serie,eq_marca,eq_modelo,eq_fornecedor,eq_loc_hab,eq_manuseio_terceiros,eq_foto,eq_data_aq,eq_garantia,eq_cond_uso,eq_mobilidade,eq_tipo_uso,eq_nome,eq_aq_C4G) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $result3 = sqlsrv_query($conn,$sql3,array($rec_id,$eq_zelador,$eq_n_serie,$eq_marca,$eq_modelo,$eq_fornecedor,$eq_loc_hab,$eq_manuseio_terceiros,$eq_foto,$eq_data_aq,$eq_garantia,$eq_cond_uso,$eq_mobilidade,$eq_tipo_uso,$eq_nome,$eq_aq_C4G));
    if($result3){
        sqlsrv_commit($conn);
        sqlsrv_close($conn);
        echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Adicionado com sucesso.</div>';
        exit(1);
    }
    else{
    sqlsrv_rollback($conn);
    sqlsrv_close($conn);
    echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
    exit(0);
    }
    
}else if (isset($_POST['editequipamentos'])){
    $rec_designacao_pt = $_POST['rec_designacao_pt'];
    $rec_descignacao_en = $_POST['rec_designacao_en'];
    $rec_obs = $_POST['rec_obs'];
    $rec_custo = $_POST['rec_custo'];
    $eq_n_serie = $_POST['eq_n_serie'];
    $eq_marca = $_POST['eq_marca'];
    $eq_modelo = $_POST['eq_modelo'];
    $eq_fornecedor = $_POST['eq_fornecedor'];
    $eq_loc_hab = $_POST['eq_loc_hab'];
    $eq_manuseio_terceiros = $_POST['eq_manuseio_terceiros'];
    $eq_foto = $_POST['eq_foto'];
    $eq_data_aq = $_POST['eq_data_aq'];
    $eq_garantia = $_POST['eq_garantia'];
    $eq_cond_uso = $_POST['eq_cond_uso'];
    $eq_mobilidade = $_POST['eq_mobilidade'];
    $eq_tipo_uso = $_POST['eq_tipo_uso'];
    $eq_nome = $_POST['eq_nome'];
    $eq_aq_C4G = $_POST['eq_aq_C4G'];
    $eq_zelador = $_POST['eq_zelador'];
    $rec_id = $_POST['editequipamentos'];

    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
    if(sqlsrv_begin_transaction($conn) === false){
        sqlsrv_close($conn);
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao alterar.</div>';
        exit(0);
    }

    $sql1 = "UPDATE recurso SET rec_designacao_pt=?, rec_designacao_en=?, rec_obs=?, rec_custo=? WHERE rec_id=?";
    $result1 = sqlsrv_query($conn,$sql1,array($rec_designacao_pt,$rec_descignacao_en,$rec_obs,$rec_custo,$rec_id));

    $sql2 = "UPDATE equipamentos SET eq_zelador=?, eq_n_serie=?, eq_marca=?, eq_modelo=?, eq_fornecedor=?, eq_loc_hab=?, eq_manuseio_terceiros=?, eq_foto=?, eq_data_aq=?, eq_garantia=?, eq_cond_uso=?, eq_mobilidade=?, eq_tipo_uso=?, eq_nome=?, eq_aq_C4G=? WHERE rec_id = ?";
    $result2 = sqlsrv_query($conn,$sql2,array($eq_zelador,$eq_n_serie,$eq_marca,$eq_modelo,$eq_fornecedor,$eq_loc_hab,$eq_manuseio_terceiros,$eq_foto,$eq_data_aq,$eq_garantia,$eq_cond_uso,$eq_mobilidade,$eq_tipo_uso,$eq_nome,$eq_aq_C4G,$rec_id));

    if($result1 && $result2){
        sqlsrv_commit($conn);
        sqlsrv_close($conn);
        echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Alterado com sucesso.</div>';
        exit(1);
    }
    sqlsrv_rollback($conn);
    sqlsrv_close($conn);
    echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao alterar.</div>';
    exit(0);
}else if (isset($_POST['eraseequipamentos'])){
    $rec_id = $_POST['eraseequipamentos'];
    
    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
    if(sqlsrv_begin_transaction($conn) === false){
        sqlsrv_close($conn);
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao eliminar.</div>';
        exit(0);
    }
    
    $sql1 = "DELETE FROM equipamentos WHERE rec_id = ?";
    $result1 = sqlsrv_query($conn,$sql1,array($rec_id));
    
    $sql2 = "DELETE FROM recurso WHERE rec_id=?";
    $result2 = sqlsrv_query($conn,$sql2,array($rec_id));

    if($result1 && $result2){
        sqlsrv_commit($conn);
        sqlsrv_close($conn);
        echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Eliminado com sucesso.</div>';
        exit(1);
    }
    sqlsrv_rollback($conn);
    sqlsrv_close($conn);
    echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao eliminar.</div>';
    exit(0);
}else if(isset($_POST['search'])){
    $text = $_POST['search'];

    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
    $sql = "SELECT * FROM equipamentos AS d  INNER JOIN recurso AS r ON ( d.rec_id = r.rec_id  ) WHERE r.rec_designacao_pt LIKE '%$text%' OR r.rec_designacao_en LIKE '%$text%' OR d.eq_marca LIKE '%$text%' ;";
    $result = sqlsrv_query($conn,$sql);
    if($result){
        while($row = sqlsrv_fetch_array($result)){
            echo '<tr id="equipamentos_row_'.$row["rec_id"].'">
                        <td>'.$row['rec_designacao_pt'].'</td>
                        <td>'.$row["eq_n_serie"].'</td>
                        <td>'.$row["eq_marca"].'</td>
                        <td>'.$row["eq_modelo"].'</td>
                        <td>'.$row["eq_fornecedor"].'</td>
                        <td>'.$row["eq_loc_hab"].'</td>
                        <td>'.$row['rec_custo'].'</td>
                        <td style="display:none;" class="'.$row["eq_manuseio_terceiros"].'">';
                            switch ($row["eq_manuseio_terceiros"]) {
                                case 0:
                                    echo 'Não';
                                break;
                                case 1:
                                    echo 'Sim';
                                break;
                            }
                        echo '</td>
                        <td style="display:none;" class="'.$row["eq_cond_uso"].'">';
                            switch ($row["eq_cond_uso"]) {
                                case 0:
                                    echo 'Não Operacional';
                                break;
                                case 1:
                                    echo 'Operacional';
                                break;
                            }
                        echo '</td>
                        <td style="display:none;" class="'.$row["eq_mobilidade"].'">';
                            switch ($row["eq_mobilidade"]) {
                                case 'F':
                                    echo 'Fixo';
                                break;
                                case 'P':
                                    echo 'Portátil';
                                break;
                            }
                        echo '</td>
                        <td style="display:none;" class="'.$row["eq_tipo_uso"].'">';
                            switch ($row["eq_tipo_uso"]) {
                                case 'E':
                                    echo 'Partilha do Equipamento';
                                break;
                                case 'D':
                                    echo 'Partilha de Dados';
                                break;
                                case 'P':
                                    echo 'Uso Pessoal';
                                break;
                            }
                        echo '</td>
                        <td style="display:none;" class="'.$row["eq_aq_C4G"].'">';
                            switch ($row["eq_aq_C4G"]) {
                                case 0:
                                    echo 'Não';
                                break;
                                case 1:
                                    echo 'Sim';
                                break;
                            }
                        echo '</td>

                        <td class="d-none">'.$row['rec_designacao_en'].'</td>
                        <td class="d-none">'.$row['rec_obs'].'</td>
                        <td class="d-none">'.$row['eq_foto'].'</td>
                        <td class="d-none">'.$row['eq_data_aq']->format('d/m/Y').'</td>
                        <td class="d-none">'.$row['eq_garantia']->format('d/m/Y').'</td>
                        <td class="d-none">'.$row['eq_nome'].'</td>
                        <td class="d-none">'.$row['eq_zelador'].'</td>';

                        echo '<td>
                            <div class="text-center buttons-min-width" >
                                <button type="button" class="btn btn-info" onclick="editar(this.id)" data-toggle="modal" data-target="#editequipamentos" id="equipamentos_'.$row['rec_id'].'_edit">
                                <div class="show-mobile">
                                    <svg class="bi bi-pencil-square mb-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </div>
                                <div class="show-pc">Editar</div>
                                </button>
                                <button type="button" class="btn btn-danger" id="equipamentos_'.$row['rec_id'].'_erase" onclick=\'$("#eraseequipamentos .btn-danger").val('.$row['rec_id'].');\' data-toggle="modal" data-target="#eraseequipamentos">
                                <div class="show-mobile">
                                    <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </div>
                                <div class="show-pc">Eliminar</div>
                                </button>
                            </div>
                        </td>
                    </tr>';
        }

    }
    sqlsrv_close($conn);

}