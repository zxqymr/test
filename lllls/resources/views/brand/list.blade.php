<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="widtr=device-widtr, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
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
        <div class="content">
            <form action="" style="margin:5px;" align="left">
                <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入名称关键字">
                <input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="请输入网址">
                <button>搜索</button>
            </form>
            <table border="1" style="border-collapse:collapse;margin:5px;">
                <tr>
                    <th>ID</th>
                    <th>品牌名称</th>
                    <th>品牌logo</th>
                    <th>品牌描述</th>
                    <th>品牌网址</th>
                </tr>
                @if($data)
                @foreach($data as $v)
                <tr>
                    <th>{{$v->brand_id}}</th>
                    <th>{{$v->brand_name}}</th>
                    <th>
                        <img src="{{config('app.img_url')}}{{$v->brand_logo}}" width="80" height="120" style="cursor:pointer">
                    </th>
                    <th>{{$v->brand_desc}}</th>
                    <th>{{$v->brand_url}}</th>
                </tr>
                @endforeach
                @endif
                <tr>
                    <td colspan="5" align="center">{{$data->appends($query)->links()}}</td>
                </tr>
            </table>
        </div>
    </body>
</html>
