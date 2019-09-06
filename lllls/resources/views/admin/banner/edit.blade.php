<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
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
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>上传广告</span>
					<a class="addA" href="{{url('admin/banner/update')}}">广告列表</a>
				</div>
				<div class="baBody">
					@if($errors->any())
		                <div>
		                    @foreach($errors->all() as $v)
		                        <p>{{$v}}</p>
		                    @endforeach
		                </div>
		            @endif
					<form action="{{url('admin/banner/update/'.$data->banner_id)}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
					<div class="bbD">
						链接名称：<input type="text" name="banner_name" value="{{$data->banner_name}}" class="input1" />
					</div>
					<div class="bbD">
						链接地址：<input type="text" name="banner_url" value="{{$data->banner_url}}" class="input1" />
					</div>
					<div class="bbD">
						上传图片：
						<div class="bbDd">
							<div class="bbDImg"><img src="{{config('app.img_url')}}{{$data->banner_img}}" width="160" height="180" alt="" /></div>

							<input type="file" name="banner_img" class="file" /> <a class="bbDDel" href="#">删除</a>
						</div>
					</div>
					<div class="bbD">
						是否显示：
						<label><input type="radio" name="banner_status" {{$data['banner_status']==1?"checked":''}} value="1" />是</label> 
						<label><input type="radio"  name="banner_status" {{$data['banner_status']==2?"checked":''}} value="2" />否</label>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;排序：<input class="input2" name="banner_sort" value="{{$data->banner_sort}}" type="text" />
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

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>