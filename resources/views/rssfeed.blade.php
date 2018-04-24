<html>

<head></head>

<body>

<div class="header">
    <h1><a href="{{ $data['permalink'] }}">{{ $data['title'] }}</a></h1>
</div>

@foreach ($data['items'] as $item)
    <div class="item">
        {{--<h2><a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a></h2>--}}
        {{--<p>{{ $item->get_content() }}</p>--}}
        <h2>  {{

        print_r($item->get_categories() )}}</h2>

        {{--@foreach($item->get_categories() as $category)--}}

            {{--{{$category->get_label()}}--}}
            {{--@endforeach--}}


        <p><small>Posted on {{ $item->get_date('j F Y | g:i a') }}</small></p>

    </div>
@endforeach


</body>
</html>