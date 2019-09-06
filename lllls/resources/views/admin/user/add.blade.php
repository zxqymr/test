<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加用户-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		<div class="page ">
			<!-- 会员注册页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>会员注册</span>
				</div>
				<a class="addA" href="{{url('admin/user/list')}}">会员列表</a>
				<div class="baBody">
					@if($errors->any())
		                <div>
		                    @foreach($errors->all() as $v)
		                        <p>{{$v}}</p>
		                    @endforeach
		                </div>
		            @endif
					<form action="{{url('admin/user/do_add')}}" method="post">
						{{csrf_field()}}
						<div class="bbD">
							&nbsp;&nbsp;&nbsp;用户名：<input type="text" name="user_name" class="input3" />
						</div>
						<div class="bbD">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码：<input type="password" name="user_pwd" class="input3" />
						</div>
						<div class="bbD">
							用户等级：<input type="text" name="user_rand" class="input3" />
						</div>
						<div class="bbD">
							<p class="bbDP">
								<button class="btn_ok btn_yes">提交</button>
								<a class="btn_ok btn_no" href="#">取消</a>
							</p>
						</div>
					</form>
				</div>
			</div>

			<!-- 会员注册页面样式end -->
		</div>
	</div>
</body>
</html>