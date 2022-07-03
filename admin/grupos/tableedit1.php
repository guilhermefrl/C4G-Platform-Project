<?php

if(isset($_POST['search'])){
    $text = $_POST['search'];
    if($text == ""){
        exit(1);
    }
    $grp_id = $_POST['grp_id'];
    include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
    $sql = "SELECT TOP 5 u.u_id,u.nome,u.u_funcao FROM utilizador AS u WHERE ((u.u_id LIKE '%$text%' OR u.nome LIKE '%$text%' OR u.u_funcao LIKE'%$text%') AND NOT EXISTS ( SELECT pg.u_id FROM pertence_grupo AS pg WHERE u.u_id = pg.u_id  AND pg.grp_id = ? )) ORDER BY u.u_id ASC";
    $result = sqlsrv_query($conn,$sql,array($grp_id));
    if($result){
        while($row=sqlsrv_fetch_array($result)){
            echo '<tr>
                    <td>'.$row['u_id'].'</td>
                    <td class="col-1">'.$row['nome'].'</td>
                    <td class="text-center "><button class="btn btn-sm p-0" onclick="adiciona(\'grp_pess\',$(\'#editgroup .modal-title .id\').html(),this.value)" value="'.$row['u_id'].'">
                        <svg class="bi bi-plus bg-success text-light mb-1" style="border-radius: 50%" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5H4a.5.5 0 0 1 0-1h3.5V4a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.5 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0V8z"/>
                        </svg></button>
                    </td>
                </tr>';
        }
    }
    
}else{
    header("Location: ../");
}