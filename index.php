<?php
session_start();
if(isset($_SESSION['u_id'])){
    include "header/header.php";
    include "includes/conn/conn.php";
    $sql = "SELECT nome,u_tipo FROM utilizador WHERE u_id = ?";
    $result = sqlsrv_query($conn,$sql,array($_SESSION['u_id']));
    if($result){
        $row = sqlsrv_fetch_array($result);
        echo '<h1 class="text-center">Bem vindo '.$row['nome'].'</h1>';
        $tipo = $row['u_tipo'];
    }else{
        echo 'ERRO NA BASE DE DADOS';
        exit(0);
    }
    echo '
    <div class="container-xl p-1 m-auto w-100 text-center">
        <div class="row">';
                $sql = 'SELECT r.req_inicio, r.req_fim, s.servico_nome
                FROM dbo.utilizador u 
                    INNER JOIN dbo.requerimento r ON ( u.u_id = r.req_requerendo  )  
                        INNER JOIN dbo.servico s ON ( r.req_servico = s.servico_id  )  
                WHERE u.u_id = ?';
                $result = sqlsrv_query($conn,$sql,array($_SESSION['u_id']));

                if($result){
                    if(sqlsrv_has_rows($result)){
                    echo ' <div class="col-lg">
                                <h6 class="my-3">Os seus requerimentos</h6>
                                    <ul class="list-group w-75 m-auto" style="max-height:300px;overflow:auto;">
                    ';
                    while($row = sqlsrv_fetch_array($result)){
                        echo '<li class="list-group-item">'.$row['servico_nome'].' (<strong>'.$row['req_inicio']->format('d-m-Y').'</strong> a <strong>'.$row['req_fim']->format('d-m-Y').'</strong>)</li>';
                    }
                    echo '</ul>
                    </div>';
                    }
                }

                $sql = "SELECT e.eq_marca, e.eq_nome
                FROM dbo.utilizador u 
                    INNER JOIN dbo.equipamentos e ON ( u.u_id = e.eq_zelador  )  
                WHERE u.u_id = ?";
                $result = sqlsrv_query($conn,$sql,array($_SESSION['u_id']));
                if($result){
                    if(sqlsrv_has_rows($result)){
                    echo '<div class="col-lg">
                            <h6 class="my-3">Responsável pelos os seguintes equipamentos</h6>
                                <ul class="list-group w-75 m-auto" style="max-height:300px;overflow:auto;">
                    ';
                    while($row = sqlsrv_fetch_array($result)){
                        echo '<li class="list-group-item">'.$row['eq_nome'].' (<strong>'.$row['eq_marca'].'</strong>)</li>';
                    }
                    echo '</ul>
                    </div>';
                    }
                }

                $sql = "SELECT s.servico_nome
                FROM dbo.utilizador u 
                    INNER JOIN dbo.servico s ON ( u.u_id = s.servico_coord  )  
                WHERE u.u_id = ?";
                $result = sqlsrv_query($conn,$sql,array($_SESSION['u_id']));

                if($result){
                    if(sqlsrv_has_rows($result)){
                        echo '<div class="col-lg">
                                <h6 class="my-3">Coordenador dos seguintes serviços</h6>
                                    <ul class="list-group w-75 m-auto" style="max-height:300px;overflow:auto;">
                        ';
                        while($row = sqlsrv_fetch_array($result)){
                            echo '<li class="list-group-item">'.$row['servico_nome'].'</li>';
                        }
                            echo '</ul>
                        </div>';
                    }
                   
                }
                echo '</div>';
                if($tipo > 2){
                    echo '<div class="my-5 w-100" style="overflow:auto;">
                            <h4>Todos os requerimentos</h4>';
                            require "table-requerimentos.php";
                    echo '</div>';
        
                }else{
                    echo '<div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl">
                                <a class="card shadow-sm text-center text-dark" href="servicos/">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <svg class="bi bi-bag" width="4em" height="4em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
                                                <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
                                            </svg>
                                        </div>
                                        <h5 class="card-title text-center">Requisitar serviço</h5>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl">
                                <a class="card shadow-sm text-center text-dark" href="profile/">
                                    <div class="card-body ">
                                        <div class="mb-4">
                                        <svg class="bi bi-person-fill" width="4em" height="4em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                        </svg>
                                        </div>
                                        <h5 class="card-title">Minha Conta</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>';
                }
}else{
    header("Location: login/");
}
?>

