@extends('layouts.shop')
@section('title','详情')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">
<link rel="stylesheet" href="{{asset('css/page.css')}}" />
    <div class="maincont">
     <header>
        {{csrf_token()}}
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @foreach($data as $v)
      <img src="{{config('app.img_url')}}{{$v->banner_img}}" width="450" height="200" />
        @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$res->banner_sort}}</strong></th>
       <td>
        <div class="c_num">
            <input type="button" class="car_btn_1" value="-" />
            <input type="text" value="1" class="spinnerExample" />  
            <input type="button" class="car_btn_2" value="+" />
        </div>
       </td>

       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td>
        <input type="hidden" id="{{$res->banner_id}}" name="banner_id">
        <a href="javascript:;" class="cart">加入购物车</a>
        </td>
      </tr>
      <tr>
       <td>
        <strong>{{$res->banner_name}}</strong>
        <p class="hui">富含纤维素，平衡每日膳食</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{config('app.img_url')}}{{$res->banner_img}}" width="300" height="380" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
    </div><!--maincont-->

    <!-- list start -->
    <div id="con">
        <table border="1">
            <tr>
                <td>用户名</td>
                <td>E-mail</td>
                <td>评论等级</td>
                <td>评论内容</td>
            </tr>
            @foreach($comment as $v)
            <tr>
                <td>{{$v->name}}</td>
                <td>{{$v->email}}</td>
                <td>{{$v->order}}</td>
                <td>{{$v->desc}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" align="center">{{$comment->links()}}</td>
            </tr>
        </table>
    </div>
    <!-- list end -->
    <!-- add start -->
        <form>
        <table>
            <tr>
                <td>用户名：</td>
                <td><input type="text" class="name" name="name" value="匿名用户"></td>
            </tr>
            <tr>
                <td>E-mail：</td>
                <td><input type="text" class="email" value="{{$u_email}}" name="email"></td>
            </tr>
            <tr>
                <td>评论等级：</td>
                <td>
                    <input type="radio" name="order" class="order" value="1">1
                    <input type="radio" name="order" class="order" value="2">2
                    <input type="radio" name="order" class="order" value="3">3
                    <input type="radio" name="order" class="order" value="4">4
                    <input type="radio" name="order" class="order"value="5" checked="checked">5
                </td>
            </tr>
            <tr>
                <td>评论内容：</td>
                <td>
                    <textarea name="desc" class="desc" cols="15" rows="4"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" class="sub"  value="提交"></td>
            </tr>
        </table>
        </form>
    <!-- add end -->

@endsection
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
$(function(){
    // ajax分页
    $(document).on('click','.pagination a',function(){
        var url = $(this).attr('href');
        // alert(url);
        $.ajax({
            url:url,
            method:'GET',
            data:''
        }).done(function(msg){
            $('#con').html();
        });
        // return false;
    });
    // 评论提交
    $('.sub').click(function(){
        // alert(123);
        var _this = $(this);
        var name = $('.name').val();
        var email = $('.email').val();
        var desc = $('.desc').val();
        var order = $('.order:checked').val();
         
        // console.log(name);
        // console.log(email);
        // console.log(order);
        // console.log(desc);

         $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(
            "{{'/index/comment'}}",
            {name:name,email:email,desc:desc,order:order},
            function(res){
                // console.log(res);
                if(res.code==1){
                    alert(res.msg);
                    location.href="go(0)";
                    history.go(0);
                }
            },
            'json'
        );
    });
    // 点击 +
    $(document).on('click','.cart',function(){
        var _this = $(this);
        var banner_id = _this.prev().attr('id');
        var banner_num = $('.spinnerExample').val();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(
            "{{url('/index/cart/cartListDo')}}",
            {banner_id:banner_id,banner_num:banner_num},
            function(msg){
                alert(msg.msg);
            },
            'json'
        );

    });
});
</script>