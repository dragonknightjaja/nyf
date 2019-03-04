@extends('layouts.app')
@section('content')
@include('vendor.ueditor.assets') 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">发表问题</div>
                    
                <div class="panel-body">
                    <form action="/questions/store" method="post">
                         {!! csrf_field()!!}
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                            <label for="title">标题</label>
                            <input type="text" value="{{ old('title') }}" name="title" class="form-control" placeholder="标题"，id="title">
                            @if ($errors->has('title'))
                            <span class="help-block">
                            <strong> {{ $errors->first('title')}}  </strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('bofy') ? 'has-error' : ''}} ">
                        <label for="title">内容</label>
                        <script id="container" style="height:200px;" name="body" type="text/plain"></script>
                            @if ($errors->has('body'))
                            <span style="color: #a94442;">
                            <strong> {{ $errors->first('body')}}  </strong>
                            </span>
                            @endif
                        </div>
                        <button class="btn btn-success btn-block" type="submit">发布问题</button>
                    </form>
         
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container', {
    toolbars: 
        [
            ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 
            'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 
            'justifyright',  'link', 'insertimage', 'fullscreen']
        ],
    elementPathEnabled: false,
    enableContextMenu: false,
    autoClearEmptyNode:true,
    wordCount:false,
    imagePopup:false,
    autotypeset:{ indent: true,imageBlockLine: 'center' }
});
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>


@endsection
