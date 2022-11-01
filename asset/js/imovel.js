
/**
 * buscar lista de Locador
 */
function getLocador()
{
    dados = [];
    dados[0]   = "cliente"
    dados[1]   = "cliente_tipo b ON b.ID = cliente.TIPO";
    dados[2]   = "cliente.TIPO = 1";

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
                console.log(dados);
            }
            else
            {                         
                console.log('sem dados');
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
            url:'ajax/tabela.php',
            type:'post',
            dataType:'json',
            data: dados,
            success:(dados)=>
            {
                $('#form input').each(function() {
                    $(this).val(''); 
                })
                $('.modal').modal('hide')
                alert('Registro ID:'+dados+' salvo com sucesso.')
            },
            error:(e)=>
            {
                console.log('Error: ' + e.status, e.statusText);
            }        
        });
    }
}); 

getLocador()

