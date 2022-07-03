$(document).ready(function(){
    // *****************  SERVIÇOS *******************
    $('#dados').click(function (e){
    e.preventDefault();
        $.ajax({
            type:'POST',
            url:'Pesquisa.php',
            data:
            { 
                datainicio: $('[name=datainicio]').val(),
                datafim: $('[name=datafim]').val(),
                dados: $('#dados').val() 
            },
            success: function(html)
            {
                document.getElementById("resultado-pesquisa").innerHTML = html;       
            }
        });
    });
    $('#equipamentos').click(function (e){
    e.preventDefault();
        $.ajax({
            type:'POST',
            url:'Pesquisa.php',
            data:
            { 
                datainicio: $('[name=datainicio]').val(),
                datafim: $('[name=datafim]').val(),
                equipamentos: $('#equipamentos').val()
            },
            success: function(html)
            {
                document.getElementById("resultado-pesquisa").innerHTML = html;       
            }
        });
    });
    $('#produtos').click(function (e){
    e.preventDefault();
        $.ajax({
            type:'POST',
            url:'Pesquisa.php',
            data:
            { 
                datainicio: $('[name=datainicio]').val(),
                datafim: $('[name=datafim]').val(),
                produtos: $('#produtos').val()
            },
            success: function(html)
            {
                document.getElementById("resultado-pesquisa").innerHTML = html;       
            }
        });
    });
    $('#formacao').click(function (e){
    e.preventDefault();
        $.ajax({
            type:'POST',
            url:'Pesquisa.php',
            data:
            { 
                datainicio: $('[name=datainicio]').val(),
                datafim: $('[name=datafim]').val(),
                formacao: $('#formacao').val() 
            },
            success: function(html)
            {
                document.getElementById("resultado-pesquisa").innerHTML = html;       
            }
        });
    });
     $('#servico').click(function (e){
        e.preventDefault();
            $.ajax({
                type:'POST',
                url:'Pesquisa.php',
                data:
                { 
                    servico_nome: $('[name=servico_nome]').val(),
                    servico: $('#servico').val() 
                },
                success: function(html)
                {
                    document.getElementById("resultado-pesquisa").innerHTML = html;       
                }
            });
        });

    //******************** ADMIN ***********************
    //edit pessoal form, fazer o mesmo para todos os outros
    $('#editpessoal form').submit(function (e){
        e.preventDefault();
        if ($('#editpessoal form').valid() === true){
           
        $.ajax({
            type:'POST',
            url:'pessoal/action.php',
            data:
            { 
                nome: $("#editpessoal [name=nome]").val(),
                u_email: $('#editpessoal [name=u_email]').val(),
                u_nome: $('#editpessoal [name=u_nome]').val(),
                u_membro: $('#editpessoal [name=u_membro]').val(),
                u_funcao: $('#editpessoal [name=u_funcao]').val(),
                u_lab: $('#editpessoal [name=u_lab]').val(),
                u_tipo: $('#editpessoal [name=u_tipo]').val(),
                u_password: $('#editpessoal [name=u_pass]').val(),
                editpessoal: $('#editpessoal [name=submit]').val()
            },
            success: function(html)
            {   
                document.getElementById("warnings").innerHTML = html; 
                var elements = $('#pess .table tbody #pess_row_'+ $('#editpessoal [name=submit]').val() +' td');
                elements[1].innerHTML = $('#editpessoal [name=nome]').val();
                elements[2].innerHTML = $('#editpessoal [name=u_nome]').val();
                elements[3].innerHTML = $('#editpessoal [name=u_email]').val();
                elements[4].innerHTML = $('#editpessoal [name=u_funcao]').val();
                elements[5].className = $('#editpessoal [name=u_membro]').val();
                elements[5].innerHTML = $('#editpessoal [name=u_membro] option:selected').html();
                elements[6].className = $('#editpessoal [name=u_tipo]').val();
                elements[6].innerHTML = $('#editpessoal [name=u_tipo] option:selected').html();
                elements[7].innerHTML = $('#editpessoal [name=u_lab]').val();
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
            }
        });
        $('#editpessoal').modal('hide');
        $('#editpessoal form').removeClass('was-validated');
        }
    });

    $('#editgroup form').submit(function (e){
        e.preventDefault();
        if ($('#editgroup form').valid() === true){
        $.ajax({
            type:'POST',
            url:'grupos/action.php',
            data:
            { 
                grp_nome: $("#editgroup [name=grp_nome]").val(),
                grp_acro: $('#editgroup [name=grp_acro]').val(),
                grp_desc: $('#editgroup [name=grp_desc]').val(),
                editgroup: $('#editgroup [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html; 
                var elements = $('#gt .table tbody #grp_row_'+ $('#editgroup [name=submit]').val() +' td');
                elements[0].innerHTML = $('#editgroup [name=grp_acro]').val();
                elements[1].innerHTML = $('#editgroup [name=grp_nome]').val();
                elements[2].innerHTML = $('#editgroup [name=grp_desc]').val();
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
            }
        });
        $('#editgroup').modal('hide');
        $('#editgroup form').removeClass('was-validated');
        }
    });

    $('#editunid form').submit(function (e){
        e.preventDefault();
        if ($('#editunid form').valid() === true){
        $.ajax({
            type:'POST',
            url:'unidades/action.php',
            data:
            { 
                unid_nome: $("#editunid [name=unid_nome]").val(),
                unid_acro: $('#editunid [name=unid_acro]').val(),
                unid_desc: $('#editunid [name=unid_desc]').val(),
                editunid: $('#editunid [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html; 
                var elements = $('#ui .table tbody #unid_row_'+ $('#editunid [name=submit]').val() +' td');
                elements[0].innerHTML = $('#editunid [name=unid_acro]').val();
                elements[1].innerHTML = $('#editunid [name=unid_nome]').val();
                elements[2].innerHTML = $('#editunid [name=unid_desc]').val();
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
            }
        });
        $('#editunid').modal('hide');
        $('#editunid form').removeClass('was-validated');
        }
    });

    $('#editdados form').submit(function (e){
    e.preventDefault();
    if ($('#editdados form').valid() === true){//nome do id do modal
        $.ajax({
            type:'POST',
            url:'dados/action.php',
            data:
            { 
                rec_designacao_pt: $("#editdados [name=rec_designacao_pt]").val(),
                rec_designacao_en: $('#editdados [name=rec_designacao_en]').val(),
                dados_web: $('#editdados [name=dados_web]').val(),
                rec_obs: $("#editdados [name=rec_obs]").val(),
                rec_custo: $('#editdados [name=rec_custo]').val(),
                editdados: $('#editdados [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html; 
                var elements = $('#dad .table tbody #dados_row_'+ $('#editdados [name=submit]').val() +' td');
                elements[0].innerHTML = $('#editdados [name=rec_designacao_pt]').val();
                elements[1].innerHTML = $('#editdados [name=dados_web]').val();
                elements[2].innerHTML = $('#editdados [name=rec_custo]').val();
                elements[3].innerHTML = $('#editdados [name=rec_designacao_en]').val();
                elements[4].innerHTML = $('#editdados [name=rec_obs]').val();
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
            }
        });
        $('#editdados').modal('hide');
        $('#editdados form').removeClass('was-validated');
        }
    });

    $('#editformacao form').submit(function (e){
        e.preventDefault();
        if ($('#editformacao form').valid() === true){//nome do id do modal
            $.ajax({
                type:'POST',
                url:'formacao/action.php',
                data:
                { 
                    rec_designacao_pt: $("#editformacao [name=rec_designacao_pt]").val(),
                    rec_designacao_en: $('#editformacao [name=rec_designacao_en]').val(),
                    form_tipo: $('#editformacao [name=form_tipo]').val(),
                    form_vagas: $('#editformacao [name=form_vagas]').val(),
                    rec_obs: $("#editformacao [name=rec_obs]").val(),
                    rec_custo: $('#editformacao [name=rec_custo]').val(),
                    editformacao: $('#editformacao [name=submit]').val()
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html; 
                    var elements = $('#form .table tbody #formacao_row_'+ $('#editformacao [name=submit]').val() +' td');
                    elements[0].innerHTML = $('#editformacao [name=rec_designacao_pt]').val();
                    elements[1].className = $('#editformacao [name=form_tipo]').val();
                    elements[1].innerHTML = $('#editformacao [name=form_tipo] option:selected').html();
                    elements[2].innerHTML = $('#editformacao [name=form_vagas]').val();
                    elements[3].innerHTML = $('#editformacao [name=rec_custo]').val();
                    elements[4].innerHTML = $('#editformacao [name=rec_designacao_en]').val();
                    elements[5].innerHTML = $('#editformacao [name=rec_obs]').val();
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                }
            });
            $('#editformacao').modal('hide');
            $('#editformacao form').removeClass('was-validated');
        }
    });

    $('#editprodutos form').submit(function (e){
        e.preventDefault();
        if ($('#editprodutos form').valid() === true){//nome do id do modal
            $.ajax({
                type:'POST',
                url:'produtos/action.php',
                data:
                { 
                    rec_designacao_pt: $("#editprodutos [name=rec_designacao_pt]").val(),
                    rec_designacao_en: $('#editprodutos [name=rec_designacao_en]').val(),
                    prod_nivel: $("#editprodutos [name=prod_nivel]").val(),
                    prod_web: $("#editprodutos [name=prod_web]").val(),
                    prod_tipo: $("#editprodutos [name=prod_tipo]").val(),
                    rec_obs: $("#editprodutos [name=rec_obs]").val(),
                    rec_custo: $('#editprodutos [name=rec_custo]').val(),
                    editprodutos: $('#editprodutos [name=submit]').val()
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html; 
                    var elements = $('#prod .table tbody #produtos_row_'+ $('#editprodutos [name=submit]').val() +' td');
                    elements[0].innerHTML = $('#editprodutos [name=rec_designacao_pt]').val();
                    elements[1].className = $('#editprodutos [name=prod_nivel]').val();
                    elements[1].innerHTML = $('#editprodutos [name=prod_nivel] option:selected').html();
                    elements[2].innerHTML = $('#editprodutos [name=prod_web]').val();
                    elements[3].className = $('#editprodutos [name=prod_tipo]').val();
                    elements[3].innerHTML = $('#editprodutos [name=prod_tipo] option:selected').html();
                    elements[4].innerHTML = $('#editprodutos [name=rec_custo]').val();
                    elements[5].innerHTML = $('#editprodutos [name=rec_designacao_en]').val();
                    elements[6].innerHTML = $('#editprodutos [name=rec_obs]').val();
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                }
            });
            $('#editprodutos').modal('hide');
            $('#editprodutos form').removeClass('was-validated');
            }
    });
    
    $('#editequipamentos form').submit(function (e){
        e.preventDefault();
        if ($('#editequipamentos form').valid() === true){//nome do id do modal
            $.ajax({
                type:'POST',
                url:'equipamentos/action.php',
                data:
                { 
                    rec_designacao_pt: $("#editequipamentos [name=rec_designacao_pt]").val(),
                    eq_n_serie: $('#editequipamentos [name=eq_n_serie]').val(),
                    eq_marca: $("#editequipamentos [name=eq_marca]").val(),
                    eq_modelo: $('#editequipamentos [name=eq_modelo]').val(),
                    eq_fornecedor: $('#editequipamentos [name=eq_fornecedor]').val(),
                    eq_loc_hab: $("#editequipamentos [name=eq_loc_hab]").val(),
                    rec_custo: $('#editequipamentos [name=rec_custo]').val(),
                    eq_manuseio_terceiros: $("#editequipamentos [name=eq_manuseio_terceiros]").val(),
                    eq_cond_uso: $("#editequipamentos [name=eq_cond_uso]").val(),
                    eq_mobilidade: $('#editequipamentos [name=eq_mobilidade]').val(),
                    eq_tipo_uso: $('#editequipamentos [name=eq_tipo_uso]').val(),
                    eq_aq_C4G: $("#editequipamentos [name=eq_aq_C4G]").val(),
                    rec_designacao_en: $('#editequipamentos [name=rec_designacao_en]').val(),
                    rec_obs: $("#editequipamentos [name=rec_obs]").val(),
                    eq_foto: $('#editequipamentos [name=eq_foto]').val(),
                    eq_data_aq: $('#editequipamentos [name=eq_data_aq]').val(),
                    eq_garantia: $("#editequipamentos [name=eq_garantia]").val(),
                    eq_nome: $('#editequipamentos [name=eq_nome]').val(),
                    eq_zelador: $("#editequipamentos [name=eq_zelador]").val(),
                    editequipamentos: $('#editequipamentos [name=submit]').val()
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html; 
                    var elements = $('#eq .table tbody #equipamentos_row_'+ $('#editequipamentos [name=submit]').val() +' td');
                    elements[0].innerHTML = $('#editequipamentos [name=rec_designacao_pt]').val();
                    elements[1].innerHTML = $('#editequipamentos [name=eq_n_serie]').val();
                    elements[2].innerHTML = $('#editequipamentos [name=eq_marca]').val();
                    elements[3].innerHTML = $('#editequipamentos [name=eq_modelo]').val();
                    elements[4].innerHTML = $('#editequipamentos [name=eq_fornecedor]').val();
                    elements[5].innerHTML = $('#editequipamentos [name=eq_loc_hab]').val();
                    elements[6].innerHTML = $('#editequipamentos [name=rec_custo]').val();
                    elements[7].className = $('#editequipamentos [name=eq_manuseio_terceiros]').val();
                    elements[7].innerHTML = $('#editequipamentos [name=eq_manuseio_terceiros] option:selected').html();
                    elements[8].className = $('#editequipamentos [name=eq_cond_uso]').val();
                    elements[8].innerHTML = $('#editequipamentos [name=eq_cond_uso] option:selected').html();
                    elements[9].className = $('#editequipamentos [name=eq_mobilidade]').val();
                    elements[9].innerHTML = $('#editequipamentos [name=eq_mobilidade] option:selected').html();
                    elements[10].className = $('#editequipamentos [name=eq_tipo_uso]').val();
                    elements[10].innerHTML = $('#editequipamentos [name=eq_tipo_uso] option:selected').html();
                    elements[11].className = $('#editequipamentos [name=eq_aq_C4G]').val();
                    elements[11].innerHTML = $('#editequipamentos [name=eq_aq_C4G] option:selected').html();
                    elements[12].innerHTML = $('#editequipamentos [name=rec_designacao_en]').val();
                    elements[13].innerHTML = $('#editequipamentos [name=rec_obs]').val();
                    elements[14].innerHTML = $('#editequipamentos [name=eq_foto]').val();
                    elements[15].innerHTML = $('#editequipamentos [name=eq_data_aq]').val();
                    elements[16].innerHTML = $('#editequipamentos [name=eq_garantia]').val();
                    elements[17].innerHTML = $('#editequipamentos [name=eq_nome]').val();
                    elements[18].innerHTML = $('#editequipamentos [name=eq_zelador]').val();

                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                }
            });
            $('#editequipamentos').modal('hide');
            $('#editequipamentos form').removeClass('was-validated');
            }
    });
    
    $('#editinstituicoes form').submit(function (e){
        e.preventDefault();
        if ($('#editinstituicoes form').valid() === true){
        $.ajax({
            type:'POST',
            url:'instituicoes/action.php',
            data:
            { 
                inst_nome: $("#editinstituicoes [name=inst_nome]").val(),
                inst_distrito: $('#editinstituicoes [name=inst_distrito]').val(),
                inst_acronimo: $('#editinstituicoes [name=inst_acronimo]').val(),
                inst_tipo: $('#editinstituicoes [name=inst_tipo]').val(),
                inst_parceira: $('#editinstituicoes [name=inst_parceira]').val(),
                editinstituicoes: $('#editinstituicoes [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html;
                var elements = $('#inst .table tbody #inst_row_'+ $('#editinstituicoes [name=submit]').val() +' td');
                elements[0].innerHTML = $('#editinstituicoes [name=inst_nome]').val();
                elements[1].innerHTML = $('#editinstituicoes [name=inst_distrito]').val();
                elements[2].innerHTML = $('#editinstituicoes [name=inst_acronimo]').val();
                elements[3].className = $('#editinstituicoes [name=inst_tipo]').val();
                elements[3].innerHTML = $('#editinstituicoes [name=inst_tipo] option:selected').html();
                elements[4].className = $('#editinstituicoes [name=inst_parceira]').val();
                elements[4].innerHTML = $('#editinstituicoes [name=inst_parceira] option:selected').html();
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
            }
        });
        $('#editinstituicoes').modal('hide');
        $('#editinstituicoes form').removeClass('was-validated');
        }
    });

    $('#editlaboratorios form').submit(function (e){
        e.preventDefault();
        if ($('#editlaboratorios form').valid() === true){
        $.ajax({
            type:'POST',
            url:'laboratorios/action.php',
            data:
            { 
                lab_acronimo: $("#editlaboratorios [name=lab_acronimo]").val(),
                lab_nome: $('#editlaboratorios [name=lab_nome]').val(),
                inst_id: $('#editlaboratorios [name=inst_id]').val(),
                editlaboratorios: $('#editlaboratorios [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html;
                var elements = $('#labs .table tbody #laboratorios_row_'+ $('#editlaboratorios [name=submit]').val() +' td');
                elements[0].innerHTML = $('#editlaboratorios [name=lab_acronimo]').val();
                elements[1].innerHTML = $('#editlaboratorios [name=lab_nome]').val();
                elements[2].innerHTML = $('#editlaboratorios [name=inst_id]').val();
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
            }
        });
        $('#editlaboratorios').modal('hide');
        $('#editlaboratorios form').removeClass('was-validated');
        }
    });

    $('#editservicos form').submit(function (e){
        e.preventDefault();
        if ($('#editservicos form').valid() === true){
        $.ajax({
            type:'POST',
            url:'servicos/action.php',
            data:
            { 
                servico_nome: $("#editservicos [name=servico_nome]").val(),
                servico_tipo: $('#editservicos [name=servico_tipo]').val(),
                servico_coord: $('#editservicos [name=servico_coord]').val(),
                editservicos: $('#editservicos [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html;
                var elements = $('#serv .table tbody #servicos_row_'+ $('#editservicos [name=submit]').val() +' td');
                elements[0].innerHTML = $('#editservicos [name=servico_nome]').val();
                elements[1].className = $('#editservicos [name=servico_tipo]').val();
                elements[1].innerHTML = $('#editservicos [name=servico_tipo] option:selected').html();
                elements[2].innerHTML = $('#editservicos [name=servico_coord]').val();
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
            }
        });
        $('#editservicos').modal('hide');
        $('#editservicos form').removeClass('was-validated');
        }
    });

    $('#addpessoal form').submit(function (e){//nome do id do modal
    e.preventDefault();
    if ($('#addpessoal form').valid() === true){//nome do id do modal
        $.ajax({
            type:'POST',
            url:'pessoal/action.php',
            data:
            { 
                nome: $("#addpessoal [name=nome]").val(),
                u_email: $('#addpessoal [name=u_email]').val(),//valores dos inputs e selects, como reparas é tudo igual
                u_nome: $('#addpessoal [name=u_nome]').val(),
                u_funcao: $('#addpessoal [name=u_funcao]').val(),
                u_membro: $('#addpessoal [name=u_membro]').val(),
                u_lab: $('#addpessoal [name=u_lab]').val(),
                u_tipo: $('#addpessoal [name=u_tipo]').val(),
                u_password: $('#addpessoal [name=u_pass]').val(),
                addpessoal: $('#addpessoal [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
                pesquisar('pess',"");
            }
        });
            $('#addpessoal').modal('hide');
            $('#addpessoal form').removeClass('was-validated');
        } 
    });

    $('#addgroup form').submit(function (e){//nome do id do modal
    e.preventDefault();
    if ($('#addgroup form').valid() === true){//nome do id do modal
        $.ajax({
            type:'POST',
            url:'grupos/action.php',
            data:
            { 
                grp_nome: $("#addgroup [name=grp_nome]").val(),
                grp_acro: $('#addgroup [name=grp_acro]').val(),
                grp_desc: $('#addgroup [name=grp_desc]').val(),
                addgroup: $('#addgroup [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
                pesquisar('grp',"");
            }
        });
            $('#addgroup').modal('hide');
            $('#addgroup form').removeClass('was-validated');
        } 
    });

    $('#addunid form').submit(function (e){
        e.preventDefault();
        if ($('#addunid form').valid() === true){
        $.ajax({
            type:'POST',
            url:'unidades/action.php',
            data:
            { 
                unid_nome: $("#addunid [name=unid_nome]").val(),
                unid_acro: $('#addunid [name=unid_acro]').val(),
                unid_desc: $('#addunid [name=unid_desc]').val(),
                addunid: true
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html; 
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
                pesquisar('unid',"");
            }
        });
        $('#addunid').modal('hide');
        $('#addunid form').removeClass('was-validated');
        }
    });

    $('#addinstituicoes form').submit(function (e){//nome do id do modal
    e.preventDefault();
    if ($('#addinstituicoes form').valid() === true){//nome do id do modal
        $.ajax({
            type:'POST',
            url:'instituicoes/action.php',
            data:
            { 
                inst_nome: $("#addinstituicoes [name=inst_nome]").val(),
                inst_distrito: $('#addinstituicoes [name=inst_distrito]').val(),
                inst_acronimo: $('#addinstituicoes [name=inst_acronimo]').val(),
                inst_tipo: $("#addinstituicoes [name=inst_tipo]").val(),
                inst_parceira: $('#addinstituicoes [name=inst_parceira]').val(),
                addinstituicoes: $('#addinstituicoes [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
                pesquisar('inst',"");
            }
        });
            $('#addinstituicoes').modal('hide');
            $('#addinstituicoes form').removeClass('was-validated');
        } 
    });

    $('#addlaboratorios form').submit(function (e){//nome do id do modal
        e.preventDefault();
        if ($('#addlaboratorios form').valid() === true){//nome do id do modal
            $.ajax({
                type:'POST',
                url:'laboratorios/action.php',
                data:
                { 
                    lab_acronimo: $("#addlaboratorios [name=lab_acronimo]").val(),
                    lab_nome: $('#addlaboratorios [name=lab_nome]').val(),
                    inst_id: $('#addlaboratorios [name=inst_id]').val(),
                    addlaboratorios: $('#addlaboratorios [name=submit]').val()
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('laboratorios',"");
                }
            });
                $('#addlaboratorios').modal('hide');
                $('#addlaboratorios form').removeClass('was-validated');
            } 
    });
    
    $('#addservicos form').submit(function (e){//nome do id do modal
        e.preventDefault();
        if ($('#addservicos form').valid() === true){//nome do id do modal
            $.ajax({
                type:'POST',
                url:'servicos/action.php',
                data:
                { 
                    servico_nome: $("#addservicos [name=servico_nome]").val(),
                    servico_tipo: $('#addservicos [name=servico_tipo]').val(),
                    servico_coord: $('#addservicos [name=servico_coord]').val(),
                    addservicos: $('#addservicos [name=submit]').val()
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('servicos',"");
                }
            });
                $('#addservicos').modal('hide');
                $('#addservicos form').removeClass('was-validated');
            } 
    });

    $('#adddados form').submit(function (e){//nome do id do modal
    e.preventDefault();
    if ($('#adddados form').valid() === true){//nome do id do modal
        $.ajax({
            type:'POST',
            url:'dados/action.php',
            data:
            { 
                rec_designacao_pt: $("#adddados [name=rec_designacao_pt]").val(),
                rec_designacao_en: $('#adddados [name=rec_designacao_en]').val(),
                dados_web: $('#adddados [name=dados_web]').val(),
                rec_obs: $("#adddados [name=rec_obs]").val(),
                rec_custo: $('#adddados [name=rec_custo]').val(),
                adddados: $('#adddados [name=submit]').val()
            },
            success: function(html)
            {
                document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
                pesquisar('dados',"");
            }
        });
            $('#adddados').modal('hide');
            $('#adddados form').removeClass('was-validated');
        } 
    });

    $('#addformacao form').submit(function (e){//nome do id do modal
        e.preventDefault();
        if ($('#addformacao form').valid() === true){//nome do id do modal
            $.ajax({
                type:'POST',
                url:'formacao/action.php',
                data:
                { 
                    rec_designacao_pt: $("#addformacao [name=rec_designacao_pt]").val(),
                    rec_designacao_en: $('#addformacao [name=rec_designacao_en]').val(),
                    form_tipo: $('#addformacao [name=form_tipo]').val(),
                    form_vagas: $('#addformacao [name=form_vagas]').val(),
                    rec_obs: $("#addformacao [name=rec_obs]").val(),
                    rec_custo: $('#addformacao [name=rec_custo]').val(),
                    addformacao: $('#addformacao [name=submit]').val()
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('formacao',"");
                }
            });
                $('#addformacao').modal('hide');
                $('#addformacao form').removeClass('was-validated');
        } 
    });

    $('#addprodutos form').submit(function (e){//nome do id do modal
        e.preventDefault();
        if ($('#addprodutos form').valid() === true){//nome do id do modal
            $.ajax({
                type:'POST',
                url:'produtos/action.php',
                data:
                { 
                    rec_designacao_pt: $("#addprodutos [name=rec_designacao_pt]").val(),
                    rec_designacao_en: $('#addprodutos [name=rec_designacao_en]').val(),
                    prod_nivel: $('#addprodutos [name=prod_nivel]').val(),
                    prod_web: $('#addprodutos [name=prod_web]').val(),
                    prod_tipo: $('#addprodutos [name=prod_tipo]').val(),
                    rec_obs: $("#addprodutos [name=rec_obs]").val(),
                    rec_custo: $('#addprodutos [name=rec_custo]').val(),
                    addprodutos: $('#addprodutos [name=submit]').val()
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('produtos',"");
                }
            });
                $('#addprodutos').modal('hide');
                $('#addprodutos form').removeClass('was-validated');
            } 
    });

    $('#addequipamentos form').submit(function (e){//nome do id do modal
        e.preventDefault();
        if ($('#addequipamentos form').valid() === true){//nome do id do modal
            $.ajax({
                type:'POST',
                url:'equipamentos/action.php',
                data:
                { 
                     rec_designacao_pt: $("#addequipamentos [name=rec_designacao_pt]").val(),
                    eq_n_serie: $('#addequipamentos [name=eq_n_serie]').val(),
                    eq_marca: $("#addequipamentos [name=eq_marca]").val(),
                    eq_modelo: $('#addequipamentos [name=eq_modelo]').val(),
                    eq_fornecedor: $('#addequipamentos [name=eq_fornecedor]').val(),
                    eq_loc_hab: $("#addequipamentos [name=eq_loc_hab]").val(),
                    rec_custo: $('#addequipamentos [name=rec_custo]').val(),
                    eq_manuseio_terceiros: $("#addequipamentos [name=eq_manuseio_terceiros]").val(),
                    eq_cond_uso: $("#addequipamentos [name=eq_cond_uso]").val(),
                    eq_mobilidade: $('#addequipamentos [name=eq_mobilidade]').val(),
                    eq_tipo_uso: $('#addequipamentos [name=eq_tipo_uso]').val(),
                    eq_aq_C4G: $("#addequipamentos [name=eq_aq_C4G]").val(),
                    rec_designacao_en: $('#addequipamentos [name=rec_designacao_en]').val(),
                    rec_obs: $("#addequipamentos [name=rec_obs]").val(),
                    eq_foto: $('#addequipamentos [name=eq_foto]').val(),
                    eq_data_aq: $('#addequipamentos [name=eq_data_aq]').val(),
                    eq_garantia: $("#addequipamentos [name=eq_garantia]").val(),
                    eq_nome: $('#addequipamentos [name=eq_nome]').val(),
                    eq_zelador: $("#addequipamentos [name=eq_zelador]").val(),
                    addequipamentos: $('#addequipamentos [name=submit]').val()
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('equipamentos',"");
                }
            });
                $('#addequipamentos').modal('hide');
                $('#addequipamentos form').removeClass('was-validated');
            } 
    });

    $('#search-people').submit(function(e){
        e.preventDefault();
        pesquisar('pess',$('#search-people [type=search]').val());
    });
    $('#search-grp').submit(function(e){
        e.preventDefault();
        pesquisar('grp',$('#search-grp [type=search]').val());
    });
    $('#search-inst').submit(function(e){
        e.preventDefault();
        pesquisar('inst',$('#search-inst [type=search]').val());
    });
    $('#search-laboratorios').submit(function(e){
        e.preventDefault();
        pesquisar('laboratorios',$('#search-laboratorios [type=search]').val());
    });
    $('#search-servicos').submit(function(e){
        e.preventDefault();
        pesquisar('servicos',$('#search-servicos [type=search]').val());
    });
    $('#search-unid').submit(function(e){
        e.preventDefault();
        pesquisar('unid',$('#search-unid [type=search]').val());
    });
    $('#search-dados').submit(function(e){
        e.preventDefault();
        pesquisar('dados',$('#search-dados [type=search]').val());
    });
    $('#search-formacao').submit(function(e){
        e.preventDefault();
        pesquisar('formacao',$('#search-formacao [type=search]').val());
    });
    $('#search-produtos').submit(function(e){
        e.preventDefault();
        pesquisar('produtos',$('#search-produtos [type=search]').val());
    });
    $('#search-equipamentos').submit(function(e){
        e.preventDefault();
        pesquisar('equipamentos',$('#search-equipamentos [type=search]').val());
    });
    $('#produtos').click(function (){
        $('#resultado-pesquisa').addClass("d-block");
        $('section form').addClass('d-none');
    });
    $('#dados').click(function (){
        $('#resultado-pesquisa').addClass("d-block");
        $('section form').addClass('d-none');
    });
    $('#formacao').click(function (){
        $('#resultado-pesquisa').addClass("d-block");
        $('section form').addClass('d-none');
    });
    $('#equipamentos').click(function (){
        $('#resultado-pesquisa').addClass("d-block");
        $('section form').addClass('d-none');
    });
     $('#servico').click(function (){
        $('#resultado-pesquisa').addClass("d-block");
        $('section form .album').addClass('d-none');
    });
});
function eliminar (tipo,id){
    switch(tipo){
        case 'servicos':
            $.ajax({
                type:'POST',
                url:'servicos/action.php',
                data:
                { 
                    eraseservicos: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('servicos',"");
                }
            }); 
        break;
        case 'laboratorios':
            $.ajax({
                type:'POST',
                url:'laboratorios/action.php',
                data:
                { 
                    eraselaboratorios: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('laboratorios',"");
                }
            }); 
        break;
        case 'pess':
            $.ajax({
                type:'POST',
                url:'pessoal/action.php',
                data:
                { 
                    erasepessoal: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('pess',"");
                }
            });     
        break;
        case 'grp':
            $.ajax({
                type:'POST',
                url:'grupos/action.php',
                data:
                { 
                    erasegroup: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('grp',"");
                }
            });     
        break;
        case 'unid':
            $.ajax({
                type:'POST',
                url:'unidades/action.php',
                data:
                { 
                    eraseunid: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('unid',"");
                }
            });     
        break;
        case 'dados':
            $.ajax({
                type:'POST',
                url:'dados/action.php',
                data:
                { 
                    erasedados: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('dados',"");
                }
            });     
        break;
        case 'formacao':
            $.ajax({
                type:'POST',
                url:'formacao/action.php',
                data:
                { 
                    eraseformacao: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('formacao',"");
                }
            });     
        break;
        case 'produtos':
            $.ajax({
                type:'POST',
                url:'produtos/action.php',
                data:
                { 
                    eraseprodutos: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('produtos',"");
                }
            });     
        break;
        case 'equipamentos':
            $.ajax({
                type:'POST',
                url:'equipamentos/action.php',
                data:
                { 
                    eraseequipamentos: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('equipamentos',"");
                }
            });     
        break;
        case 'inst':
            $.ajax({
                type:'POST',
                url:'instituicoes/action.php',
                data:
                { 
                    eraseinstituicoes: id
                },
                success: function(html)
                {
                    document.getElementById("warnings").innerHTML = html;       //faço display num div com id="warnings" para mostrar os avisos de erro e successo, para veres os avisos vai até à pagina pessoal/action.php
                    window.setTimeout(function (){
                        $(".alert").alert("close");
                    },1000);
                    pesquisar('inst',"");
                }
            });     
        break; 
    }
}
function editar(id){
    var ids = (id).split("_");
    switch (ids[0]){
        case "pess":
            var elements = $('#pess .table tbody #pess_row_'+ids[1]+' td');
            $("#editpessoal [name=nome]").val('' + elements[1].innerHTML + '');
            $("#editpessoal [name=u_nome]").val(''+ elements[2].innerHTML +'');
            $("#editpessoal [name=u_email]").val(''+ elements[3].innerHTML +'');
            $("#editpessoal [name=u_funcao]").val(''+ elements[4].innerHTML +'');
            $("#editpessoal [name=u_membro]").val(''+ elements[5].className +'');
            $("#editpessoal [name=u_tipo]").val(''+ elements[6].className +'');
            $("#editpessoal [name=submit]").val(''+ ids[1] +'');
            if(elements[7].innerHTML != ""){
                $("#editpessoal [name=u_lab]").val(''+ elements[7].innerHTML +'');
            }else{
                $("#editpessoal [name=u_lab]").val(0);
            }
        break;
        case "grp":
            var elements = $('#gt .table tbody #grp_row_'+ids[1]+' td');
            $("#editgroup [name=grp_acro]").val(''+elements[0].innerHTML+'');
            $("#editgroup [name=grp_nome]").val(''+elements[1].innerHTML+'');
            $("#editgroup [name=grp_desc]").val(''+elements[2].innerHTML+'');
            $("#editgroup [name=submit]").val(''+ids[1]+'');
            $("#editgroup .modal-title .id").html(''+ids[1]+'');
            loaddata('grp',ids[1]);
        break;
        case "unid":
            var elements = $('#ui .table tbody #unid_row_'+ids[1]+' td');
            $("#editunid [name=unid_acro]").val(''+elements[0].innerHTML+'');
            $("#editunid [name=unid_nome]").val(''+elements[1].innerHTML+'');
            $("#editunid [name=unid_desc]").val(''+elements[2].innerHTML+'');
            $("#editunid [name=submit]").val(''+ids[1]+'');
            $("#editunid .modal-title .id").html(''+ids[1]+'');
            loaddata('unid',ids[1]);
        break;
        case "dados":
            var elements = $('#dad .table tbody #dados_row_'+ids[1]+' td');
            $("#editdados [name=rec_designacao_pt]").val(''+elements[0].innerHTML+'');
            $("#editdados [name=dados_web]").val(''+elements[1].innerHTML+'');
            $("#editdados [name=rec_custo]").val(''+elements[2].innerHTML+'');
            $("#editdados [name=rec_designacao_en]").val(''+elements[3].innerHTML+'');
            $("#editdados [name=rec_obs]").val(''+elements[4].innerHTML+'');
            $("#editdados [name=submit]").val(''+ids[1]+'');
        break;
        case "formacao":
            var elements = $('#form .table tbody #formacao_row_'+ids[1]+' td');
            $("#editformacao [name=rec_designacao_pt]").val(''+elements[0].innerHTML+'');
            $("#editformacao [name=form_tipo]").val(''+elements[1].className+'');
            $("#editformacao [name=form_vagas]").val(''+elements[2].innerHTML+'');
            $("#editformacao [name=rec_custo]").val(''+elements[3].innerHTML+'');
            $("#editformacao [name=rec_designacao_en]").val(''+elements[4].innerHTML+'');
            $("#editformacao [name=rec_obs]").val(''+elements[5].innerHTML+'');
            $("#editformacao [name=submit]").val(''+ids[1]+'');
        break;
        case "produtos":
            var elements = $('#prod .table tbody #produtos_row_'+ids[1]+' td');
            $("#editprodutos [name=rec_designacao_pt]").val(''+elements[0].innerHTML+'');
            $("#editprodutos [name=prod_nivel]").val(''+elements[1].className+'');
            $("#editprodutos [name=prod_web]").val(''+elements[2].innerHTML+'');
            $("#editprodutos [name=prod_tipo]").val(''+elements[3].className+'');
            $("#editprodutos [name=rec_custo]").val(''+elements[4].innerHTML+'');
            $("#editprodutos [name=rec_designacao_en]").val(''+elements[5].innerHTML+'');
            $("#editprodutos [name=rec_obs]").val(''+elements[6].innerHTML+'');
            $("#editprodutos [name=submit]").val(''+ids[1]+'');
        break;
        case "equipamentos":
            var elements = $('#eq .table tbody #equipamentos_row_'+ids[1]+' td');
            $("#editequipamentos [name=rec_designacao_pt]").val(''+elements[0].innerHTML+'');
            $("#editequipamentos [name=eq_n_serie]").val(''+elements[1].innerHTML+'');
            $("#editequipamentos [name=eq_marca]").val(''+elements[2].innerHTML+'');
            $("#editequipamentos [name=eq_modelo]").val(''+elements[3].innerHTML+'');
            $("#editequipamentos [name=eq_fornecedor]").val(''+elements[4].innerHTML+'');
            $("#editequipamentos [name=eq_loc_hab]").val(''+elements[5].innerHTML+'');
            $("#editequipamentos [name=rec_custo]").val(''+elements[6].innerHTML+'');
            $("#editinstituicoes [name=eq_manuseio_terceiros]").val(''+elements[7].className+'');
            $("#editinstituicoes [name=eq_cond_uso]").val(''+elements[8].className+'');
            $("#editinstituicoes [name=eq_mobilidade]").val(''+elements[9].className+'');
            $("#editinstituicoes [name=eq_tipo_uso]").val(''+elements[10].className+'');
            $("#editinstituicoes [name=eq_aq_C4G]").val(''+elements[11].className+'');
            $("#editequipamentos [name=rec_designacao_en]").val(''+elements[12].innerHTML+'');
            $("#editequipamentos [name=rec_obs]").val(''+elements[13].innerHTML+'');
            $("#editequipamentos [name=eq_foto]").val(''+elements[14].innerHTML+'');
            $("#editequipamentos [name=eq_data_aq]").val(''+elements[15].innerHTML+'');
            $("#editequipamentos [name=eq_garantia]").val(''+elements[16].innerHTML+'');
            $("#editequipamentos [name=eq_nome]").val(''+elements[17].innerHTML+'');
            $("#editequipamentos [name=eq_zelador]").val(''+elements[18].innerHTML+'');
            $("#editequipamentos [name=submit]").val(''+ids[1]+'');
        break;
        case "inst":
            var elements = $('#inst .table tbody #inst_row_'+ids[1]+' td');
            $("#editinstituicoes [name=inst_nome]").val(''+elements[0].innerHTML+'');
            $("#editinstituicoes [name=inst_distrito]").val(''+elements[1].innerHTML+'');
            $("#editinstituicoes [name=inst_acronimo]").val(''+elements[2].innerHTML+'');
            $("#editinstituicoes [name=inst_tipo]").val(''+elements[3].className+'');
            $("#editinstituicoes [name=inst_parceira]").val(''+elements[4].className+'');
            $("#editinstituicoes [name=submit]").val(''+ids[1]+'');
        break;
        case "laboratorios":
            var elements = $('#labs .table tbody #laboratorios_row_'+ids[1]+' td');
            console.log(elements);
            $("#editlaboratorios [name=lab_acronimo]").val(''+elements[0].innerHTML+'');
            $("#editlaboratorios [name=lab_nome]").val(''+elements[1].innerHTML+'');
            $("#editlaboratorios [name=inst_id]").val(''+elements[2].innerHTML+'');
            $("#editlaboratorios [name=submit]").val(''+ids[1]+'');
        break;
        case "servicos":
            var elements = $('#serv .table tbody #servicos_row_'+ids[1]+' td');
            console.log(elements);
            $("#editservicos [name=servico_nome]").val(''+elements[0].innerHTML+'');
            $("#editservicos [name=servico_tipo]").val(''+elements[1].className+'');
            $("#editservicos [name=servico_coord]").val(''+elements[2].innerHTML+'');
            $("#editservicos [name=submit]").val(''+ids[1]+'');
        break;
    }
}
function pesquisar(tipo,text){
    switch(tipo){
        case 'pess':
            $.ajax({
                type:'POST',
                url:'pessoal/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#pess .table tbody').html(html);
                }
            }); 
        break;
        case 'grp':
            $.ajax({
                type:'POST',
                url:'grupos/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#gt .table.groups-table tbody').html(html);
                }
            }); 
        break;
        case 'inst':
            $.ajax({
                type:'POST',
                url:'instituicoes/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#inst .table tbody').html(html);
                }
            }); 
        break;
        case 'laboratorios':
            $.ajax({
                type:'POST',
                url:'laboratorios/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#labs .table tbody').html(html);
                }
            }); 
        break;
        case 'servicos':
            $.ajax({
                type:'POST',
                url:'servicos/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#serv .table tbody').html(html);
                }
            }); 
        break;
        case 'gt-pess':
            $.ajax({
                type:'POST',
                url:'grupos/tableedit1.php',
                data:
                { 
                    grp_id: $('#editgroup .modal-title .id').html(),
                    search: text
                },
                success: function(html)
                {
                    $('#gt #search-gtpess .table.table-bordered').html(html);
                }
            }); 
        break;
        case 'unid':
            $.ajax({
                type:'POST',
                url:'unidades/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#ui .table.unid-table tbody').html(html);
                }
            }); 
        break;
        case 'dados':
            $.ajax({
                type:'POST',
                url:'dados/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#dad .table tbody').html(html);
                }
            }); 
        break;
        case 'formacao':
            $.ajax({
                type:'POST',
                url:'formacao/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#form .table tbody').html(html);
                }
            }); 
        break;
        case 'produtos':
            $.ajax({
                type:'POST',
                url:'produtos/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#prod .table tbody').html(html);
                }
            }); 
        break;
        case 'equipamentos':
            $.ajax({
                type:'POST',
                url:'equipamentos/action.php',
                data:
                { 
                    search: text
                },
                success: function(html)
                {
                    $('#eq .table tbody').html(html);
                }
            }); 
        break;
        case 'Pesquisa_Dados':
            $.ajax({
                type:'POST',
                url:'Dados/action.php',
                data:
                { 
                    search: text,
                },
                success: function(html)
                {
                    $('#ADados .table tbody').html(html);
                }
            }); 
        break;
        case 'Pesquisa_Equipamento':
            $.ajax({
                type:'POST',
                url:'Equipamento/action.php',
                data:
                { 
                    search: text,
                },
                success: function(html)
                {
                    $('#AEquipamento .table tbody').html(html);
                }
            }); 
        break;
        case 'Pesquisa_Formacao':
            $.ajax({
                type:'POST',
                url:'Formacao/action.php',
                data:
                { 
                    search: text,
                },
                success: function(html)
                {
                    $('#AFormacao .table tbody').html(html);
                }
            }); 
        break;
        case 'Pesquisa_Produtos':
            $.ajax({
                type:'POST',
                url:'Produtos/action.php',
                data:
                { 
                    search: text,
                },
                success: function(html)
                {
                    $('#AProdutos .table tbody').html(html);
                }
            }); 
        break;
        case 'Pesquisa_Servicos':
            $.ajax({
                type:'POST',
                url:'servicos/action.php',
                data:
                { 
                    search: text,
                },
                success: function(html)
                {
                    $('#AServicos .table tbody').html(html);
                }
            }); 
        break;
    }
}
function adiciona(tipo,id,id_to_add){
    switch (tipo){
        case 'grp_pess':
            $.ajax({
                type:'POST',
                url:'grupos/tableedit2.php',
                data:
                { 
                    grp_id: id,
                    u_id: id_to_add,
                    addgroup: true,
                },
                success: function(html)
                {
                    $('#editgroup .table.table-added tbody').html(html);
                    pesquisar("gt-pess","");
                }
            });
        break;
        case 'unid_grp':
            $.ajax({
                type:'POST',
                url:'unidades/tablegroups.php',
                data:
                { 
                    unid_id: id,
                    addgroup: id_to_add,
                },
                success: function(html)
                {
                    $('#editunid .table.table-added tbody').html(html);
                }
            });
        break;
    }
    
    
}
function loaddata(type,id){
    switch(type){
        case 'grp':
            $.ajax({
                type:'POST',
                url:'grupos/tableedit2.php',
                data:
                { 
                    loaddata: id
                },
                success: function(html)
                {
                    $('#editgroup .table.table-added tbody').html(html);
                }
            });
        break;
        case 'unid':
            $.ajax({
                type:'POST',
                url:'unidades/tablegroups.php',
                data:
                { 
                    loaddata: id
                },
                success: function(html)
                {
                    $('#editunid .table.table-added tbody').html(html);
                }
            });
        break;
        case 'servico':
            $.ajax({
                type:'POST',
                url:'dataServico.php',
                data:
                { 
                    servico: id
                },
                success: function(html)
                {
                    $('#loadservico .modal-dialog .modal-content').html(html);
                }
            });
        break;
    }
    
}

