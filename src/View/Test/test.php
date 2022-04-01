<h1>Hello world ma</h1>

@if(true)
{{ $id }}
@endif


@foreach ($array as $number )
    {{ $number }} <br>
@endforeach

@empty($array)
    {{ 'empty' }}
@endempty