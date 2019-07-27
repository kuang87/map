
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Карта</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/template.css')}}" rel="stylesheet">

    <script src="https://api-maps.yandex.ru/2.1/?apikey=b0026182-900c-4327-8e03-6bfb8a604589&lang=ru_RU"
            type="text/javascript">
    </script>
</head>

<body>
<div class="container">

    <nav class="navbar navbar-dark bg-dark">
        <button class="btn btn-sm btn-outline-secondary" type="button">Go</button>
    </nav>

    <div class="row mb-3">
        <div class="col">
            <h1>Карта</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <form action="{{action('PointController@store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Новая метка:</label>
                    <input type="text" name="name" class="form-control mb-1" placeholder="Имя" value="{{old('name')}}">
                    <input type="text" name="latitude" class="form-control mb-1" id="latitude" placeholder="Широта" value="{{old('latitude')}}">
                    <input type="text" name="longitude" class="form-control mb-1" id="longitude" placeholder="Долгота" value="{{old('longitude')}}">
                    <select class="form-control mb-1" name="category">
                        <option value="" disabled selected>Выберите категорию</option>
                        @forelse($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @empty
                        @endforelse
                    </select>
                    <textarea class="form-control" name="note" rows="3" placeholder="Описание">{{old('note')}}</textarea>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <hr>

                <button class="btn btn-primary">Создать</button>
            </form>
        </div>

        <div class="col-md-8 pt-4">
            <div id="map" style="height: 500px;">
            </div>
        </div>
    </div>

    <div class="row mt-3 footer-classic context-dark bg-image" style="background: #2d3246;">
        <div class="col-md-4">
            <p class="text-center">&copy;2019</p>
        </div>

        <div class="col-md-4 text-center">
            <h5>Контакты</h5>
            <dl class="contact-list">
                <dt>Адрес:</dt>
                <dd>Санкт-Петербург</dd>
            </dl>
        </div>

    </div>
</div>




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  </body>

@stack('scripts')

</html>