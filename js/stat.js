(function($) {

    //statistiques de l'administrateur (chartjs)

    var fullPath = 'http://' + window.location.host + '/enote/?request=1';
    var categolabels = [];
    $.ajax({
        url: fullPath,
        type: 'GET',
        data: {statistique: 'categorie'},
        contentType: "application/json; charset=utf-8",
        dataType: 'json'
    }).done(function(response) {
        console.log(response);
        categolabels = response.labels;
        var data = {
            labels: categolabels,
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };


        var myRadarChart = new Chart(ctx).Radar(data);

    }).fail(function(jqXHR, textStatus) {
        console.error(jqXHR);
        console.error('Une erreur s\'est produite :', textStatus);
    });

    var ctx = document.getElementById("categorieChart").getContext("2d");


})(jQuery);
