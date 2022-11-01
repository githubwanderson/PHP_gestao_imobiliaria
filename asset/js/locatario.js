

/**
 * Salvar formulario
 */
$('#btnSubmit').click(function()
{
    if($('input[name=NOME]').val()=='' || $('input[name=EMAIL]').val()=='' || $('input[name=TELEFONE]').val()=='')
    {
        alert('Digite um valor válido.')
    }
    else
    {   
        dados = $('#form').serialize();
        dados = dados + "&CL=Locatario";
        
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

