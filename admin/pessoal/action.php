<?php

    if(isset($_POST['editpessoal'])){
        $u_id = $_POST['editpessoal'];
        $nome = $_POST['nome'];
        $u_nome = $_POST['u_nome'];
        $u_email = $_POST['u_email'];
        $u_membro = $_POST['u_membro'];
        $u_tipo = $_POST['u_tipo'];
        $u_lab = $_POST['u_lab'];
        $u_funcao = $_POST['u_funcao'];
        include "../../includes/conn/conn.php";
        $sql0 = "SELECT u_nome,u_id FROM utilizadores WHERE u_nome = ?";
        $result0 = sqlsrv_query($conn,$sql0,array($u_nome));
        if($result0){
            if(sqlsrv_has_rows($result0)){
                if($row = sqlsrv_fetch_array($result0)){
                    if($row['u_id'] != $u_id){
                        sqlsrv_close($conn);
                        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Este nome de utilizador já está a ser utilizado.</div>';
                        exit(0);
                    }
                }else{
                    sqlsrv_close($conn);
                    echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao atualizar.</div>';
                    exit(0);
                }
                
            }
        }else{
            sqlsrv_close($conn);
            echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao atualizar.</div>';
            exit(0);
        }
        if(sqlsrv_begin_transaction($conn) === false){
            echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao atualizar.</div>';
            exit(0);
        }
        $sql = "UPDATE utilizador SET nome=?,u_nome=?,u_membro=?,u_email=?,u_tipo=?,u_funcao=? WHERE u_id=?";
        $result = sqlsrv_query($conn,$sql,array($nome,$u_nome,$u_membro,$u_email,$u_tipo,$u_funcao,$u_id));
        if($u_lab == 0){
            $sql1 = "SELECT u_id FROM pertence WHERE u_id=?";
            $result1 = sqlsrv_query($conn,$sql1,array($u_id));
            if($result1){
                if(sqlsrv_has_rows($result1)){
                    $sql2 = "DELETE FROM pertence WHERE u_id=?";
                    $result2 = sqlsrv_query($conn,$sql2,array($u_id));
                    if(!$result){
                        sqlsrv_rollback($conn);
                        echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao atualizar.</div>';
                        exit(0);
                    }
                }
            }
        }else{
            $sql1 = "UPDATE pertence SET lab_id=? WHERE u_id=?";
            $result1 = sqlsrv_query($conn,$sql1,array($u_lab,$u_id));
        }
        if($result && $result1){
            sqlsrv_commit($conn);
            echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Atualizado com sucesso.</div>';
        }else{
            sqlsrv_rollback($conn);
            echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao atualizar.</div>';
        }
        sqlsrv_close($conn);
    }else if(isset($_POST['addpessoal'])){
        $nome = $_POST['nome'];
        $u_nome = $_POST['u_nome'];
        $u_email = $_POST['u_email'];
        $u_membro = $_POST['u_membro'];
        $u_password = $_POST['u_password'];
        $u_lab = $_POST['u_lab'];
        $u_tipo = $_POST['u_tipo'];
        $u_funcao = $_POST['u_funcao'];
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
        $sql0 = "SELECT u_nome FROM utilizadores WHERE u_nome = ?";
        $result0 = sqlsrv_query($conn,$sql0,array($u_nome));
        if($result){
            if(sqlsrv_has_rows($result)){
                sqlsrv_close($conn);
                echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Este nome de utilizador já está a ser utilizado.</div>';
                exit(0);
            }
        }

        if($u_lab == 0){
            if(sqlsrv_begin_transaction($conn) === false){
                sqlsrv_close($conn);
                echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
                exit(0);
            }
            $sql = "INSERT INTO utilizador (nome,u_nome,u_membro,u_email,u_tipo,u_password,u_funcao) VALUES  (?,?,?,?,?,?,?)";
            $result = sqlsrv_query($conn,$sql,array($nome,$u_nome,$u_membro,$u_email,$u_tipo,$u_password,$u_funcao));

            $sql2 = "INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES (?,?,?,?)";
            $result2 = sqlsrv_query($conn,$sql2,array($u_funcao,$u_funcao,"Recursos Humanos",0));
            
            $sql3 = "INSERT INTO rec_u (u_id,rec_id) VALUES ((SELECT MAX(u_id) FROM utilizador),(SELECT MAX(rec_id) FROM recurso))";
            $result3 = sqlsrv_query($conn,$sql3);
            if($result && $result2 && $result3){
                sqlsrv_commit($conn);
                echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Adicionado com sucesso.</div>';
            }else{
                sqlsrv_rollback($conn);
                echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
            }
        }else{
            if(sqlsrv_begin_transaction($conn) === false){
                sqlsrv_close($conn);
                echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
                exit(0);
            }
            $sql = "INSERT INTO utilizador (nome,u_nome,u_membro,u_email,u_tipo,u_password,u_funcao) VALUES  (?,?,?,?,?,?,?)";
            $result = sqlsrv_query($conn,$sql,array($nome,$u_nome,$u_membro,$u_email,$u_tipo,$u_password,$u_funcao));

            $sql2 = "INSERT INTO pertence (u_id,lab_id) VALUES ((SELECT MAX(u_id) FROM utilizador),?);";
            $result2 = sqlsrv_query($conn,$sql2,array($u_lab));

            $sql3 = "INSERT INTO recurso (rec_designacao_pt,rec_designacao_en,rec_obs,rec_custo) VALUES (?,?,?,?)";
            $result3 = sqlsrv_query($conn,$sql3,array($u_funcao,$u_funcao,"Recursos Humanos",0));

            $sql4 = "INSERT INTO rec_u (u_id,rec_id) VALUES ((SELECT MAX(u_id) FROM utilizador),(SELECT MAX(rec_id) FROM recurso))";
            $result4 = sqlsrv_query($conn,$sql4);

            if($result && $result2 && $result3 && $result4){
                sqlsrv_commit($conn);
                echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Adicionado com sucesso.</div>';
            }else{
                sqlsrv_rollback($conn);
                echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adicionar.</div>';
            }

        }
        
        sqlsrv_close($conn);
        exit(0);
    }else if(isset($_POST['erasepessoal'])){
        $u_id = $_POST['erasepessoal'];
        
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
        if(sqlsrv_begin_transaction($conn) === false){
            echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao eliminar.0</div>';
            exit(0);
        }
        $sql2_1 = "SELECT rec_id FROM rec_u WHERE u_id = ?";
        $result2_1 = sqlsrv_query($conn,$sql2_1,array($u_id));
        if(!$result2_1){
            sqlsrv_rollback($conn);
            echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao eliminar.1</div>'; 
            exit(0);
        }
        $row = sqlsrv_fetch_array($result2_1);
        $rec_id = $row['rec_id'];
        
        $sql1 = "DELETE FROM pertence WHERE u_id = ?";
        $result1 = sqlsrv_query($conn,$sql1,array($u_id));
        $sql2 = "DELETE FROM rec_u WHERE u_id = ?";
        $result2 = sqlsrv_query($conn,$sql2,array($u_id));
        $sql3 = "DELETE FROM recurso WHERE rec_id = ?";
        $result3 = sqlsrv_query($conn,$sql3,array($rec_id));
        $sql4 = "DELETE FROM utilizador WHERE u_id = ?";
        $result4 = sqlsrv_query($conn,$sql4,array($u_id));
        
        if($result1 && $result2 && $result3 && $result4){
            sqlsrv_commit($conn);
            echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Eliminado com sucesso.</div>';
        }else{
            sqlsrv_rollback($conn);
            echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao eliminar.2</div>';
        }
        sqlsrv_close($conn);
    }else if(isset($_POST['search'])){
        $text = $_POST['search'];
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
        $sql = "SELECT * FROM utilizador WHERE u_nome LIKE '%$text%' OR u_email LIKE '%$text%' OR nome LIKE '%$text%';";
        $result = sqlsrv_query($conn,$sql,array($text));
        if($result){
            while($row = sqlsrv_fetch_array($result)){
                echo '<tr id="pess_row_'.$row["u_id"].'">
                        <td>'.$row["u_id"].'</td>
                        <td>'.$row['nome'].'</td>
                        <td>'.$row["u_nome"].'</td>
                        <td>'.$row["u_email"].'</td>
                        <td class="d-none">'.$row['u_funcao'].'</td>
                        <td style="display:none" class="'.$row["u_membro"].'">';
                            if($row["u_membro"]) echo 'Sim'; else echo 'Não';
                        echo '</td>
                        <td class="'.$row["u_tipo"].'">';
                            switch ($row["u_tipo"]) {
                                case 0:
                                    echo 'Utilizador';
                                break;
                                case 1:
                                    echo 'Utilizador Moderado';
                                break;
                                case 2:
                                    echo 'Utilizador priviligeado';
                                break;
                                case 3:
                                    echo 'Administrador';
                                break;
                            }
                        echo '</td>';
                        $sql = "SELECT lab_id FROM pertence WHERE u_id=?";
                        $result_lab = sqlsrv_query($conn,$sql,array($row['u_id']));

                        if($result_lab){
                            $lab = sqlsrv_fetch_array($result_lab);
                            echo '<td class="d-none">'.$lab['lab_id'].'</td>';
                        }else{
                            echo '<td class="d-none"></td>';
                        }
                        echo '<td>
<<<<<<< HEAD
                        <div class="text-center buttons-min-width">
                            <button type="button" class="btn btn-info" onclick="editar(this.id)" data-toggle="modal" data-target="#editpessoal" id="pess_'.$row['u_id'].'_edit">
                            <div class="show-mobile">
                                <svg class="bi bi-pencil-square mb-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </div>
                            <div class="show-pc">Editar</div>
                            </button>
                            <button type="button" class="btn btn-danger" id="pess_'.$row['u_id'].'_erase" onclick=\'$("#erasepessoal .btn-danger").val('.$row['u_id'].');\' data-toggle="modal" data-target="#erasepessoal">
                            <div class="show-mobile">
                                <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
=======
                            div class="text-center buttons-min-width" >
                                <button type="button" class="btn btn-info" onclick="editar(this.id)" data-toggle="modal" data-target="#editpessoal" id="pess_'.$row['u_id'].'_edit">
                                <div class="show-mobile">
                                    <svg class="bi bi-pencil-square mb-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </div>
                                <div class="show-pc">Editar</div>
                                </button>
                                <button type="button" class="btn btn-danger" id="pess_'.$row['u_id'].'_erase" onclick=\'$("#erasepessoal .btn-danger").val('.$row['u_id'].');\' data-toggle="modal" data-target="#erasepessoal">
                                <div class="show-mobile">
                                    <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </div>
                                <div class="show-pc">Eliminar</div>
                                </button>
>>>>>>> 87530f57dc2a3944b1ce16f4e8d3391bef6f04ac
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