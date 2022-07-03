<?php

if (isset($_POST['submit'])){
    $u_nome = $_POST['u_name'];
    $u_email = $_POST['u_email'];
    $u_pass = $_POST['u_pass'];
    include("../includes/conn/conn.php");
    echo $u_nome;
    $sql = "SELECT u_nome FROM utilizador WHERE u_nome='$u_nome';";
    $result = sqlsrv_query($conn,$sql);
    if($result){
        if(sqlsrv_has_rows($result) === true){
            header("Location: ../sign-in/?usertaken&u_email=$u_email");
            exit();
        }
    }
    $hash = password_hash($u_pass,PASSWORD_DEFAULT);
    $sql = "INSERT INTO utilizador (nome,u_nome,u_password,u_email,u_membro,u_tipo,u_funcao) VALUES ('$u_nome','$u_nome','$hash','$u_email',0,0,'Cliente')";
    $result = sqlsrv_query($conn,$sql);
    if($result){
        header("Location: ../sign-in/?success");
        exit();
    }else{
        header("Location: ../sign-in/?error");
        exit();
    }

}else{
    header("Location: ../sign-in");
}