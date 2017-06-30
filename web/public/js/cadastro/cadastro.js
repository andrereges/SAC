$(document).ready(function() {

    // Verifica se o número do pedido e  existe na url específica ex.: http://localhost:8000/pedido/2
    $( "#img_pedido" ).hide();

    $( "input[name='pedido']" ).change(function() {
        
        $( "#img_pedido" ).show('500');

        var pedido = $( "input[name='pedido']" ).val();

        setTimeout(function() {
  
        
            $.get( getRootPath() + "/pedido/" + pedido, function(res) {
                $("#img_pedido").attr('src','/public/images/cadastro/positivo.jpg');
                $( "#id_pedido" ).val(res['id']);
            })
            .done(function() {
                
            })
            .fail(function() {
                $("#img_pedido").attr('src','/public/images/cadastro/negativo.jpg');
                $('#msg_pedido').html('Pedido não encontrado!');
                $( "#id_pedido" ).val('');
            })
            .always(function() {

            });

        }, 1000);
        
    });

    // Verifica se email existe na url específica ex.: http://localhost:8000/cliente/email@teste.com.br
    $( "#img_email" ).hide();

    $( "input[name='email']" ).change(function() {
        
        $( "#img_email" ).show('500');

        var email = $( "input[name='email']" ).val();

        setTimeout(function() {
  
        
            $.get( getRootPath() + "/cliente/" + email, function(res) {
                $("#img_email").attr('src','/public/images/cadastro/positivo.jpg');
                $( "#id_cliente" ).val(res['id']);
                $( "input[name='nome']" ).val(res['nome']);              
            })
            .done(function() {
                
            })
            .fail(function(res) {
                $("#img_email").attr('src','/public/images/cadastro/negativo.jpg');
                $('#msg_email').html('Cliente ainda não cadastrado! Ele será cadastrado automaticamente');
                $( "input[name='nome']" ).val('');
                $( "#id_cliente" ).val('');
            })
            .always(function() {
                
            });

        }, 1000);
        
    });

});

