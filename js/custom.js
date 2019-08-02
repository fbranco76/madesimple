
$(function () {
    $('.datatable').DataTable({
        "language": {
            "lengthMenu": "Exibir _MENU_ por p&aacute;gina",
            "zeroRecords": "N&atilde;o foram encontrados resultados",
            "info": "Exibindo p&aacute;gina _PAGE_ de _PAGES_",
            "infoEmpty": "Sem resultados para busca",
            "infoFiltered": "(Filtrado de um total de _MAX_ registros)",
            "search": "Buscar",
            "previous": "Anterior",
            "Next": "Próxima",
            "First": "Primeira",
            "Last": "Última",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "Último"
            }

        },
        "aaSorting": [[1, "asc"]]
    });
    $('.datatablefl').DataTable({
        "language": {
            "lengthMenu": "Exibir _MENU_ por página",
            "zeroRecords": "N&atilde;o foram encontrados resultados",
            "info": "Exibindo p&aacute;gina _PAGE_ de _PAGES_",
            "infoEmpty": "Sem resultados para busca",
            "infoFiltered": "(Filtrado de um total de _MAX_ registros)",
            "search": "Buscar",
            "previous": "Anterior",
            "Next": "Pr&oacute;xima",
            "First": "Primeira",
            "Last": "&Uacute;ltima",
        },
        "scrollY": "600px",
        "scrollCollapse": true,
        "paging": false,
        "sDom": '<"top">rft<"bottom"><"clear">'
    });
    $('.datatableclean').DataTable({
        "language": {
            "lengthMenu": "Exibir _MENU_ por página",
            "zeroRecords": "N&atilde;o foram encontrados resultados",
            "info": "Exibindo p&aacute;gina _PAGE_ de _PAGES_",
            "infoEmpty": "Sem resultados para busca",
            "infoFiltered": "(Filtrado de um total de _MAX_ registros)",
            "search": "Buscar",
            "previous": "Anterior",
            "Next": "Pr&oacute;xima",
            "First": "Primeira",
            "Last": "&Uacute;ltima",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "&Uacute;ltimo"
            }

        },
        "sDom": '<"top">rt<"bottom"><"clear">',
        "paging": false
    });
    $('.datatablefilter').DataTable({
        "language": {
            "lengthMenu": "Exibir _MENU_ por página",
            "zeroRecords": "N&atilde;o foram encontrados resultados",
            "info": "Exibindo p&aacute;gina _PAGE_ de _PAGES_",
            "infoEmpty": "Sem resultados para busca",
            "infoFiltered": "(Filtrado de um total de _MAX_ registros)",
            "search": "Buscar",
            "previous": "Anterior",
            "Next": "Pr&oacute;xima",
            "First": "Primeira",
            "Last": "&Uacute;ltima",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Seguinte",
                "sLast": "&Uacute;ltimo"
            }

        },
        "sDom": '<"top">rftp<"bottom"><"clear">'

    });
    var filterList = {
        init: function () {

            // MixItUp plugin
            // http://mixitup.io
            $('#portfoliolist').mixitup({
                targetSelector: '.portfolio',
                filterSelector: '.filter',
                effects: ['fade'],
                easing: 'snap',
                // call the hover effect
                onMixEnd: filterList.hoverEffect()
            });
        },
        hoverEffect: function () {

            // Simple parallax effect
            $('#portfoliolist .portfolio').hover(
                    function () {
                        $(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
                        $(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');
                    },
                    function () {
                        $(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
                        $(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');
                    }
            );
        }

    };
    // Run the show!
    filterList.init();
    $(document).on('click', '.close', function (e) {
        $(".alert").slideUp();
    });
    $(".datepickerProx").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        minDate: "+0d"
    });
    $(".datepickerAnt").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        maxDate: "+0d"
    });
    $(".datepicker").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        daysOfWeekDisabled: '0,6'
    });
    $(".calendarioP").datepicker({
        dateFormat: 'yy-mm-dd',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        onSelect: function (selectedDate) {
            goto(selectedDate);
        }

    });
    
    
});

$(document).ready(function() {
 
 $(".fancy").fancybox(); 
 
});



