<?php
if(isset($_POST['addformacao'])){
    $rec_designacao_pt = $_POST['rec_designacao_pt'];
    $rec_descignacao_en = $_POST['rec_designacao_en'];
    $rec_obs = $_POST['rec_obs'];
    $rec_custo = $_POST['rec_custo'];
    $form_tipo = $_POST['form_tipo'];
    $form_vagas = $_POST['form_vagas'];

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

    $sql3 = "INSERT INTO formacao (rec_id,form_tipo,form_vagas) VALUES (?,?,?)";
    $result3 = sqlsrv_query($conn,$sql3,array($rec_id,$form_tipo,$form_vagas));
    if($result3){
        sqlsrv_commit($conn);
        sqlsrv_close($conn);
        echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Adicionado com sucesso.</div>';
        exit(1);
    }
    sqlsrv_rollback($conn);
    sqlsrv_close($conn);
    echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
    exit(0);
    
}else if (isset($_POST['editformacao'])){
    $rec_designacao_pt = $_POST['rec_designacao_pt'];
    $rec_descignacao_en = $_POST['rec_designacao_en'];
    $rec_obs = $_POST['rec_obs'];
    $rec_custo = $_POST['rec_custo'];
    $form_tipo = $_POST['form_tipo'];
    $form_vagas = $_POST['form_vagas'];
    $rec_id = $_POST['editformacao'];

    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
    if(sqlsrv_begin_transaction($conn) === false){
        sqlsrv_close($conn);
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao alterar.</div>';
        exit(0);
    }

    $sql1 = "UPDATE recurso SET rec_designacao_pt=?, rec_designacao_en=?, rec_obs=?, rec_custo=? WHERE rec_id=?";
    $result1 = sqlsrv_query($conn,$sql1,array($rec_designacao_pt,$rec_descignacao_en,$rec_obs,$rec_custo,$rec_id));

    $sql2 = "UPDATE formacao SET form_tipo=?, form_vagas=? WHERE rec_id = ?";
    $result2 = sqlsrv_query($conn,$sql2,array($form_tipo,$form_vagas,$rec_id));

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
}else if (isset($_POST['eraseformacao'])){
    $rec_id = $_POST['eraseformacao'];
    
    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
    if(sqlsrv_begin_transaction($conn) === false){
        sqlsrv_close($conn);
        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao eliminar.</div>';
        exit(0);
    }
    
    $sql1 = "DELETE FROM formacao WHERE rec_id = ?";
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
    $sql = "SELECT * FROM formacao AS d  INNER JOIN recurso AS r ON ( d.rec_id = r.rec_id  ) WHERE r.rec_designacao_pt LIKE '%$text%' OR r.rec_designacao_en LIKE '%$text%' OR d.form_tipo LIKE '%$text%' ;";
    $result = sqlsrv_query($conn,$sql);
    if($result){
        while($row = sqlsrv_fetch_array($result)){
            echo '<tr id="formacao_row_'.$row["rec_id"].'">
                        <td>'.$row['rec_designacao_pt'].'</td>
                        <td class="'.$row["form_tipo"].'">';
                            switch ($row["form_tipo"]) {
                                case 'e-learning':
                                    echo 'e-learning';
                                break;
                                case 'presencial':
                                    echo 'presencial';
                                break;
                                case 'software':
                                    echo 'software';
                                break;
                                case 'modelação':
                                    echo 'modelação';
                                break;
                                case 'equipamento':
                                    echo 'equipamento';
                                break;
                            }
                        echo '</td>
                        <td>'.$row["form_vagas"].'</td>
                        <td>'.$row['rec_custo'].'</td>
                        <td class="d-none">'.$row['rec_designacao_en'].'</td>
                        <td class="d-none">'.$row['rec_obs'].'</td>';
                        echo '<td>
                            <div class="text-center buttons-min-width" >
                                <button type="button" class="btn btn-info" onclick="editar(this.id)" data-toggle="modal" data-target="#editformacao" id="formacao_'.$row['rec_id'].'_edit">
                                <div class="show-mobile">
                                    <svg class="bi bi-pencil-square mb-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </div>
                                <div class="show-pc">Editar</div>
                                </button>
                                <button type="button" class="btn btn-danger" id="formacao_'.$row['rec_id'].'_erase" onclick=\'$("#eraseformacao .btn-danger").val('.$row['rec_id'].');\' data-toggle="modal" data-target="#eraseformacao">
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