(function($) {

    //statistiques de l'administrateur (chartjs)

    var fullPath = 'http://' + window.location.host + '/enote/?request=1';
    var categoChart = $("#categorieChart").get(0).getContext("2d");
    var fraisMoisChart = $("#fraisChart").get(0).getContext("2d");
    var userChart = $("#userChart").get(0).getContext("2d");

    //requete pour les donnees des categories
    $.ajax({
        url: fullPath,
        type: 'GET',
        data: {statistique: 'categorie'},
        contentType: "application/json; charset=utf-8",
        dataType: 'json'
    }).done(function(response) {
            
        var dataDon = response.categorie.all;

        //data pour les frais par mois
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

        //data pour les categories
        var data = {
            labels: response.user.login,
            datasets: [
                {
                    label: "Categorie chart",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: response.user.cout
                }
            ]
        };

        new Chart(categoChart).Doughnut(dataDon);
        new Chart(fraisMoisChart).Line(fraisData);
        new Chart(userChart).Bar(data);

    }).fail(function(jqXHR, textStatus) {
        console.error(jqXHR);
        console.error('Une erreur s\'est produite :', textStatus);
    });



})(jQuery);
