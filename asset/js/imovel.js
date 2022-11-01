
/**
 * buscar lista de Locador e preencher select
 */
function getLocador()
{
    dados = [];
    dados[0]   = "cliente"
    dados[1]   = "cliente.ATIVO = 1 AND cliente.TIPO = 1"; // TIPO = 1 LOCADOR
    dados[2]   = null;
    dados[3]   = null;
    dados[4]   = null;
    dados[5]   = "cliente.ID , cliente.NOME";

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
                preenchaSelect('ID_CLIENTE',dados)
            }
            else
            {                         
                console.log('Sem dados de cliente "LOCADOR"');
            }
        },
        error:(e)=>
        {
            console.log(e.status, e.statusText);
        }   
    });
}

/**
 * Salvar formulario
 */
$('#btnSubmit').click(function()
{
    if($('input[name=ID_CLIENTE]').val()=='' || $('input[name=ENDERECO]').val()=='')
    {
        alert('Digite um valor válido.')
    }
    else
    {   
        dados = $('#form').serialize();
        dados = dados + "&CL=Imovel";
        
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
 * Preencher select do modal
 */
function preenchaSelect(idSelect,array)
{
    $.each(array, function( n , v )
    {
        document.getElementById(idSelect).innerHTML += '<option value='+v.ID+'>'+v.NOME+'</option>';
    });
}

/**
 * buscar lista de Locatario e preencher tabela
 */
function getTable()
{
    dados = [];
    dados[0]   = "imovel"
    dados[1]   = "imovel.ATIVO = 1"; 
    dados[2]   = "cliente b ON b.ID = imovel.ID_CLIENTE";
    dados[3]   = null;
    dados[4]   = null;
    dados[5]   = "imovel.ID , b.NOME , imovel.ENDERECO";

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
                $('#tbody').html('<tr><td colspan="5">Não encontrado registros para tabela.</td></tr>');
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
            line = '<tr><td>'+v.ID+'</td>'+'<td>'+v.NOME+'</td>'+'<td>'+v.ENDERECO+'</td>'+'<td>'+link_editar+'</td>';    
            line + '</tr>';  
        }
        else
        {
            line = line + '<tr><td>'+v.ID+'</td>'+'<td>'+v.NOME+'</td>'+'<td>'+v.ENDERECO+'</td>'+'<td>'+link_editar+'</td>';    
            line + '</tr>';  
        }  
        body = body == false ? line : body + line;
    });   
        
    $('#tbody').html(body);

}

/**
 * metodos necessarios no carregamento da pagina
 */
getLocador();
getTable();


