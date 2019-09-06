@extends('layouts.shop')
@section('title','珠宝首页')
@section('content')

     <div class="head-top">
      <img src="/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h2>三级分销终身荣誉会员</h2>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="index/register/login">登录</a></li>
      <li><a href="index/register/register" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
        @foreach($data as $v)
      <img src="{{config('app.img_url')}}{{$v->banner_img}}" width="450" height="200" />
        @endforeach
     </div><!--sliderA/-->
     <ul class="pronav">
      <li><a href="prolist.html">晋恩干红</a></li>
      <li><a href="prolist.html">万能手链</a></li>
      <li><a href="prolist.html">高级手镯</a></li>
      <li><a href="prolist.html">特异戒指</a></li>
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
      @foreach($data as $v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('index/goodsDetail')}}?banner_id={{$v->banner_id}}"><img src="{{config('app.img_url')}}{{$v->banner_img}}" width="150" height="210" /></a></dt>
        <dd class="ip-text"><a href="{{url('index/goodsDetail')}}?banner_id={{$v->banner_id}}">{{$v->banner_name}}</a><span>已售：488</span></dd>
        <dd class="ip-price"><strong>¥{{$v->banner_sort}}</strong> <span>¥599</span></dd>
       </dl>
      </div>
      @endforeach
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
        @foreach($data as $v)
      <dl>
       <dt><a href="{{url('index/goodsDetail')}}?banner_id={{$v->banner_id}}"><img src="{{config('app.img_url')}}{{$v->banner_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('index/goodsDetail')}}?banner_id={{$v->banner_id}}">{{$v->banner_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$v->banner_sort}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
        @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     @include('public/footer')
     @endsection