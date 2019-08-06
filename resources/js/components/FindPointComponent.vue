<template>
    <div class="row">
        <div class="col mt-5">
            <label>
                Поиск
                <input type="text" class="form-control" placeholder="Имя метки" v-model="search">
            </label>
            <ul v-if="points.length > 0">
                <li @click="mapCenter(point.latitude, point.longitude)" @mouseover="highlightOn" @mouseleave="highlightOff" v-for="point in points" :key="point.id" v-text="point.name"></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                search: '',
                points: [],
            }
        },
        watch: {
            search: function () {
                this.search.length > 1 ? this.getAPIPoints() : this.points = []
            }
        },
        methods: {
            getAPIPoints: function () {
                var app = this;
                $.ajax({
                    url: '/api/points/find',
                    dataType: 'json',
                    data: {name: app.search},
                    success: function(json) {
                        app.points = json.data;
                    }
                });
            },
            mapCenter: function(lat, lon) {
                myMap.setCenter([lat,lon]);
            },
            highlightOn: function (event) {
                event.target.style.background = 'yellow';
            },
            highlightOff: function (event) {
                event.target.style.background = 'none';
            }
        }
    }
</script>
