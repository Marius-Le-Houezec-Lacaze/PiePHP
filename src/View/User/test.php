@if( count($records) === 1 )

count record is 1
@elseif( count($records) > 1)
i have multiple record
@else
i don't have any record
@endif

@foreach($counts as $count)
{{ $count }}
@endforeach

@isset($records)
isset is not null and well defined
@endisset

@empty($empty)
$empty is inded empty
@endempty

eeeeee