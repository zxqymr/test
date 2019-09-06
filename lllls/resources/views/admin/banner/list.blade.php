<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<link rel="stylesheet" href="{{asset('css/page.css')}}" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="/admin/js/page.js" ></script> -->
<meta name="csrf-token" content="{{csrf_token()}}" />
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
			<div class="banner">
				<div class="add">
					<a class="addA" href="{{url('admin/banner/add')}}">上传广告&nbsp;&nbsp;+</a>
				</div>
				<!-- banner 表格 显示 -->
				<div class="banShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="315px" class="tdColor">图片</td>
							<td width="308px" class="tdColor">名称</td>
							<td width="450px" class="tdColor">链接</td>
							<td width="215px" class="tdColor">是否显示</td>
							<td width="180px" class="tdColor">排序</td>
							<td width="125px" class="tdColor">操作</td>
						</tr>
						@foreach($data as $v)
						<tr>
							<td>{{$v->banner_id}}</td>
							<td><div class="bsImg">
									<img src="{{config('app.img_url')}}{{$v->banner_img}}">
								</div></td>
							<td>{{$v->banner_name}}</td>
							<td><a class="bsA" href="#">{{$v->banner_url}}</a></td>
							<td>{{$v->banner_status}}</td>
							<td>{{$v->banner_sort}}</td>
							<td>
								<a href="edit/{{$v->banner_id}}"><img class="operation" src="/admin/img/update.png"></a> 
								<a href="javascript:void(0)" id="{{$v->banner_id}}" class="del"><img class="operation delban" src="/admin/img/delete.png"></a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="7" align="center">{{$data->links()}}</td>
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
				<a href="#" class="ok yes" onclick="del()">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
$('.del').click(function(){
	var banner_id = $(this).attr('id');
	if(!banner_id){
		alert('请选择一条记录');
	}
	$.ajaxSetup({
		headers:{
			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
		}
	});
	$.post('/admin/banner/del/'+banner_id,'',function(msg){
		alert(msg.msg);
		window.location.reload();
	},'json');
});
</script>
</html>