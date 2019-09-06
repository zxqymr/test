@extends('layouts.shop')
@section('title','登录')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
  <body>
    <div class="maincont">
     <header>
        {{csrf_token()}}
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     
      <h3>还没有三级分销账号？点此<a class="orange" href="/index/register/register">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" id="u_email" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" id="u_pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" class="login" value="立即登录" />
      </div>
     
     <div class="height1"></div>
@include('public.footer')
@endsection
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).on('click','.login',function(){
        var u_email = $('#u_email').val();
        var u_pwd = $('#u_pwd').val();
        // alert(u_email);
        // alert(u_pwd);
        if(u_email == ''){
            alert('名称必填');
        }
        if(u_pwd == ''){
            alert('密码必填');
        }

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(
            "{{url('index/register/loginDo')}}",
            {u_email:u_email,u_pwd:u_pwd},
            function(msg){
                alert(msg.msg);
            },
            'json'
        );
        // alert(234);
    });
</script>