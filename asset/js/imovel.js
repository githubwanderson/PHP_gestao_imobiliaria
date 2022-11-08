/**
 * buscar lista de Locador e preenche select
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
 * Salvar formulario novo cadastro
 */
function submitNewForm()
{
    if(!validaForm())
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
                limparFormulario();
                getTable();
                alert('Registro ID:'+dados+' salvo com sucesso.');
            },
            error:(e)=>
            {
                console.log('Error: ' + e.status, e.statusText);
            }        
        });
    }
};

/**
 * Limpar formulario
 */
function limparFormulario()
{
    $('#form input').each(function() {
        $(this).val(''); 
    });

    $('.modal').modal('hide');
}

/**
 * Responsavel por validar o form
 * @return bollean
 */
function validaForm(){
 
    switch (true) {

        case $('input[name=ID_CLIENTE]').val()=='':
            return false;
            break;

        case $('input[name=ENDERECO]').val()=='':
            return false;
            break;

        default:
            return true
            break;
    }
}

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
                $('#tbody').html('<tr><td colspan="4">Não encontrado registros para tabela.</td></tr>');
            }
        },
        error:(e)=>
        {
            console.log(e.status, e.statusText);
        }   
    });
}

/**
 * Preencher a tabela com dados de imoveis + locador
 * @param {*} dados 
 */
function preenchaTabela(dados)
{
    $('#tbody').html('');

    line = 0
    body = false;
    $.each(dados, function(i,v)
    {           
        link_editar = "<a id="+v.ID+" data-toggle='modal' data-target='#modal' onclick=editar("+v.ID+")><i class='fa fa-edit' aria-hidden='true'></i></a>";

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
 * Novo imovel
 * altera titulo do form 
 * altera id para ação do btn submit
 */
 $('#btnNovo').click(function(){
    $('#modalLabel').html("NOVO IMÓVEL");
    limparFormulario();
    $('#modalFooter').html('');
    btnModal = '<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>';
    btnModal += '<button type="button" class="btn btn-success" onclick=submitNewForm()>Salvar</button>';
    $('#modalFooter').html(btnModal);
})

/**
 * Editar imovel
 * altera titulo do form
 * altera id para ação do btn submit
 * carrega dados do id
 * @param integer id
 */
function editar( id ){

    $('#modalLabel').html("EDITAR IMÓVEL - ID: " + id);
    limparFormulario();
    $('#modalFooter').html('');    
    btnModal = '<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>';
    btnModal += '<button type="button" class="btn btn-success" onclick=submitEditForm()>Salvar</button>';
    $('#modalFooter').html(btnModal);

    getDados( id ) 
}

/**
 * Pegar os dados do cliente e preencher form
 * @param id integer
 */
function getDados( id ){

    dados = [];
    dados[0]   = "imovel"
    dados[1]   = "imovel.ID = " + id; 
    dados[2]   = null;
    dados[3]   = null;
    dados[4]   = null;
    dados[5]   = "imovel.ID , imovel.ID_CLIENTE , imovel.ENDERECO";

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
                    $("[name=ID]").val(dados[0].ID);
                    $("[name=ID_CLIENTE]").val(dados[0].ID_CLIENTE);
                    $("[name=ENDERECO]").val(dados[0].ENDERECO);
                }
                else
                {                         
                    $('#modalLabel').html("Editar Locatário - ID: " + id + " **Não encontrado**");
                }
            },
            error:(e)=>
            {
                console.log(e.status, e.statusText);
            }   
        });
} 

/**
 * Responsavel por salvar dados do formulario em editar
 * @param {integer} id 
 */
function submitEditForm(){

    if(!validaForm())
    {
        alert('Digite um valor válido.');
    }
    else
    {   
        dados = $('#form').serialize();
        dados = dados + "&CL=entities/Imovel";

        $.ajax(
        {
            url:'ajax/update.php',
            type:'post',
            dataType:'json',
            data: dados,
            success:(dados)=>
            {
                limparFormulario();
                getTable();
            },
            error:(e)=>
            {
                console.log('Error: ' + e.status, e.statusText);
            }        
        });
    }  
}

/**
 * metodos necessarios no carregamento da pagina
 */
getLocador();
getTable();


