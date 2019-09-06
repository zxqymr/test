<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>行家添加-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;行家添加
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>行家添加</span>
					<a class="addA addA1" href="{{url('admin/hood/list')}}">行家列表</a>
				</div>
				<div class="baBody">
					@if($errors->any())
		                <div>
		                    @foreach($errors->all() as $v)
		                        <p>{{$v}}</p>
		                    @endforeach
		                </div>
		            @endif
					<form action="{{url('admin/hood/do_add')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;头像：
						<div class="vipHead vipHead1">
							<input type="file" name="hood_img"/>
						</div>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;行家名称：<input type="text" name="hood_name" class="input3" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机号码：<input type="text" name="hood_tel" class="input3" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;行家头衔：<input type="text" name="hood_title" class="input3" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;任职机构：<input type="text" name="hood_office" class="input3" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;工作年限：
						<select class="input3" name="age_name">
							@foreach($res as $v)
							<option value="{{$v->age_name}}">{{$v->age_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;所在城市：<input class="input3" name="hood_city" type="text" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;行家标签：<input class="input3" name="hood_label" type="text" />
					</div>
					<div class="bbD">
						本周可约次数：<input class="input3" name="hood_count" type="text" />
					</div>
					<div class="bbD">
						本周可约时段：<input class="input3" name="hood_time" type="text" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;赞数：<input class="input3" name="hood_number" type="text" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;会员简介：
						<div class="btext2">
							<textarea class="text2" name="hood_desc"></textarea>
						</div>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;审核状态：
						<label>
							<input type="radio" checked="checked" name="audit_status" value="未审核" />&nbsp;未审核
						</label>
						<label>
							<input type="radio" name="audit_status" value="已通过" />&nbsp;已通过
						</label>
						<label class="lar">
							<input type="radio" name="audit_status" value="不通过" />&nbsp;不通过
						</label>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是否推荐：
						<label>
							<input type="radio" checked="checked" name="is_recommend" value="是" />&nbsp;是
						</label>
						<label>
							<input type="radio" name="is_recommend" value="否" />&nbsp;否
						</label>
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