<!DOCTYPE html>
<html lang="GBK">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>YinFeng</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        <!-- 被墙了 -->
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height"> 
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">登录</a>
                    <a href="{{ url('/register') }}">注册</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    YinFeng
                </div>
                <h1>比金凤更爱学习</h1>
                <br>
                <div class="links">
                    <a href="/articles/create">交流区</a>
                    <a href="">资源区</a> 
                    <a href="/questions/create">问答区</a>
                    <a href="">搜索</a>
                    <a href="">个人设置</a>
                </div>
            </div>
        </div>
    </body>
</html>
