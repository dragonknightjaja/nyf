@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($questions as $question)
            <div class="media">
                <div class="media-left">
                    <a href="">
                        <img width= "24" src="{{$question->user->avatar}}" alt="{{$question->user->name}}">
                    </a>
                </div>
                <div class = "media-body">
                    <h4 class="media-heading">
                        <a>{{$question->user->name}}</a>
                        <br>
                        <a href="/questions/show/{{$question->id}}">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{$question->title}}
                                </div>
                                <div class="panel-body">
                                    <?php echo $question->body;?>
                                </div>
                            </div>
                        </a>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .panel-body img {
    width:100%;
}

a.topic {
    background-color: #eff6fa;
    padding: 1px 10px 0;
    border-radius: 30px;
    text-decoration: none;
    margin: 0 5px 5px 0;
    display: inline-block;
    white-space: normal;
    cursor: pointer;
}

a:hover {
    
    text-decoration: none;
}


.button.is-naked{
background: 0 0;
border: none;
border-radius: 0;
padding: 0;
height: auto;
}
.actions{
display: flex;
padding: 10px 20px;
}
.delete-form{
margin-left: 20px;
}
.delete-button{
color: #3097D1;
text-decoration: none;
}
</style>
@endsection