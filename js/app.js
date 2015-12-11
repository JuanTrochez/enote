(function($) {

	$('#accueil .list-container .list-note li').hide();
	$('#accueil .list-container .list-note .statut-1').show();
	$('#accueil .list-container .list-note .list-frais li').show();

    $('#accueil .list-container .list-statut li').click(function() {
    	if ($(this).hasClass('active')) {
    		return;
    	}
    	var activeClass = $(this).attr('class');
    	
    	$('#accueil .list-container .list-statut li').removeClass('active');
    	$(this).addClass('active');

    	$('#accueil .list-container .list-note  li').hide();
		$('#accueil .list-container .list-note .list-frais li').show();
		$('#accueil .list-container .list-note .' + activeClass).show();
    });

    $('#accueil .list-container .list-note li .btn-show-frais').click(function() {
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
        
        if (confirm('confirmer')) {
            var fullPath = 'http://' + window.location.host + '/enote/?request=1';
            $.ajax({
                url: fullPath,
                type: 'POST',
                data: {deleteUser: userId},
                dataType: 'json'
            }).done(function(data) {
                console.log(data);
                if (data.updated == true) {
                    $('.tr-user-' + userId).remove();
                }

            }).fail(function(jqXHR, textStatus) {
                console.error('Une erreur s\'est produite :', textStatus);
            });
        };
    });

})(jQuery);
