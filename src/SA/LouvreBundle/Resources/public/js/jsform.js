$(document.ready(function(){

var index = $container.find(':input').length;
    var $NbTickets = $("#SA_louvrebundle_orders_NbTickets");
    // ********* SUR CHANGEMENT Nbre de Places
    $nbTickets.on('change', function(e){
        e.preventDefault();
        var placeMax = $("#NbTickets").text();
        var indice = $("#SA_louvrebundle_orders_NbTickets").val()-1;
        $container.empty();
        index = 0
        for (i = 0; i <= indice; i++ ) {
           addTicket($container);
        }
    }

});	

function addTicket($container) {
        // Dans le contenu de l'attribut « data-prototype », on remplace
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Visiteur n°' + (index+1))
            .replace(/__name__/g,        index)
        ;
        // On crée un objet jquery qui contient ce template
        var $prototype = $(template);
        // Augmente l'index de 1 pour l'élément suivant
        $container.data('index', index + 1);
        // On ajoute le prototype modifié à la fin de la balise <div>
        $container.append($prototype);
        // Ajustement des champs du formulaire afin qu'ils tiennent tous sur une ligne (BootStrap)
        $('#louvre_bookingbundle_reservation_details_' + index).children().removeClass('form-group').addClass('col-md-2');
        $('#louvre_bookingbundle_reservation_details_' + index).find('div:nth-child(4)').removeClass('col-md-2').addClass('col-md-3');
        $('#louvre_bookingbundle_reservation_details_' + index).find('div:last').removeClass('col-md-2').addClass('col-md-1');
        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        index++;
    }