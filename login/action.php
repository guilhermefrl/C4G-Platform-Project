<?php
    if(isset($_POST['submit'])){
        include "../includes/conn/conn.php";
        $u_name = $_POST['u_name'];
        $u_pass = $_POST['u_pass'];
        
        $sql = "SELECT u_id,u_nome,u_password FROM utilizador WHERE u_nome =?;";
        $stmt = sqlsrv_prepare($conn, $sql, array(&$u_name));
        $result = sqlsrv_execute($stmt);
        if($result){//retorna falso se houver algum erro no query
                if($row = sqlsrv_fetch_array($stmt)){
                    if ( $row['u_password'] == $u_pass || password_verify($u_pass,$row['u_password'])){
                        session_start();
                        $_SESSION['u_id'] = $row['u_id'];
                        header("Location: ../");
                        exit();
                    }else{
                        header("Location: ../login/?wrong&u_name=$u_name'");
                        exit();
                    }
                }
            }
        header("Location: ../login/?wrong");
        exit();
    }else if(isset($_GET['logout'])){
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../");
        exit();
    }else{
        header("Location: /");
        exit();
    }