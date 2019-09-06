<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员编辑-有点</title>
<link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;会员编辑
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>文章编辑</span>
				</div>
				<div class="baBody">
					@if($errors->any())
		                <div>
		                    @foreach($errors->all() as $v)
		                        <p>{{$v}}</p>
		                    @endforeach
		                </div>
		            @endif
					<form action="{{url('admin/news/do_add')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="bbD">
							文章标题：<input type="text" name="news_title" class="input3" />
						</div>
						<div class="bbD">
							文章分类：
							<select class="input3" name="cate_name">
								@foreach($res as $v)
								<option value="{{$v->cate_name}}">{{$v->cate_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="bbD">
							文章重要性：
							<label><input type="radio" name="news_major" value="普通" checked="checked" />普通</label> 
							<label><input type="radio"  name="news_major" value="置顶" />置顶</label>
						</div>
						<div class="bbD">
							文章重要性：
							<label><input type="radio" name="is_show" value="显示" checked="checked" />显示</label> 
							<label><input type="radio"  name="is_show" value="不显示" />不显示</label>
						</div>
						<div class="bbD">
							文章作者：<input type="text" name="news_author" class="input3" />
						</div>
						<div class="bbD">
							作者email：<input type="text" name="author_email" class="input3" />
						</div>
						<div class="bbD">
							关键字：<input type="text" name="keyword" class="input3" />
						</div>
						
						<div class="bbD">
							网页描述：
							<div class="btext">
								<textarea class="text1" name="web_desc"></textarea>
							</div>
						</div>
						<div class="bbD">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;头像：
							<div class="vipHead">
								<img src="" alt="" />
								<input name="news_logo" type="file" />
							</div>
						</div>

						<div class="bbD">
							<p class="bbDP">
								<button class="btn_ok btn_yes">确定</button>
								<input class="btn_ok btn_no" type="reset" value="重置">
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