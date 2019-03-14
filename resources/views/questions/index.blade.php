@extends('layouts.app')

@section('content') 
<a href="/questions/create" class="button">new</a>
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
                        {{$question->created_at}}
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
a.button {
    position:fixed;
    top:300px;
    right:100px;
    color: rgba(255,255,255,1);
    text-decoration: none;
    background-color: rgba(219,87,5,1);
    font-family: 'Yanone Kaffeesatz';
    font-weight: 20;
    font-size: 1em;
    display: block;
    padding: 4px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -webkit-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
    -moz-box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
    box-shadow: 0px 9px 0px rgba(219,31,5,1), 0px 9px 25px rgba(0,0,0,.7);
    margin: 100px auto;
    width: 50px;
    height: 40px;
    text-align: center;
    -webkit-transition: all .1s ease;
    -moz-transition: all .1s ease;
    -ms-transition: all .1s ease;
    -o-transition: all .1s ease;
    transition: all .1s ease;
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