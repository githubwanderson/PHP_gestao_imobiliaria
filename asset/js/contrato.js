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
    dados[0]   = "AdmTaxa";
    dados[1]   = "services"; 
    dados[2]   = "getValor"; 

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
                });

                getTable();

                $('.modal').modal('hide');

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

/**
 * buscar lista de Locatario e preencher tabela
 */
function getTable()
{
    dados = [];
    dados[0]   = "contrato"
    dados[1]   = "contrato.ATIVO = 1"; 
    dados[2]   = "cliente b ON b.ID = contrato.ID_CLIENTE JOIN imovel c ON c.ID = contrato.ID_IMOVEL";
    dados[3]   = null;
    dados[4]   = null;
    dados[5]   = "contrato.ID , b.NOME , c.ENDERECO ,  DATE_FORMAT( contrato.DT_INICIO, '%d/%m/%Y' ) DT_INICIO , DATE_FORMAT( contrato.DT_FIM, '%d/%m/%Y' ) DT_FIM";

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
                $('#tbody').html('<tr><td colspan="8">Não encontrado registros para tabela.</td></tr>');
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
        link_editar         = "<a id="+v.ID+" class='btn btn_edit'><i class='fa fa-edit' aria-hidden='true'></i></a>";
        link_repasse        = "<a id="+v.ID+" class='btn btn_edit'><i class='fa fa-edit' aria-hidden='true'></i></a>";
        link_mensalidade    = "<a id="+v.ID+" class='btn btn_edit' onclick='mensalidade("+v.ID+")'><i class='fa fa-edit' aria-hidden='true'></i></a>";

        if(line=0)
        {
            line = '<tr><td>'+v.ID+'</td>'+'<td>'+v.NOME+'</td>'+'<td>'+v.ENDERECO+'</td>'+'<td>'+v.DT_INICIO+'</td>'+'<td>'+v.DT_FIM+'</td>'+'<td>'+link_mensalidade+'</td>'+'<td>'+link_repasse+'</td>'+'<td>'+link_editar+'</td>';    
            line + '</tr>';  
        }
        else
        {
            line = line + '<tr><td>'+v.ID+'</td>'+'<td>'+v.NOME+'</td>'+'<td>'+v.ENDERECO+'</td>'+'<td>'+v.DT_INICIO+'</td>'+'<td>'+v.DT_FIM+'</td>'+'<td>'+link_mensalidade+'</td>'+'<td>'+link_repasse+'</td>'+'<td>'+link_editar+'</td>';    
            line + '</tr>';  
        }  
        body = body == false ? line : body + line;
    });   
        
    $('#tbody').html(body);
}

getLocatario()
getImovel()
getTaxaAdm()
getTable()

function mensalidade( p ){
    console.log(p);
}