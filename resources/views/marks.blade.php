@foreach($marks as $mark)
    <h3>{{$mark->mark}}</h3>
    <h3>{{$mark->restaurant->name}}</h3>
    <p>{{$mark->restaurant->short_description}}</p>
@endforeach