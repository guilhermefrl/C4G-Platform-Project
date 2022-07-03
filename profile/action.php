<?php

if (isset($_POST['submit'])){
    if($_POST['submit'] == 'atualizar'){
        if(!(session_status() === PHP_SESSION_ACTIVE)){
            session_start(); 
        }
        $id = $_SESSION['u_id'];
        $u_name = $_POST['u_name'];
        $u_email = $_POST['u_email'];
        include "../includes/conn/conn.php";
        $sql = "SELECT u_nome,u_id,u_email FROM utilizador WHERE u_nome=?";
        $result = sqlsrv_query($conn,$sql,array($u_name));
        if($result){
            if(sqlsrv_has_rows($result) == true){
                $row = sqlsrv_fetch_array($result);
                if($id != $row['u_id']){
                    header("Location: ../profile/?usertaken"); 
                    exit();
                }else if($row['u_email'] == $u_email){
                    header("Location: ../profile/?success");
                    exit();
                }
            }
        }else{
            header("Location: ../profile/?error=select"); 
            exit();
        }
        $sql = "UPDATE utilizador SET u_nome=?, u_email=? WHERE u_id=?";
        $result = sqlsrv_query($conn,$sql,array($u_name,$u_email,$id));
        if($result){
           header("Location: ../profile/?success"); 
           exit();
        }
        header("Location: ../profile/?error=update");
        exit();
    }
    if($_POST['submit'] == 'eliminar'){
        if(!(session_status() === PHP_SESSION_ACTIVE)){
            session_start(); 
        }
        $id = $_SESSION['u_id'];
        require "../includes/conn/conn.php";
        $sql = "DELETE FROM utilizador WHERE u_id =?";
        $result = sqlsrv_query($conn,$sql,array($id));
        if($result){
            session_start();
            session_unset();
            session_destroy();
            header("Location: ../login/?account-deleted");
            exit();
        }

        header("Location: ../profile/?error=deleting");
    }
    if($_POST['submit'] == 'password'){
        if(!(session_status() === PHP_SESSION_ACTIVE)){
            session_start(); 
        }
        $id = $_SESSION['u_id'];
        $old_pwd = $_POST['u_password'];
        $new_pwd = $_POST['u_new_password'];
        require "../includes/conn/conn.php";
        //buscar a password do utilizador 
        $sql = "SELECT u_password FROM utilizador WHERE u_id =?";
        $result = sqlsrv_query($conn,$sql,array($id));
        if($result){
            if($row = sqlsrv_fetch_array($result)){
                //se a password antiga for igual à introduzida
                if(password_verify($old_pwd,$row['u_password'])){
                    //mudar a password
                    $sql = "UPDATE utilizador SET u_password=? WHERE u_id=?";
                    $hash = password_hash($new_pwd,PASSWORD_DEFAULT);
                    $result = sqlsrv_query($conn,$sql,array($hash,$id));
                    if($result){
                        header("Location: ../profile/?success");
                        exit();
                    }
                }
            }
        }
        header("Location: ../profile/?error=password");
        exit();
    }
}else{
    header("Location: ../profile");
}