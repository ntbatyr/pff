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
