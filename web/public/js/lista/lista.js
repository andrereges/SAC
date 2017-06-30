$(document).ready(function() {

    var email = $("#filtroPorEmail").val();
    var pedido = $("#filtroPorPedido").val();
    
    if(!email) {
        $("#filtroPorEmail").hide();
        $("#btn-email").hide();
        
    } else {
        $("#filtroPorEmail").show();
        $("#btn-email").show();
    }

    if(!pedido) {
        $("#filtroPorPedido").hide();
        $("#btn-pedido").hide();
    } else {
        $("#filtroPorPedido").show();
        $("#btn-pedido").show();
        
    }

    if(!email && !pedido) {
        
        $("#limpaFiltro").hide();
             
    } else {
        $("#limpaFiltro").show();
    }

    
    // Filtro por Número do Pedido
    $(document).on('click', '#iconFiltroPorPedido', function(event){

        var isfiltroPorPedidoVisivel = $("#filtroPorPedido").is( ":visible" );

        if(isfiltroPorPedidoVisivel) {
            $("#filtroPorPedido").hide('500');
            $("#btn-pedido").hide('500'); 

        } else {
            $("#filtroPorPedido").show('500');
            $("#btn-pedido").show('500');

            setTimeout( () => { $("#filtroPorPedido").focus()}, 500);
        }            
    });

    // Filtro por Email
    $(document).on('click', '#iconFiltroPorEmail', function(event){
        
        var isfiltroPorEmailVisivel = $("#filtroPorEmail").is( ":visible" );

        if(isfiltroPorEmailVisivel) {
            $("#filtroPorEmail").hide('500');
            $("#btn-email").hide('500');

        } else {
            $("#filtroPorEmail").show('500');
            $("#btn-email").show('500');

            setTimeout(() => { $("#filtroPorEmail").focus() }, 500);
        }                  
    });

    // Limpa Filtro
   $(document).on('click', '#limpaFiltro', function(event){

        $("#filtroPorEmail").val('');
        $("#filtroPorPedido").val('');

        $( "form" ).submit(function( event ) {});
                   
    });

});