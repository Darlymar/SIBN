$(function () {

    // Lista de categorias
    $.post('controller/categorias_controller.php').done(function (respuesta) {
        $('#categorias').html(respuesta);
    });

    // lista subcategorias
    $('#categorias').change(function () {
        var mostrar_subcategorias = $(this).val();

        // Lista de subcategorias
        $.post('controller/subcategorias_controller.php', { categorias: mostrar_subcategorias }).done(function (respuesta) {
            $('#subcategorias').html(respuesta);
        });
    });

     // Lista de Categorias Especificas
     $('#subcategorias').change(function () {
        var mostrar_categoriasespecificas = $(this).val();

        // Lista de categoriasespecificas
        $.post('controller/categoriasespecificas_controller.php', { subcategorias: mostrar_categoriasespecificas }).done(function (respuesta) {
            $('#categoriasespecificas').html(respuesta);
        });
    });

})