<?php

    if(isset($_POST['servico'])){
        if(!(session_status() === PHP_SESSION_ACTIVE)){
            session_start(); 
        }
        $servico_id = $_POST['servico'];
        $flag = array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4=>0); // 0 - formação 1 - dados  2 - produtos  3 - equipamentos
        //$data = new DateTime();
        //echo date_format($data,'d-m-Y');
        echo '  <div class="modal-header">			
                    <h3 class="modal-title">Requerer Serviço</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>    
                    </button>
                </div>';
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
        $sql = "SELECT * FROM servico WHERE servico_id = ?";
        $result = sqlsrv_query($conn,$sql,array($servico_id));

        if(!$result){
            exit(0);   
        }
        if(!$servico = sqlsrv_fetch_array($result)){
            exit(0);
        }
        echo '<div class="modal-body text-center">
        <h5>'.$servico['servico_nome'].'</h5>
        <small>Coordenador: ';
        
        $sql_pess = "SELECT nome FROM utilizador WHERE u_id = ?";
        $res_pess = sqlsrv_query($conn,$sql_pess,array($servico['servico_coord']));
        if($res_pess) $pess = sqlsrv_fetch_array($res_pess);
        
        echo $pess[0].'</small>
        <br>
        <br>';
        $hide = '<div class="container">
            <h6>Dísponibilidade dos recursos (não garantimos total disponibilidade dos recursos nas datas assinaladas).</h6>
            <div class="form-group m-auto" style="max-width:400px">
                <div class="input-daterange input-group form-row" id="datepicker">
                    <input type="text" class="form-control" name="req_inicio" placeholder="Início" readonly/>
                    <span class="input-group-text">to</span>
                    <input type="text" class="form-control" name="req_fim" placeholder="Fim" readonly/>
                    <div class="invalid-feedback">
                        As datas estão em branco!
                    </div>
                </div>
            </div>
            
        </div>
        <br>
        <br>
        ';
        $html = "";
        $html .= '<p>Este serviço contém os seguintes recursos:</p>
        <table class="table table-bordered text-left">
            <thead>
                <tr class="text-center">
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Custo (&euro;)</th>
                </tr>
            </thead><tbody>';
        $total = 0;
            $sql1_1 = "SELECT r.rec_designacao_pt, r.rec_designacao_en, r.rec_custo, i.servico_id, i.rec_id, f.form_tipo, f.form_vagas
            FROM dbo.recurso r 
                INNER JOIN dbo.incui i ON ( r.rec_id = i.rec_id  )  
                INNER JOIN dbo.formacao f ON ( r.rec_id = f.rec_id  )  
            WHERE i.servico_id = ? ";
            $result1_1 = sqlsrv_query($conn,$sql1_1,array($servico_id));
            if($result1_1){
                if(sqlsrv_has_rows($result1_1)){$flag[0] = 1;
                    while($row = sqlsrv_fetch_array($result1_1)){
                        
                        $html .= '
                        <tr>
                            <td>'.$row['rec_designacao_pt'].'</td>
                            <td>Formação</td>
                            <td class="text-right">'.$row['rec_custo'].'</td>
                        </tr>';
                        $total += $row['rec_custo'];
                    }
                }
            }
            $sql1_2 = "SELECT r.rec_designacao_pt, r.rec_designacao_en, r.rec_custo, i.servico_id, i.rec_id, d.dados_web
            FROM dbo.recurso r 
                INNER JOIN dbo.incui i ON ( r.rec_id = i.rec_id  )  
                INNER JOIN dbo.dados d ON ( r.rec_id = d.rec_id  )  
            WHERE i.servico_id = ? ";
            $result1_2 = sqlsrv_query($conn,$sql1_2,array($servico_id));
            if($result1_2){
                if(sqlsrv_has_rows($result1_2)){$flag[1] = 1;
                    $dados = array();
                    while($rowdados = sqlsrv_fetch_array($result1_2)){
                        $dados[]  = $rowdados;
                        $html .= '
                        <tr>
                            <td>'.$rowdados['rec_designacao_pt'].'('.$rowdados['dados_web'].')</td>
                            <td>Dados</td>
                            <td class="text-right">'.$rowdados['rec_custo'].'</td>
                        </tr>';
                        $total += $rowdados['rec_custo'];
                    }
                }
            }
            $sql1_3 = "SELECT r.rec_designacao_pt, r.rec_designacao_en, r.rec_custo, p.prod_nivel, p.prod_web, p.prod_tipo, i.servico_id, i.rec_id
            FROM dbo.recurso r 
                INNER JOIN dbo.produtos p ON ( r.rec_id = p.rec_id  )  
                INNER JOIN dbo.incui i ON ( r.rec_id = i.rec_id  )  
             WHERE i.servico_id = ? ";
            $result1_3 = sqlsrv_query($conn,$sql1_3,array($servico_id));
            if($result1_3){
                if(sqlsrv_has_rows($result1_3)){
                    $flag[2]=1;
                    while($rowprod = sqlsrv_fetch_array($result1_3)){
                        $html .= '
                        <tr>
                            <td>'.$rowprod['rec_designacao_pt'].'</td>
                            <td>Produto</td>
                            <td class="text-right">'.$rowprod['rec_custo'].'</td>
                        </tr>';
                        $total += $rowprod['rec_custo'];
                    }
                }
            }

            $sql1_4 = "SELECT r.rec_designacao_pt, r.rec_designacao_en, r.rec_custo, i.servico_id, i.rec_id, e.eq_n_serie, e.eq_marca, e.eq_foto, e.eq_modelo, e.eq_nome, e.eq_zelador
            FROM dbo.recurso r 
                INNER JOIN dbo.incui i ON ( r.rec_id = i.rec_id  )  
                INNER JOIN dbo.equipamentos e ON ( r.rec_id = e.rec_id  )  
            WHERE i.servico_id = ? ";
            $result1_4 = sqlsrv_query($conn,$sql1_4,array($servico_id));
            if($result1_4){
                if(sqlsrv_has_rows($result1_4)){
                    $flag[3] = 1;
                    while($roweq = sqlsrv_fetch_array($result1_4)){
                        $html .= '
                        <tr>
                            <td>'.$roweq['rec_designacao_pt'].'</td>
                            <td>Equipamento</td>
                            <td class="text-right">'.$roweq['rec_custo'].'</td>
                        </tr>';
                        $total += $roweq['rec_custo'];
                    }
                }
            }
            $sql1_5 = "SELECT ru.rec_id, ru.u_id, r.rec_designacao_pt, r.rec_designacao_en, r.rec_custo, u.u_nome, u.u_funcao
            FROM dbo.rec_u ru 
                INNER JOIN dbo.recurso r ON ( ru.rec_id = r.rec_id  )  
                    INNER JOIN dbo.incui i ON ( r.rec_id = i.rec_id  )  
                INNER JOIN dbo.utilizador u ON ( ru.u_id = u.u_id  )  
            WHERE i.servico_id = ? ";
            $result1_5 = sqlsrv_query($conn,$sql1_5,array($servico_id));
            if($result1_5){
                if(sqlsrv_has_rows($result1_5)){
                    $flag[4] = 1;
                    while($rowpess = sqlsrv_fetch_array($result1_5)){
                        $html .= '
                        <tr>
                            <td>'.$rowpess['rec_designacao_pt'].'</td>
                            <td>Recursos Humanos</td>
                            <td class="text-right">'.$rowpess['rec_custo'].'</td>
                        </tr>';
                        $total += $rowpess['rec_custo'];
                    }
                }
            }
        
        $cliente_id = 1;
        if($flag[3] || $flag[0] || $flag[4]){
            echo $hide.$html;
            echo '<script>
                    var unavailableDateObjects = [';
                                    $sql = "SELECT i.servico_id, i.rec_id
                                    FROM dbo.incui i 
                                    WHERE i.servico_id = ?";
                                    $result = sqlsrv_query($conn,$sql,array($servico_id));
                                    if($result){
                                        while($row = sqlsrv_fetch_array($result)){
                                            $sql2_1 = "SELECT r.rec_id, r1.req_inicio, r1.req_fim
                                            FROM dbo.recurso r 
                                                INNER JOIN dbo.incui i ON ( r.rec_id = i.rec_id  )  
                                                    INNER JOIN dbo.servico s ON ( i.servico_id = s.servico_id  )  
                                                        INNER JOIN dbo.requerimento r1 ON ( s.servico_id = r1.req_servico  )  
                                                INNER JOIN dbo.formacao f ON ( r.rec_id = f.rec_id  )  
                                            WHERE r.rec_id = ?";
                                            $result2_1 = sqlsrv_query($conn,$sql2_1,array($row['rec_id']));
                                            
                                            if(sqlsrv_has_rows($result2_1)){
                                                $rows = sqlsrv_num_rows($result2_1);
                                                $j=0;
                                                while($row2_1 = sqlsrv_fetch_array($result2_1)){
                                                    if($j>0 && $j != $rows - 1)
                                                        echo ',';
                                                    $j++;
                                                    $begin = $row2_1[1] ;
                                                    $end   = $row2_1[2] ;
                                                    for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                        echo '\'';
                                                        echo $i->format("Y-m-d");
                                                        echo '\'';
                                                        if($i<$end)
                                                            echo ',';
                                                    }
                                                    
                                                }
                                            }
                                            
                                            $sql2_2 = "SELECT r.rec_id, r1.req_inicio, r1.req_fim, e.eq_n_serie
                                            FROM dbo.recurso r 
                                                INNER JOIN dbo.incui i ON ( r.rec_id = i.rec_id  )  
                                                    INNER JOIN dbo.servico s ON ( i.servico_id = s.servico_id  )  
                                                        INNER JOIN dbo.requerimento r1 ON ( s.servico_id = r1.req_servico  )  
                                                INNER JOIN dbo.equipamentos e ON ( r.rec_id = e.rec_id  )  
                                                    INNER JOIN dbo.req_eq re ON ( e.eq_n_serie = re.eq_n_serie  )  
                                            WHERE r.rec_id = ? AND r1.req_id = re.req_id";
                                            $result2_2 = sqlsrv_query($conn,$sql2_2,array($row['rec_id']));
                                            if(sqlsrv_has_rows($result2_2)){
                                                if($result2_1){
                                                    echo ',';
                                                }
                                                $rows = sqlsrv_num_rows($result2_2);
                                                $j = 0;
                                                while($row2_2 = sqlsrv_fetch_array($result2_2)){
                                                    if($j>0 && $j != $rows - 1)
                                                        echo ',';
                                                    $j++;
                                                    $begin = $row2_2[1];
                                                    $end   = $row2_2[2];
                                                    for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                        echo '\'';
                                                        echo $i->format("Y-m-d");
                                                        echo '\'';
                                                        if($i<$end)
                                                            echo ',';
                                                    }
                                                }
                                            }

                                            $sql2_3 = "SELECT r.rec_id, r1.req_inicio, r1.req_fim
                                            FROM dbo.recurso r 
                                                INNER JOIN dbo.incui i ON ( r.rec_id = i.rec_id  )  
                                                    INNER JOIN dbo.servico s ON ( i.servico_id = s.servico_id  )  
                                                        INNER JOIN dbo.requerimento r1 ON ( s.servico_id = r1.req_servico  )  
                                                INNER JOIN dbo.rec_u ru ON ( r.rec_id = ru.rec_id  )  
                                            WHERE r.rec_id = ?";
                                            $result2_3 = sqlsrv_query($conn,$sql2_3,array($row['rec_id']));
                                            if(sqlsrv_has_rows($result2_3)){
                                                if($result2_2){
                                                    echo ',';
                                                }
                                                $rows = sqlsrv_num_rows($result2_3);
                                                $j=0;
                                                while($row2_3 = sqlsrv_fetch_array($result2_3)){
                                                    if($j>0 && $j != $rows - 1)
                                                        echo ',';
                                                    $j++;
                                                    $begin = $row2_3[1];
                                                    $end   = $row2_3[2];
                                                    for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                        echo '\'';
                                                        echo $i->format("Y-m-d");
                                                        echo '\'';
                                                        if($i<$end)
                                                            echo ',';
                                                    }
                                                }
                                            }

                                        }
                                    }

                            
                            echo '];
                            $(function () {
                                $(\'#datepicker\').datepicker({
                                    language: "pt",
                                    format: \'yyyy-mm-dd\',
                                    datesDisabled: unavailableDateObjects,
                                    inline: true,
                                    onSelect: function() {
                                        //Do validation functionality here
                                        triggerOnStartSelect();
                                    }
                        });
                    });
                </script>';

        }else{
           echo $html;
        }
        
        echo '</tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="border-bottom: 1px solid Transparent!important;border-left: 1px solid Transparent!important;" class="text-right" ><h6>Total</h6></td>
                    <td class="text-right">'.$total.'</td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 1px solid Transparent!important;border-left: 1px solid Transparent!important;" class="text-right" ><h6>Desconto</h6></td>
                    <td class="text-right">'.($total*$cliente_id/100).'</td>
                </tr>
            </tfoot>
        </table>
        <div class="form-row text-center"><div class="col-8 m-auto">
            <label> Grupo de trabalho associado </label>
            <select name="grp_id" class="form-control">';
        $sql = "SELECT g.grp_nome, g.grp_acro, g.grp_id
        FROM dbo.utilizador u 
            INNER JOIN dbo.pertence_grupo pg ON ( u.u_id = pg.u_id  )  
                INNER JOIN dbo.grupoTrabalho g ON ( pg.grp_id = g.grp_id  )  
        WHERE u.u_id =?";
        $result = sqlsrv_query($conn,$sql,array($_SESSION['u_id']));
        if($result){
            while($row = sqlsrv_fetch_array($result)){
                echo '<option value="'.$row['grp_id'].'">('.$row['grp_acro'].') '.$row['grp_nome'].'</option>';
            }
        }
            echo '</select>
            </div></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" name="req_id"';
            
            if (!$flag[0] && $flag[1] && !$flag[2] && !$flag[3] && !$flag[4]){
                if(($total-($total*$cliente_id/100))>0){
                    echo 'onclick="showDados(Array(';
                    for($i=0;$i<count($dados)-1;$i++){
                        echo '\''.$dados[$i]['dados_web'].'\',';
                    }
                    echo '\''.$dados[count($dados)-1]['dados_web'].'\'))" value="'.$servico_id.'"> Pagar '.($total-($total*$cliente_id/100)).'&euro;';
                }else{
                    echo 'onclick="showDados(Array(';
                    for($i=0;$i<count($dados)-1;$i++){
                        echo '\''.$dados[$i]['dados_web'].'\',';
                    }
                    echo '\''.$dados[count($dados)-1]['dados_web'].'\'))" value="'.$servico_id.'"> Download';
                }
            }else{
                if(($total-($total*$cliente_id/100))>0){
                    echo ' onclick="adicionarReq(this.value)" value="'.$servico_id.'"> Pagar '.($total-($total*$cliente_id/100)).'&euro;';
                }else{
                    echo ' onclick="adicionarReq(this.value)" value="'.$servico_id.'"> Requisitar';
                }
            }
            echo '</button>
        </div>
        ';
        sqlsrv_close($conn);
    }else{
        header("Location: index.php");
    }
?>

    
    
    
        
            
        
    
    