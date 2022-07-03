<?php
    if(isset($_POST['loaddata'])){
        $grp_id = $_POST['loaddata'];
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
        $sql="SELECT u.u_id, u.u_funcao, u.nome FROM utilizador AS u INNER JOIN pertence_grupo AS pg ON ( u.u_id = pg.u_id  ) WHERE pg.grp_id = ?";
        $result = sqlsrv_query($conn,$sql,array($grp_id));
        if($result){
            if(sqlsrv_has_rows($result)){
                while($row=sqlsrv_fetch_array($result)){
                    echo '
                    <tr id="grp_u_'.$row['u_id'].'">
                    <td>'.$row['u_id'].'</td>
                    <td>'.$row['nome'].'</td>
                    <td>'.$row['u_funcao'].'</td>
                    <td><button type="button" class="close text-danger font-weight-bold" onclick="retira(\'grp_u\','.$grp_id.','.$row['u_id'].')">&times;</button></td>
                    </tr>';
                }
            }else{
                echo '<tr><td colspan="4" class="text-center"> Este grupo de trabalho não tem pessoas. </td></tr>';
            }
            
        }
    }else if(isset($_POST['addgroup'])){
        $grp_id = $_POST['grp_id'];
        $u_id = $_POST['u_id'];
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
        $sql = "INSERT INTO pertence_grupo (u_id,grp_id) VALUES (?,?)";
        $result = sqlsrv_query($conn,$sql,array($u_id,$grp_id));
        $sql="SELECT u.u_id, u.u_funcao, u.nome FROM utilizador AS u INNER JOIN pertence_grupo AS pg ON ( u.u_id = pg.u_id  ) WHERE pg.grp_id = ?";
        $result = sqlsrv_query($conn,$sql,array($grp_id));
        if($result){
            if(sqlsrv_has_rows($result)){
                while($row=sqlsrv_fetch_array($result)){
                    echo '
                    <tr id="grp_u_'.$row['u_id'].'">
                    <td>'.$row['u_id'].'</td>
                    <td>'.$row['nome'].'</td>
                    <td>'.$row['u_funcao'].'</td>
                    <td><button type="button" class="close text-danger font-weight-bold" onclick="retira(\'grp_u\','.$grp_id.','.$row['u_id'].')">&times;</button></td>
                    </tr>';
                }
            }else{
                echo '<tr><td colspan="4" class="text-center"> Este grupo de trabalho não tem pessoas. </td></tr>';
            }
        }
    }else if(isset($_POST['erasepessoa'])){
        $u_id = $_POST['erasepessoa'];
        $grp_id = $_POST['grp_id'];
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
        $sql = "DELETE FROM pertence_grupo WHERE u_id = ? AND grp_id =?";
        $result = sqlsrv_query($conn,$sql,array($u_id,$grp_id));
        $sql="SELECT u.u_id, u.u_funcao, u.nome FROM utilizador AS u INNER JOIN pertence_grupo AS pg ON ( u.u_id = pg.u_id  ) WHERE pg.grp_id = ?";
        $result = sqlsrv_query($conn,$sql,array($grp_id));
        if($result){
            if(sqlsrv_has_rows($result)){
                while($row=sqlsrv_fetch_array($result)){
                    echo '
                    <tr id="grp_u_'.$row['u_id'].'">
                    <td>'.$row['u_id'].'</td>
                    <td>'.$row['nome'].'</td>
                    <td>'.$row['u_funcao'].'</td>
                    <td><button type="button" class="close text-danger font-weight-bold" onclick="retira(\'grp_u\','.$grp_id.','.$row['u_id'].')">&times;</button></td>
                    </tr>';
                }
            }else{
                echo '<tr><td colspan="4" class="text-center"> Este grupo de trabalho não tem pessoas. </td></tr>';
            }
        }
    }else{
        echo '<tr><td colspan="4" class="text-center"> Aqui irão aparecer as pessoas pertencentes aos grupos de trabalho. </td></tr>';
    }
    
?>