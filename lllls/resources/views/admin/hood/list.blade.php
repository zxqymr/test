<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>行家-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<link rel="stylesheet" href="{{asset('css/page.css')}}" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>

<!-- <script type="text/javascript" src="/admin/js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>

		<div class="page">
			<!-- banner页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form>
						<div class="cfD">
							工作年限：
							<select name="age_name">
								@foreach($res as $v)
								<option value="{{$v->age_id}}">{{$v->age_name}}</option>
								@endforeach
							</select> 
							审核状态：
							<label>
								<input type="radio" checked="checked" name="audit_status" />&nbsp;未审核
							</label>
							<label>
								<input type="radio" name="audit_status" />&nbsp;已通过
							</label>
							<label class="lar">
								<input type="radio" name="audit_status" />&nbsp;不通过
							</label>
							推荐状态：
							<label>
								<input type="radio" checked="checked" name="is_recommend" />&nbsp;是
							</label>
							<label>
								<input type="radio" name="is_recommend" />&nbsp;否
							</label>
						</div>
						<div class="cfD">
							<input class="addUser" type="text" name="hood_name" value="{{$query['hood_name']??''}}" placeholder="输入用户名" />
							<button class="button">搜索</button>
							<a class="addA addA1" href="{{url('admin/hood/add')}}">添加行家+</a>
						</div>
					</form>
				</div>
				<!-- banner 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="170px" class="tdColor">头像</td>
							<td width="135px" class="tdColor">姓名</td>
							<td width="145px" class="tdColor">手机号码</td>
							<td width="140px" class="tdColor">所在城市</td>
							<td width="140px" class="tdColor">任职机构</td>
							<td width="145px" class="tdColor">行家头衔</td>
							<td width="150px" class="tdColor">本周预约次数</td>
							<td width="140px" class="tdColor">可约时段</td>
							<td width="140px" class="tdColor">审核状态</td>
							<td width="150px" class="tdColor">是否推荐</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						@foreach($data as $v)
						<tr>
							<td>{{$v->hood_id}}</td>
							<td><div class="onsImg">
									<img src="{{config('app.img_url')}}{{$v->hood_img}}">
								</div>
							</td>
							<td>{{$v->hood_name}}</td>
							<td>{{$v->hood_tel}}</td>
							<td>{{$v->hood_city}}</td>
							<td>{{$v->hood_office}}</td>
							<td>{{$v->hood_title}}</td>
							<td>{{$v->hood_count}}</td>
							<td>{{$v->hood_time}}</td>
							<td>{{$v->audit_status}}</td>
							<td>{{$v->is_recommend}}</td>
							<td>
								<a href="connoisseuradd.html">
									<img class="operation" src="/admin/img/update.png">
								</a>
								<img class="operation delban" src="/admin/img/delete.png">
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="12" align="center">{{$data->appends($query)->links()}}</td>
						</tr>
					</table>
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="/admin/img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end
</script>
</html>