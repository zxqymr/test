@extends('layouts.shop')
@section('title','商品列表')
@section('content')
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li><a href="javascript:;">销量</a></li>
      <li><a href="javascript:;">价格</a></li>
     </ul><!--pro-select/-->
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
     <div class="height1"></div>
@include('public/footer')
@endsection