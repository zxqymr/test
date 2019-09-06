<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<meta name="csrf-token" content="{{csrf_token()}}" />
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
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>上传广告</span>
					<a class="addA" href="{{url('admin/banner/list')}}">广告列表</a>
				</div>
				<div class="baBody">
					@if($errors->any())
		                <div>
		                    @foreach($errors->all() as $v)
		                        <p>{{$v}}</p>
		                    @endforeach
		                </div>
		            @endif
					<form id="tf" action="{{url('admin/banner/do_add')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
					<div class="bbD">
						链接名称：<input type="text" name="banner_name" class="input1" />
					</div>
					<div class="bbD">
						链接地址：<input type="text" name="banner_url" class="input1" />
					</div>
					<div class="bbD">
						上传图片：
						<div class="bbDd">
							<div class="bbDImg">+</div>
							<input type="file" name="banner_img" class="file" /> <a class="bbDDel" href="#">删除</a>
						</div>
					</div>
					<div class="bbD">
						是否显示：
						<label><input type="radio" name="banner_status" value="1" checked="checked" />是</label> 
						<label><input type="radio"  name="banner_status" value="2" />否</label>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;排序：<input class="input2" name="banner_sort" type="text" />
					</div>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes btn">提交</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
					</form>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
<script>
	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
		}
	});
	$('input[name=banner_name]').blur(function(){
		// alert(123);
		var banner_name = $(this).val();
		if(banner_name == ''){
			alert('名称必填');
			return;
		}
		var reg = /^[\u4e00-\u9fa5\w]{3,30}$/;
		if(!reg.test(banner_name)){
			alert('名称为中文数字字母下划线组成3-30位');
			return;
		}

		$.post('/admin/banner/checkName',{banner_name:banner_name},function(msg){
			if(msg.count){
				alert('名称已存在');
			}
		},'json');
	});

	$('input[name=banner_url]').blur(function(){
		// alert(123);
		var banner_url = $(this).val();
		if(banner_url == ''){
			alert('网址必填');
			return;
		}
	});

	$('input[name=banner_img]').blur(function(){
		// alert(123);
		var banner_img = $(this).val();
		if(banner_img == ''){
			alert('图片必填');
			return;
		}
	});

	$('.btn').click(function(){
		var obj_html = $('input[name=banner_name]');
		var banner_name = obj_html.val();
		var flag = true;
		if(banner_name == ''){
			alert('名称必填');
			return;
		}
		var reg = /^[\u4e00-\u9fa5\w]{3,30}$/;
		if(!reg.test(banner_name)){
			alert('名称为中文数字字母下划线组成3-30位');
			return;
		}

		$.post('/admin/banner/checkName',{banner_name:banner_name},function(msg){
			if(msg.count){
				alert('名称已存在');
			}
		},'json');


		$.ajax({
			method:'post',
			url:"/admin/banner/checkName",
			dataType:'json',
			async:false,
			data:{banner_name:banner_name}
			}).done(function(msg){
				if(msg.count){
					alert('名称已存在');
					var flag = false;
				}
			});
		});
		if(!flag){
			return;
		}

		// alert(123);
		var url_html = $(this).val();
		if(url_html == ''){
			alert('网址必填');
			return;
		}
		// alert(123);
		var img_html = $(this).val();
		if(img_html == ''){
			alert('图片必填');
			return;
		}

		$('#tf').submit();

	});
</script>
</html>