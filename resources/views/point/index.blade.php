@extends('layout')

@push('scripts')
    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            myMap = new ymaps.Map("map", {
                center: [59.94, 30.40],
                zoom: 11,
                controls: [
                    'zoomControl',
                    'rulerControl',
                    'routeButtonControl',
                    'trafficControl',
                    'typeSelector',
                    'fullscreenControl',

                    new ymaps.control.SearchControl({
                        options: {
                            size: 'large',
                            provider: 'yandex#search'
                        }
                    })
                ]
            });

            myMap.cursors.push('arrow');

            myMap.events.add('click', function (e) {
                var position = e.get('coords');
                myMap.balloon.open(position, position[0] + " " + position[1]);
                document.getElementById('latitude').value = position[0];
                document.getElementById('longitude').value = position[1];
            });

            getPoints();

            {{--
            @if(isset($points))
                @foreach($points as $point)
                    var myPlacemark = new ymaps.Placemark([{{$point->latitude}}, {{$point->longitude}}], {
                        balloonContentHeader: '{{$point->name}}',
                        balloonContentBody: '{{$point->note->content ?? ''}}<br ><small><em>{{$point->created_at->format('d.m.Y') ?? ''}}</em></small>',
                        balloonContentFooter: '{{$point->category->title ?? ''}}',
                    });
                myMap.geoObjects.add(myPlacemark);
                @endforeach
            @endif
           --}}
        }

        function getPoints() {
            $.ajax({
                url: '{{action('APIPointController@index')}}',
                dataType: 'json',
                success: function(json){
                    for (let point of json.data){
                        var myPlacemark = new ymaps.Placemark([point.latitude, point.longitude], {
                            balloonContentHeader: point.name,
                            balloonContentBody: point.note + '<br ><small><em>' + point.created_at + '</em></small>',
                            balloonContentFooter: point.category,
                        });
                        myMap.geoObjects.add(myPlacemark);
                    }
                }
            });
        }
    </script>
@endpush