function retira(tipo,id,id_a_retirar){
    switch (tipo){
        case 'grp_u':
            $.ajax({
                type:'POST',
                url:'grupos/tableedit2.php',
                data:
                { 
                    grp_id: id,
                    erasepessoa:id_a_retirar
                },
                success: function(html)
                {
                    $('#editgroup .table.table-added tbody').html(html);
                }
            });
        break;
        case 'unid_grp':
            $.ajax({
                type:'POST',
                url:'unidades/tablegroups.php',
                data:
                { 
                    unid_id: id,
                    erasegroup:id_a_retirar
                },
                success: function(html)
                {
                    $('#editunid .table.table-added tbody').html(html);
                }
            });
        break;
    }
}

function adicionarReq(servico){
    var data_inicio = $('#datepicker [name=req_inicio]').val();
    var data_fim = $('#datepicker [name=req_fim]').val();
    if(data_inicio != "" && data_fim != ""){
        $("#loadservico").modal('hide');
        $.ajax({
            type:'POST',
            url:'action.php',
            data:
            { 
                req_inicio: data_inicio,
                req_fim: data_fim,
                grp_id: $('#loadservico [name=grp_id]').val(),
                addreq: servico
            },
            success: function(html)
            {
                $('#warnings').html(html);
                window.setTimeout(function (){
                    $(".alert").alert("close");
                },1000);
            }
        });
    }else{
        $("#datepicker .invalid-feedback").css("display","block");
    }

}

function showDados(dados){
    $('#loadservico').modal('hide');
    var html = '<div  class="alert alert-secondary alert-dismissible fade show position-fixed w-75 text-center" style="left:50%;top:20px;transform:translateX(-50%);z-index:100;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="alert-heading">Eis aqui os seus dados</h4>';
    var i;
    for(i=0;i<dados.length;i++){
        html += '<a href="'+dados[i]+'" class="alert-link">'+dados[i]+'</a>';
    }
    html += '</div>';
    $("#warnings").html(html);
}
