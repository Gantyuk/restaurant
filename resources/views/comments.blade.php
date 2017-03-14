@foreach($comments as $comment)
    <h3>{{$comment->comment}}</h3>
    <h3>{{$comment->restaurant->name}}</h3>
    <p>{{$comment->restaurant->short_description}}</p>
@endforeach