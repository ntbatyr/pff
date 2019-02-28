<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PFF - Photos from Flickr</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="caption">
                <h1 class="text-center">View photos from Flickr searching by your tags</h1>
            </div>
        </div>
    </div>
    <div class="tag-search">
        <input type="text" id="tag" name="tag" placeholder="put your tags">
        <button class="btn btn-primary btn-sm" id="search">Get photos</button>
    </div>

    <div id="mediaBlock" class="view">
        @foreach($items as $item)
        <a class="media-item" href="{{$item->link}}">
            <div class="image">
                <img src="{{$item->media->m}}" alt="{{$item->title}}">
            </div>
            <div class="attributes">
                Author: {{$item->author}}<br>
                Published: {{$item->published}}
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function () {
       $('#search').on('click', function () {
           var tag = $('#tag').val();

           if(tag != ''){
               $.ajax({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   type: 'GET',
                   url: '{{url('/search')}}/' + tag,
                   success: function (response) {
                       $('#mediaBlock').html(response);
                   }
               });
           }
           console.log(tag);
       });
    });
</script>
</body>
</html>
