(function($) {

    //affichage des notes de frais en fonction du statut actif
    var activeLi = $('.list-all-note .list-container .list-statut li.active');
    var liClass = activeLi.attr('class');
    if (liClass) {
        var activeClass = liClass.substring(0, liClass.indexOf(' '));
    }

	$('.list-all-note .list-container .list-note .note').hide();
	$('.list-all-note .list-container .list-note .' + activeClass).show();

    // lorsque l'on clique sur un nouveau statut, on affiche les notes de frais correspondant
    $('.list-all-note .list-container .list-statut li').click(function() {
        console.log('click');
    	if ($(this).hasClass('active')) {
    		return;
    	}

        activeClass = $(this).attr('class');
    	
    	$('.list-all-note .list-container .list-statut li').removeClass('active');
    	$(this).addClass('active');

    	$('.list-all-note .list-container .list-note .note').hide();
		$('.list-all-note .list-container .list-note .' + activeClass).show();
    });

    //affiche les boutons de la note
    $('.list-all-note .list-container .list-note .btn-show-frais').click(function() {
        var data = $(this).attr('data-frais');
    	var list = $('.' + data);

    	if (list.is(':visible')) {
    		list.slideUp();
    		return;
    	}
    	list.slideDown();
    });
    
    //requete ajax pour supprimer l'utilisateur dans la partie admin
    $('.admin-user table tr td .btn-danger').click(function() {
        
        var classes = $(this).attr('class');       
        var firstIndex = classes.indexOf('-') + 1;
        var lastIndex = classes.indexOf(' ');
        var userId = classes.substring(firstIndex, lastIndex);
        
        if (confirm('Etes-vous sûr de vouloir supprimer cet utilisateur ?')) {
            var fullPath = 'http://' + window.location.host + '/enote/?request=1';
            $.ajax({
                url: fullPath,
                type: 'POST',
                data: {deleteUser: userId},
                dataType: 'json'
            }).done(function(data) {
                if (data.updated == true) {
                    $('.tr-user-' + userId).remove();
                }

            }).fail(function(jqXHR, textStatus) {
                console.error('Une erreur s\'est produite :', textStatus);
            });
        };
    });

    //requete ajax pour supprimer les notes de frais utilisateur et admin
    $('.list-all-note .list-container .btn-danger').click(function() {

        var classes = $(this).attr('class');       
        var firstIndex = classes.indexOf('-') + 1;
        var lastIndex = classes.indexOf(' ');
        var elemType = classes.substring(0, firstIndex - 1);
        var typeId = classes.substring(firstIndex, lastIndex);
        var namePost = 'delete' + elemType.charAt(0).toUpperCase() + elemType.slice(1);
        var noteParent = '.' + $(this).attr('data-note');
        
        if (confirm('Confirmez la suppression')) {
            var fullPath = 'http://' + window.location.host + '/enote/?request=1';
            var values = {};
            values[namePost] = typeId;
            $.ajax({
                url: fullPath,
                type: 'POST',
                data: values,
                dataType: 'json'
            }).done(function(data) {
                if (data.updated == true) {
                    if (elemType == 'frais') {
                        //calcul du montant et du total de frais de la note
                        var totalNote = $(noteParent + ' .total-note').text();
                        var totalFrais = $('.frais-' + typeId + ' .total-frais').text();
                        var noteParentFraisTotal = $(noteParent + ' .count-frais').text() - 1;
                        var categorieFrais = $('.frais-' + typeId +' .categorie-frais').text();
                        var montantTotal = totalNote - totalFrais;

                        if (categorieFrais == 'Avance') {
                            montantTotal = totalNote + totalFrais;
                        }

                        $(noteParent + ' .total-note').text(montantTotal);
                        $(noteParent + ' .count-frais').text(noteParentFraisTotal);                        
                    }

                    $('.list-all-note .list-container .list-note li.' + elemType + '-' + typeId).remove();
                }

            }).fail(function(jqXHR, textStatus) {
                console.error(jqXHR);
                console.error('Une erreur s\'est produite :', textStatus);
            });
        };
    });


    //popup pour afficher l'image des frais
    $(function() {
        $('.img-frais').click(function() {
            var src = $(this).attr('src');
            //console.log('popup', src);
            $('.bpopup-container').bPopup({
                content: 'image',
                contentContainer: '.img-container',
                loadUrl: src
            });
        });
    });

})(jQuery);
