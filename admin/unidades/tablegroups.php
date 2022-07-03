<?php
    if(isset($_POST['loaddata'])){
        $unid_id = $_POST['loaddata'];
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
        $sql="SELECT g.grp_id, g.grp_acro, g.grp_nome FROM grupoTrabalho AS g INNER JOIN unidade_grupo AS ug ON ( g.grp_id = ug.grp_id  ) WHERE ug.unid_id = ?";
        $result = sqlsrv_query($conn,$sql,array($unid_id));
        if($result){
            if(sqlsrv_has_rows($result)){
                while($row=sqlsrv_fetch_array($result)){
                    echo '
                    <tr id="unid_grp_'.$row['grp_id'].'">
                    <td>'.$row['grp_acro'].'</td>
                    <td>'.$row['grp_nome'].'</td>
                    <td><button type="button" class="close text-danger font-weight-bold" onclick="retira(\'unid_grp\','.$unid_id.','.$row['grp_id'].')">&times;</button></td>
                    </tr>';
                }
            }else{
                echo '<tr><td colspan="4" class="text-center"> Este grupo de trabalho não tem pessoas. </td></tr>';
            }
            
        }
    }else if(isset($_POST['erasegroup'])){
        $grp_id = $_POST['erasegroup'];
        $unid_id = $_POST['unid_id'];
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
        $sql = "DELETE FROM unidade_grupo WHERE unid_id = ? AND grp_id=?";
        $result = sqlsrv_query($conn,$sql,array($unid_id,$grp_id));
        $sql="SELECT g.grp_id, g.grp_acro, g.grp_nome FROM grupoTrabalho AS g INNER JOIN unidade_grupo AS ug ON ( g.grp_id = ug.grp_id  ) WHERE ug.unid_id = ?";
        $result = sqlsrv_query($conn,$sql,array($unid_id));
        if($result){
            if(sqlsrv_has_rows($result)){
                while($row=sqlsrv_fetch_array($result)){
                    echo '
                    <tr id="unid_grp_'.$row['grp_id'].'">
                    <td>'.$row['grp_acro'].'</td>
                    <td>'.$row['grp_nome'].'</td>
                    <td><button type="button" class="close text-danger font-weight-bold" onclick="retira(\'unid_grp\','.$unid_id.','.$row['grp_id'].')">&times;</button></td>
                    </tr>';
                }
            }else{
                echo '<tr><td colspan="4" class="text-center"> Este grupo de trabalho não tem pessoas. </td></tr>';
            }
            
        }
    }else if(isset($_POST['addgroup'])){
        $grp_id = $_POST['addgroup'];
        $unid_id = $_POST['unid_id'];
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
        $sql = "INSERT INTO unidade_grupo (unid_id, grp_id) VALUES (?,?)";
        $result = sqlsrv_query($conn,$sql,array($unid_id,$grp_id));
        $sql="SELECT g.grp_id, g.grp_acro, g.grp_nome FROM grupoTrabalho AS g INNER JOIN unidade_grupo AS ug ON ( g.grp_id = ug.grp_id  ) WHERE ug.unid_id = ?";
        $result = sqlsrv_query($conn,$sql,array($unid_id));
        if($result){
            if(sqlsrv_has_rows($result)){
                while($row=sqlsrv_fetch_array($result)){
                    echo '
                    <tr id="unid_grp_'.$row['grp_id'].'">
                    <td>'.$row['grp_acro'].'</td>
                    <td>'.$row['grp_nome'].'</td>
                    <td><button type="button" class="close text-danger font-weight-bold" onclick="retira(\'unid_grp\','.$unid_id.','.$row['grp_id'].')">&times;</button></td>
                    </tr>';
                }
            }else{
                echo '<tr><td colspan="4" class="text-center"> Esta unidade de investigação não tem grupos de trabalho. </td></tr>';
            }
            
        }
    }else{
        echo '<tr><td colspan="4" class="text-center"> Aqui irão aparecer os grupos de trabalho pertencentes à unidade de investigação.</td></tr>';
    }
?>