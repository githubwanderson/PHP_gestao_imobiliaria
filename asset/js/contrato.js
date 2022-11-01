
/**
 * buscar lista de Locador
 */
function getLocatario()
{
    dados = [];
    dados[0]   = "cliente"
    dados[1]   = "cliente.ATIVO = 1 AND cliente.TIPO = 2"; // TIPO = 2 LOCATARIO
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
                console.log('Sem dados de cliente "LOCATARIO"');
            }
        },
        error:(e)=>
        {
            console.log(e.status, e.statusText);
        }   
    });
}

/**
 * buscar lista de imoveis join proprietarios
 */
function getImovel()
{
    dados = [];
    dados[0]   = "imovel"
    dados[1]   = "imovel.ATIVO = 1"; 
    dados[2]   = "cliente b ON b.ID = imovel.ID_CLIENTE";
    dados[3]   = null;
    dados[4]   = null;
    dados[5]   = "imovel.ID , CONCAT( b.NOME , ' | ' , imovel.ENDERECO ) NOME";

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
                preenchaSelect('ID_IMOVEL',dados)
            }
            else
            {                         
                console.log('Sem dados de IMOVEL');
            }
        },
        error:(e)=>
        {
            console.log(e.status, e.statusText);
        }   
    });
}

/**
 * buscar lista de imoveis join proprietarios
 */
function getTaxaAdm()
{
    dados = [];
    dados[0]   = "AdmTaxa"
    dados[1]   = "getValorTaxaAdm"; 

    // Verificar se ha registro no banco
    $.ajax(
    {
        url:'ajax/class.php',
        type:'post',
        dataType:'json',
        data:{dados},
        success:(dados)=>
        {
            if(dados.length > 0)
            {
                $('#VALOR_TX_ADM').val(dados)
            }
            else
            {                         
                console.log('Sem dados da taxa da ADM');
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
    if(!validaForm())
    {
        alert('Digite um valor válido.')
    }
    else
    {   
        dados = $('#form').serialize();
        dados = dados + "&CL=Contrato";
        
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
 * Validar form
 * @return bollean
 */
function validaForm(){

    switch (true) {

        case $('input[name=ID_CLIENTE]').val()=='':
            return false;
            break;

        case $('input[name=ID_IMOVEL]').val()=='':
            return false;
            break;

        case $('input[name=DURACAO_MES]').val()=='':
            return false;
            break;

        case $('input[name=DT_INICIO]').val()=='':
            return false;
            break;
        
        case $('input[name=VALOR_ALUGUEL]').val()=='':
            return false;
            break;

        case $('input[name=VALOR_CONDOMINIO]').val()=='':
            return false;
            break;
        
        case $('input[name=VALOR_IPTU]').val()=='':
            return false;
            break;

        case $('input[name=VALOR_TX_ADM]').val()=='':
            return false;
            break;
    
        default:
            return true
            break;
    }


}

getLocatario()
getImovel()
getTaxaAdm()