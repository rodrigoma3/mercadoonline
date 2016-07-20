$('table.datatable').DataTable({
    "language": {
        "emptyTable":     "Não há dados disponíveis na tabela",
        "info":           "Mostrando _START_ para _END_ de _TOTAL_ ",
        "infoEmpty":      "Mostrando 0-0 de 0 entradas",
        "infoFiltered":   "(filtrada de _MAX_ entradas totais)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "search":         "Pesquisar: ",
        "zeroRecords":    "Nenhum registro correspondente encontrado",
        "paginate": {
            "first":      "Primeiro",
            "last":       "Último",
            "next":       "Póximo",
            "previous":   "Anterior"
        },
    },
});

$(function(){
    $('.signup-form input[type=submit]').click(function(){
        var cpf = $('#UserCpf').val();
        var email = $('#UserEmail').val();
        // console.log('CPF: ' + cpf);
        // console.log('Email: ' + email);
        // console.log('Error-Message: ' + $('#UserCpf').parent().children('div.error-message').html());
        if (cpf == null || cpf == '') {
            if (!$('#UserCpf').parent().children('div.error-message').length) {
                $('#UserCpf').parent().append('<div class="error-message">Por favor, informe seu CPF</div>');
            }
        } else {
            if ($('#UserCpf').parent().children('div.error-message').length) {
                $('#UserCpf').parent().children('div.error-message').remove();
            }
        }
        if (email == null || email == '') {
            if (!$('#UserEmail').parent().children('div.error-message').length) {
                $('#UserEmail').parent().append('<div class="error-message">Por favor, informe seu e-mail</div>');
            }
        } else {
            if ($('#UserEmail').parent().children('div.error-message').length) {
                $('#UserEmail').parent().children('div.error-message').remove();
            }
        }
        if (cpf != null && cpf != '' && email != null && email != '') {
            $.ajax({
                url: "/users/add",
                type: 'GET',
                data: {"cpf": cpf, "email": email },
                success: function(data){
                    if (data > 0) {
                        $('.signup-form div.submit').append('<div class="error-message">Usuário já cadastrado</div>');
                    } else {
                        $('.signup-form form').submit();
                    }
                }
            });
        }
        return false;
    });
    $('.add-to-cart').click(function(){
        var product = $(this).parent().find('#CartsProductProductId');
        var cart = $(this).parent().find('#CartsProductCartId');
        var quantity = $(this).parent().find('#CartsProductQuantity');
        var product_id = product.val();
        var cart_id = cart.val();
        var quantity_v = quantity.val();
        // console.log('Produto: ' + product_id);
        // console.log('Carrinho: ' + cart_id);
        // console.log('Quantidade: ' + quantity_v);
        $.ajax({
            url: "/cartsproducts/add",
            type: 'GET',
            data: {"product_id": product_id, "quantity": quantity_v, "cart_id": cart_id },
            success: function(data){
                if (!data) {
                    angular.element($('#myAngular')).scope().alerta('error','Não foi possível adicionar item ao carrinho. Tente novamente.');
                } else {
                    angular.element($('#myAngular')).scope().alerta('success','Item adicionado ao carrinho com sucesso');
                }
            }
        });
        return false;
    });
});

angular.module('myApp', ['angular-growl', 'ngAnimate']);

angular.module('myApp').config(['growlProvider', function (growlProvider) {
  //Configuração do tempo que a mensagem ficará na tela
  growlProvider.globalTimeToLive(5000);
}]);

angular.module('myApp').controller("myCtrl", function($scope, growl){
 $scope.alerta = function(type,message){
    var config = {};
    switch (type) {
        case 'success':
            growl.success(message, config);
            break;
        case 'info':
            growl.info(message, config);
            break;
        case 'warning':
            growl.warning(message, config);
            break;
        case 'error':
            growl.error(message, config);
            break;
        default:

    }
 }
});
