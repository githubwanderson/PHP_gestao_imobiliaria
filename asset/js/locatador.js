

/**
 * Salvar formulario
 */
$('#btnSubmit').click(function()
{
    if($('input[name=NOME]').val()=='' || $('input[name=EMAIL]').val()=='' || $('input[name=TELEFONE]').val()=='' || $('input[name=DIA_REPASSE]').val()=='')
    {
        alert('Digite um valor válido.')
    }
    else
    {   
        dados = $('#form').serialize();
        dados = dados + "&CL=Locador";
        
        $.ajax(
        {
            url:'ajax/salvar.php',
            type:'post',
            dataType:'json',
            data: dados,
            success:(dados)=>
            {
                $('#form input').each(function() {
                    $(this).val(''); 
                });

                $('.modal').modal('hide');

                getTable();

                alert('Registro ID:'+dados+' salvo com sucesso.');
            },
            error:(e)=>
            {
                console.log('Error: ' + e.status, e.statusText);
            }
        });
    }
});    

/**
 * buscar lista de Locatario e preencher tabela
 */
function getTable()
{
    dados = [];
    dados[0]   = "cliente"
    dados[1]   = "cliente.ATIVO = 1 AND cliente.TIPO = 1"; // TIPO = 1 LOCADOR
    dados[2]   = null;
    dados[3]   = null;
    dados[4]   = null;
    dados[5]   = "cliente.ID , cliente.NOME , cliente.EMAIL , cliente.TELEFONE , cliente.DIA_REPASSE";

    // Verificar se ha registro no banco
    $.ajax(
    {
        url:'ajax/tabela.php',
        type:'post',
        dataType:'json',
        data:{dados},
        success:(dados)=>
        {
            if(dados.length > 0)
            {
                preenchaTabela(dados)
            }
            else
            {                         
                $('#tbody').html('<tr><td colspan="6">Não encontrado registros para tabela.</td></tr>');
            }
        },
        error:(e)=>
        {
            console.log(e.status, e.statusText);
        }   
    });
}

function preenchaTabela(dados)
{
    $('#tbody').html('');

    line = 0
    body = false;
    $.each(dados, function(i,v)
    {           
        link_editar         = "<a id="+v.ID+" class='btn_edit'><i class='fa fa-edit' aria-hidden='true'></i></a>";

        if(line=0)
        {
            line = '<tr><td>'+v.ID+'</td>'+'<td>'+v.NOME+'</td>'+'<td>'+v.EMAIL+'</td>'+'<td>'+v.TELEFONE+'</td>'+'<td>'+v.DIA_REPASSE+'</td>'+'<td>'+link_editar+'</td>';     
            line + '</tr>';  
        }
        else
        {
            line = line + '<tr><td>'+v.ID+'</td>'+'<td>'+v.NOME+'</td>'+'<td>'+v.EMAIL+'</td>'+'<td>'+v.TELEFONE+'</td>'+'<td>'+v.DIA_REPASSE+'</td>'+'<td>'+link_editar+'</td>';    
            line + '</tr>';  
        }  
        body = body == false ? line : body + line;
    });   
        
    $('#tbody').html(body);

}

getTable();