<?php

if(isset($_POST['addreq'])){
        if(!(session_status() === PHP_SESSION_ACTIVE)){
            session_start(); 
        }
        if(!isset($_POST['req_inicio']) || !isset($_POST['req_fim'])){
            echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Requerimento adicionado.</div>';
            exit(1);
        }
        $servico_id = $_POST['addreq'];
        $req_inicio = $_POST['req_inicio'];
        $grp_id = $_POST['grp_id'];
        $req_fim = $_POST['req_fim'];
        
        include "../includes/conn/conn.php";
        $sql = "INSERT INTO requerimento (req_estado, req_inicio, req_fim, grp_id, req_requerendo, req_servico) 
        VALUES (?,(SELECT CAST(? AS Date)),(SELECT CAST(? AS Date)),?,?,?)";
        $result = sqlsrv_query($conn,$sql,array(1,$req_inicio,$req_fim,$grp_id,$_SESSION['u_id'],$servico_id));

        if($result){
            echo '<div class="alert alert-success fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Requerimento adicionado.</div>';
            exit(1);
        }else{
            echo '<div class="alert alert-danger fade show position-fixed mw-25" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert">Erro ao adcicionar requerimento.</div>';
            exit(0);
        }
        
}else{
    header("Location: index.php");
}