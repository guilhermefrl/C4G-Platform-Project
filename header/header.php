<?php require "head.php"?>
<body class="bg-light" style="min-width:300px">

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"> <img src="/projetobd/icons/logo.jpg" alt="C4G Services" class="mb-1 mr-2">C4G Services</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="/projetobd/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/projetobd/servicos">Serviços</a>
        </li>
        <?php 
        
            include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";
            $u_id = $_SESSION['u_id'];
            $sql = "SELECT u_nome,u_tipo FROM utilizador WHERE u_id = '$u_id';";
            $result = sqlsrv_query($conn,$sql);
            if($result){
                if($row = sqlsrv_fetch_array($result)){
                    if($row['u_tipo'] == 3){
                        echo'<li class="nav-item">
                                <a class="nav-link" href="/projetobd/admin">Admin</a>
                            </li>';
                    }
                    echo '
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Conta
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/projetobd/profile">'.$row['u_nome'].'</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="/projetobd/login/action.php?logout">Logout</a>
                            </div>
                        </li>
                    ';
                    
                }
            }
            sqlsrv_close($conn);
        
        ?>
        </ul>
    </div>
</nav>

