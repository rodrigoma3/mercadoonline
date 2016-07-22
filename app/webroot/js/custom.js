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
                },
                error: function(){
                    angular.element($('#myAngular')).scope().alerta('error','Não foi possível processar sua solicitação. Tente novamente.');
                }
            });
        }
        return false;
    });
    $('.add-to-cart').click(function(){
        var product = $(this).parent().find('#CartsProductProductId');
        var quantity = $(this).parent().find('#CartsProductQuantity');
        var product_id = product.val();
        var quantity_v = quantity.val();
        // console.log('Produto: ' + product_id);
        // console.log('Quantidade: ' + quantity_v);
        $.ajax({
            url: "/cartsProducts/add",
            type: 'GET',
            data: {"product_id": product_id, "quantity": quantity_v },
            success: function(data){
                if (data == '1') {
                    angular.element($('#myAngular')).scope().alerta('success','Item adicionado ao carrinho com sucesso');
                } else {
                    angular.element($('#myAngular')).scope().alerta('error','Não foi possível adicionar item ao carrinho. Tente novamente.');
                }
            },
            error: function(){
                angular.element($('#myAngular')).scope().alerta('error','Não foi possível adicionar item ao carrinho. Entre com sua conta e tente novamente.');
            }
        });
        return false;
    });
    $('.cart_quantity_delete').click(function(){
        var linha = $(this).parent().parent();
        var id = linha.find('#CartsProductId').val();
        // console.log('ID: ' + id);
        $.ajax({
            url: "/cartsProducts/delete",
            type: 'GET',
            data: {"id": id},
            success: function(data){
                if (data == 1) {
                    angular.element($('#myAngular')).scope().alerta('success','Item excluído do carrinho com sucesso');
                    linha.remove();
                } else {
                    angular.element($('#myAngular')).scope().alerta('error','Não foi possível excluir item do carrinho. Tente novamente.');
                }
            },
            error: function(){
                angular.element($('#myAngular')).scope().alerta('error','Não foi possível excluir item do carrinho. Tente novamente.');
            }
        });
        return false;
    });
    $('.cart_quantity_up').click(function(){
        var elQuantity = $(this).parent().find('#CartsProductQuantity');
        var value = parseInt(elQuantity.val());
        var max = parseInt(elQuantity.attr('max'));
        // console.log('Max: '+max);
        if (value < max) {
            value = value + 1;
        }
        elQuantity.val(value);
        var price = $(this).parent().parent().parent().find('.cart_price p').html();
        var p = price.split(' ');
        price = parseFloat(p[1]);
        $(this).parent().parent().parent().find('.cart_total_price').html(p[0]+' '+(price*value).toFixed(2));
        priceCalculate();
        return false;
    });
    $('.cart_quantity_down').click(function(){
        var elQuantity = $(this).parent().find('#CartsProductQuantity');
        var value = parseInt(elQuantity.val());
        var min = parseInt(elQuantity.attr('min'));
        // console.log('Min: '+min);
        if (value > min) {
            value = value - 1;
        }
        elQuantity.val(value);
        var price = $(this).parent().parent().parent().find('.cart_price p').html();
        var p = price.split(' ');
        price = parseFloat(p[1]);
        $(this).parent().parent().parent().find('.cart_total_price').html(p[0]+' '+(price*value).toFixed(2));
        priceCalculate();
        return false;
    });
    $('.update').click(function(){
        event.preventDefault();
        var form = jQuery('<form>', {
            'action': '/cartsProducts/edit',
            'method': 'POST'
        });
        $('.cart_quantity_button input').each(function(){
            form.append($(this));
        });
        form.submit();
    });
    function priceCalculate(){
        var total = 0;
        $('.cart_total_price').each(function(){
            var s = $(this).html().split(' ');
            total = total + parseFloat(s[1]);
        });
        $('.total_cart').html('R$ ' + total.toFixed(2));
    }
    priceCalculate();
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
