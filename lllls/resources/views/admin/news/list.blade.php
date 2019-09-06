<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员管理-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<link rel="stylesheet" type="text/css" href="/admin/css/manhuaDate.1.0.css">
<link rel="stylesheet" href="{{asset('css/page.css')}}" />
	<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
	<script type="text/javascript" src="/admin/js/manhuaDate.1.0.js"></script>
	<script type="text/javascript" src="/admin/js/jquery-1.7.2.min.js"></script>
	<!-- <script type="text/javascript" src="/admin/js/page.js" ></script> -->
	<script type="text/javascript">
$(function (){
  $("input.mh_date").manhuaDate({
    Event : "click",//可选               
    Left : 0,//弹出时间停靠的左边位置
    Top : -16,//弹出时间停靠的顶部边位置
    fuhao : "-",//日期连接符默认为-
    isTime : false,//是否开启时间值默认为false
    beginY : 1949,//年份的开始默认为1949
    endY :2100//年份的结束默认为2049
  });
});
</script>
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
			<!-- vip页面样式 -->
			<div class="vip">
				<div class="conform">
					<form>
						<div class="cfD">
							<select class="input3" name="cate_id">
								@foreach($res as $v)
								<option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
								@endforeach
							</select>
							<input class="addUser" type="text" value="{{$query['news_title']??''}}" name="news_title" placeholder="文章标题" />
							<button class="button">搜索</button>
							<a class="addA addA1" href="{{url('admin/news/add')}}">添加文章+</a>
						</div>
					</form>
				</div>
				<!-- vip 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="250px" class="tdColor">文章标题</td>
							<td width="188px" class="tdColor">文章分类</td>
							<td width="235px" class="tdColor">文章重要性</td>
							<td width="220px" class="tdColor">是否展示</td>
							<td width="290px" class="tdColor">文章作者</td>
							<td width="282px" class="tdColor">作者email</td>
							<td width="282px" class="tdColor">关键字</td>
							<td width="282px" class="tdColor">网站描述</td>
							<td width="282px" class="tdColor">文章头像</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						@foreach($data as $v)
						<tr>
							<td>{{$v->news_id}}</td>
							<td>{{$v->news_title}}</td>
							<td>{{$v->cate_name}}</td>
							<td>{{$v->news_major}}</td>
							<td>{{$v->is_show}}</td>
							<td>{{$v->news_author}}</td>
							<td>{{$v->author_email}}</td>
							<td>{{$v->keyword}}</td>
							<td>{{$v->web_desc}}</td>
							<td><div class="onsImg onsImgv">
									<img src="{{config('app.img_url')}}{{$v->news_logo}}">
								</div></td>
							<td>
								<a href="edit/{{$v->news_id}}">
									<img class="operation" src="/admin/img/update.png">
								</a>
								<img class="operation delban" src="/admin/img/delete.png">
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="13" align="center">{{$data->appends($query)->links()}}</td>
						</tr>
					</table>
				</div>
				<!-- vip 表格 显示 end-->
			</div>
			<!-- vip页面样式end -->
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