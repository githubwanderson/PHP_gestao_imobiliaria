
/**
 * buscar lista de Locador e preencher select
 */
function getLocador()
{
    dados = [];
    dados[0]   = "cliente"
    dados[1]   = "cliente.ATIVO = 1 AND cliente.TIPO = 1"; // TIPO = 2 LOCADOR
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
 * metodos necessarios no carregamento da pagina
 */
getLocador();

