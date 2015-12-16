(function($) {

    //statistiques de l'administrateur (chartjs)

    var fullPath = 'http://' + window.location.host + '/enote/?request=1';
    var categoChart = $("#categorieChart").get(0).getContext("2d");
    var fraisMoisChart = $("#fraisChart").get(0).getContext("2d");

    //requete pour les donnees des categories
    $.ajax({
        url: fullPath,
        type: 'GET',
        data: {statistique: 'categorie'},
        contentType: "application/json; charset=utf-8",
        dataType: 'json'
    }).done(function(response) {
        console.log('response', response);
        
        var data = {
            labels: response.categorie.labels,
            datasets: [
                {
                    label: "Categorie chart",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: response.categorie.cout
                }
            ]
        };

        var fraisData = {
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            datasets: [
                {
                    label: "Categorie chart",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: response.mois.cout
                }
            ]
        };
        console.log('array dataset', data.datasets);


        var myRadarChart = new Chart(categoChart).Radar(data);
        new Chart(fraisMoisChart).Bar(fraisData);

    }).fail(function(jqXHR, textStatus) {
        console.error(jqXHR);
        console.error('Une erreur s\'est produite :', textStatus);
    });



})(jQuery);
