@extends('layouts.shop')
@section('title','注册')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">
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
      <h3>已经有账号了？点此<a class="orange" href="/index/register/login">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="u_email" id="email" placeholder="输入手机号码或者邮箱号" /><span id="msg"></span></div>
       <div class="lrList2"><input type="text" name="u_code" id="u_code" placeholder="输入短信验证码" /> <button id="sendEmailCode">获取验证码</button></div>
       <div class="lrList"><input type="password" name="u_pwd" id="u_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="confirm" id="confirm" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" class="tj" value="立即注册" />
      </div>
    <div class="height1"></div>
     @include('public/footer')
     @endsection
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).on('click','#sendEmailCode',function(){
        var email = $('#email').val();
        // alert(email);
        var reg1 = /^\w+@\w+\.com$||^1[34578]\d{9}$/;
        // var reg2 = //;
        if(email == ''){
            $('#msg').html('邮箱名不能为空');
            return;
        }else if(!reg1.test(email)){
            $('#msg').html('请填写正确格式');
            return;
        }else{
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            // alert(123);
            $.post(
                "{{url('index/register/checkEmail')}}",
                {email:email},
                function(msg){
                    alert(msg.msg);
                },
                'json'
            );
            // alert(345);
        }

        $.post(
            "{{url('index/register/sendEmail')}}",
            {email:email},
            function(res){
                alert(res.msg);
            },
            'json'
        );
        
    });
    
    $(document).on('click','.tj',function(){
    // $('.tj').click(function(){
        var u_pwd = $('#u_pwd').val();
        var confirm = $('#confirm').val();
        var u_code = $('#u_code').val();
        var u_email = $('#email').val();
        // alert(u_email);
        // alert(u_pwd);
        // alert(u_code);
        // alert(confirm);
        $.post(
            "{{url('index/register/registerDo')}}",
            {u_email:u_email,u_pwd:u_pwd,u_code:u_code,confirm:confirm},
            function(res){
                alert(res.msg);
            },
            'json'
        );
    });
</script>