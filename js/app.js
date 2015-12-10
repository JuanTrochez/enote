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
    
    $('.admin-user table tr td .btn-danger').click(function() {
        
        
        var classes = $(this).attr('class');       
        var firstIndex = classes.indexOf('-') + 1;
        var lastIndex = classes.indexOf(' ');
        var userId = classes.substring(firstIndex, lastIndex);
        
        if (confirm('confirmer')) {
            var fullPath = window.location.href + '&delete=' + userId;
            $.ajax(fullPath);
        };
    });

})(jQuery);
