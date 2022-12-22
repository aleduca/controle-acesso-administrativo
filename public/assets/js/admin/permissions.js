$(document).ready(function() {

    var btn_permission = $('.btn-permission');

    btn_permission.on('click', function(event) {
        event.preventDefault();

        var data = $(this).attr('data-action');

        $.ajax({
            url: '/adminPermissoes/update',
            data: 'data=' + data,
            type: 'post',
            success: function(response) {
                if (response == 'atualizado') {
                    swal('Alterado', 'Status alterado com sucesso', 'success');
                } else {
                    swal('Atenção', 'Ocorreu um erro ou você não tem permissão para fazer isso', 'info');
                }

            }
        });

    });

});