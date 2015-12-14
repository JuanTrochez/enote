(function($) {

    var activeLi = $('.list-all-note .list-container .list-statut li.active');
    var liClass = activeLi.attr('class');
    if (liClass) {
        var activeClass = liClass.substring(0, liClass.indexOf(' '));
    }

	$('.list-all-note .list-container .list-note li').hide();
	$('.list-all-note .list-container .list-note .' + activeClass).show();
	$('.list-all-note .list-container .list-note .list-frais li').show();

    $('.list-all-note .list-container .list-statut li').click(function() {
    	if ($(this).hasClass('active')) {
    		return;
    	}

        activeClass = $(this).attr('class');


    	
    	$('.list-all-note .list-container .list-statut li').removeClass('active');
    	$(this).addClass('active');

    	$('.list-all-note .list-container .list-note  li').hide();
		$('.list-all-note .list-container .list-note .list-frais li').show();
		$('.list-all-note .list-container .list-note .' + activeClass).show();
    });

    //affiche les boutons de la note
    $('.list-all-note .list-container .list-note li .btn-show-frais').click(function() {
    	var sibling = $(this).next('.list-frais');

    	if (sibling.is(':visible')) {
    		sibling.slideUp();
    		return;
    	}
    	sibling.slideDown();
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

        var parentNote = $(this).parent('.note');
        console.log(parentNote);
        //$('.list-all-note .list-container .note-');
        
        var classes = $(this).attr('class');       
        var firstIndex = classes.indexOf('-') + 1;
        var lastIndex = classes.indexOf(' ');
        var elemType = classes.substring(0, firstIndex - 1);
        var typeId = classes.substring(firstIndex, lastIndex);
        var namePost = 'delete' + elemType.charAt(0).toUpperCase() + elemType.slice(1);
        
        if (confirm('Confirmez la suppression')) {
            var fullPath = 'http://' + window.location.host + '/enote/?request=1';
            console.log(namePost);
            var values = {};
            values[namePost] = typeId;
            $.ajax({
                url: fullPath,
                type: 'POST',
                data: values,
                dataType: 'json'
            }).done(function(data) {
                console.log(data);
                if (data.updated == true) {
                    if (elemType == 'frais') {
                    }
                    $('.list-all-note .list-container .list-note li.' + elemType + '-' + typeId).remove();
                }

            }).fail(function(jqXHR, textStatus) {
                console.error(jqXHR);
                console.error('Une erreur s\'est produite :', textStatus);
            });
        };
    });

})(jQuery);
