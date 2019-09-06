@extends('layouts.shop')
@section('title','购物车')
@section('content')
<meta name="csrf-token" content="{{csrf_token()}}">
    <div class="maincont">
     <header>
        {{csrf_token()}}
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
    <div class="dingdanlist">
    <table>
        <tr>
            <td width="100%" colspan="4">
                <a href="javascript:;"><input type="checkbox" id="quanxuan" name="1" /> 全选</a>
            </td>
        </tr>
        @foreach($data as $v)
        <tr banner_id="{{$v->banner_id}}">
            <td width="4%"><input type="checkbox" class="box" name="1" /></td>
            <td class="dingimg" width="15%"><img src="{{config('app.img_url')}}{{$v->banner_img}}" /></td>
            <td width="50%">
                <h3>{{$v->banner_name}}</h3>
                <time>下单时间：{{date("Y-m-d H:i:s",$v->created_at)}}</time>
            </td>
            <td align="right">
                <div class="c_num">
                    <input type="button" class="car_btn_1" value="-" />
                    <input type="text" value="{{$v->banner_num}}" />
                    <input type="button" class="car_btn_2" value="+" />
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="4"><strong class="orange">¥{{$v->banner_sort*$v->banner_num}}</strong></th>
        </tr>
        @endforeach
        <tr>
            <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
        </tr>
    </table>
    </div><!--dingdanlist/-->
    <div class="height1"></div>
    <div class="gwcpiao">
    <table>
        <tr>
            <th width="10%">
                <a href="javascript:history.back(-1)">
                    <span class="glyphicon glyphicon-menu-left"></span>
                </a>
            </th>
            <td width="50%">
                总计：<strong class="orange">¥69.88</strong>
            </td>
            <td width="40%">
                <a href="pay.html" class="jiesuan">去结算</a>
            </td>
        </tr>
    </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/index/js/bootstrap.min.js"></script>
    <script src="/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
@endsection
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script>
    // 点击全选
    $(document).on('click','#quanxuan',function(){
        var _this = $(this);
        var status = _this.prop('checked');
        $('.box').prop('checked',status);
        // 调用总价
        getCount();
    });
    // 点击复选框
    $(document).on('click','.box',function(){
        // 获取总价
        getCount();
    })
    // 点击 +
    $(document).on('click','.car_btn_2',function(){
        alert(123);
    });

    // 点击 -// 失去焦点// 点击删除// 获取总价// 点击结算

    // 计算小计
    function getTotal(banner_id,_this){
        $.post(
            "{{url('index/cart/getTotal')}}",
            {banner_id:banner_id},
            function(res){
                alert(346);
                // _this.parents('td').next('td').text("￥"+res);
            }
        );
    }

    //给当前行复选框默认选中
    function checkedTr(_this){
        // _this.parents('tr').find("input[class='box']").prop('checked',true);
    }

    //计算总价
    function getCount(){
        // 获取选中的复选框的id
        var banner_id = '';
        $('.box:checked').each(function(index){
            banner_id += $(this).parents('tr').attr('banner_id')+',';
        });
        banner_id = banner_id.substr(0,banner_id.length-1);
        // alert(banner_id);
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post(
            "{{url('index/cart/getCount')}}",
            {banner_id:banner_id},
            function(res){
                alert('aaaa');
                // $('#count').text("￥"+res);
            }
        );
    }
</script>