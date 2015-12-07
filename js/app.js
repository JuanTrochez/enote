(function($) {

	$('#accueil .list-container .list-note  li').hide();
	$('#accueil .list-container .list-note .statut-1').show();

    $('#accueil .list-container .list-statut li').click(function() {
    	var activeClass = $(this).attr('class');
    	$('#accueil .list-container .list-statut li').removeClass('active');
    	$(this).addClass('active');

    	$('#accueil .list-container .list-note  li').hide();
		$('#accueil .list-container .list-note .' + activeClass).show();
    });

})(jQuery);
