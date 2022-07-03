<table class="table">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Tipo de Serviço</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

    <?php
        
        include $_SERVER['DOCUMENT_ROOT']."/projetobd/includes/conn/conn.php";//especificar o caminho absoluto
        $sql = "SELECT * FROM servico";
        $result = sqlsrv_query($conn,$sql);
        if($result){
            while($row = sqlsrv_fetch_array($result)){
                echo '<tr id="servicos_row_'.$row["servico_id"].'">
                        <td>'.$row['servico_nome'].'</td>
                        <td class="'.$row["servico_tipo"].'">';
                            switch ($row["servico_tipo"]) {
                                case 'E':
                                    echo 'Equipamentos';
                                break;
                                case 'D':
                                    echo 'Dados';
                                break;
                                case 'F':
                                    echo 'Formação';
                                break;
                                case 'P':
                                    echo 'Produtos';
                                break;
                                case 'S':
                                    echo 'Serviços';
                                break;
                            }
                        echo '</td>
                        <td class="d-none">'.$row['servico_coord'].'</td>';

                        echo '<td>
                            <div class="text-center buttons-min-width" >
                                <button type="button" class="btn btn-info" onclick="editar(this.id)" data-toggle="modal" data-target="#editservicos" id="servicos_'.$row['servico_id'].'_edit">
                                <div class="show-mobile">
                                    <svg class="bi bi-pencil-square mb-1" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </div>
                                <div class="show-pc">Editar</div>
                                </button>
                                <button type="button" class="btn btn-danger" id="servicos_'.$row['servico_id'].'_erase" onclick=\'$("#eraseservicos .btn-danger").val('.$row['servico_id'].');\' data-toggle="modal" data-target="#eraseservicos">
                                <div class="show-mobile">
                                    <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </div>
                                <div class="show-pc">Eliminar</div>
                                </button>
                            </div>
                        </td>';
                    echo '</tr>';
            }

        }
        sqlsrv_close($conn);
        
        ?>
    </tbody>
</table>
