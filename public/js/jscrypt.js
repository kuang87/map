$(window).ready(function () {
    jQuery("#make").click(function () {

        $.ajax({
            method: 'POST',
            url: 'http://mymap.laravel/api/points',
            data: {
                name: $("#name").val(),
                latitude: $("#latitude").val(),
                longitude: $("#longitude").val(),
                category: $("#category").val(),
                note: $("#note").val()
            },
        })
            .done(function( msg ) {
                myMap.geoObjects.removeAll();
                getPoints();
                $("#name").val("");
                $("#latitude").val("");
                $("#longitude").val("");
                $("#category").val("");
                note: $("#note").val("");
            });
    });
});