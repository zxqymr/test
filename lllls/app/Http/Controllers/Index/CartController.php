<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    // 加入购物车
    public function cartListDo(){
    	$banner_id = request()->banner_id;
    	$banner_num = request()->banner_num;
    	// dd($banner_id);
    	if(!$banner_id){
    		return ['code'=>2,'msg'=>'请至少选择一件商品'];
    	}
    	$where = [
    		['banner_id','=',$banner_id],
    		['banner_status','=',1]
    	];
    	$data = DB::table('banner')->where($where)->first();
    	// dd($data);
    	
    	// 加入购物车
    	$this->saveCartInfoDb($banner_id,$banner_num);
    }

    // 加入购物车    进数据库
    public function saveCartInfoDb($banner_id,$banner_num){
    	$user = DB::table('register')->first();
    	$u_id = $user->u_id;
        $banner = DB::table('banner')->where('banner_id',$banner_id)->first();
        // dd($banner);
        $banner_name = $banner->banner_name;
        $banner_sort = $banner->banner_sort;
        $banner_img = $banner->banner_img;
        // dd($banner_name);
    	$cartWhere = [
    		['banner_id','=',$banner_id],
    		['u_id','=',$u_id],
            ['banner_name','=',$banner_name]
    	];
    	$cartInfo = DB::table('cart')->where($cartWhere)->first();
    	// dd($cartInfo);
    	if($cartInfo){
    		// 检测库存  累加  修改
    		$res = $this->checkGoodsNumber($banner_num,$banner_id,$cartInfo->banner_num);
    		// dd($res);
    		if(!$res){
    			return ['code'=>2,'msg'=>'库存不足'];
    		}
    		$update = [
                'banner_num'=>$banner_num+$cartInfo['banner_num'],
                'updated_at'=>time(),
            ];
    		$result = DB::table('cart')->where('banner_id',$banner_id)->update($update);
    		// dd($update);
    		return ['code'=>1,'msg'=>'加入购物车成功'];
    	}else{
    		$res = $this->checkGoodsNumber($banner_num,$banner_id);
            // dd($res);
            if(!$res){
                return ['code'=>2,'msg'=>'库存不足'];
            }
            $info = [
                'banner_id'=>$banner_id,
                'banner_num'=>$banner_num,
                'u_id'=>$u_id,
                'created_at'=>time(),
                'banner_name'=>$banner_name,
                'banner_sort'=>$banner_sort,
                'banner_img'=>$banner_img,
            ];
            $result = DB::table('cart')->insert($info);
            // dd($result);
            if($result){
                return ['code'=>1,'msg'=>'加入购物车成功'];
            }else{
                return ['code'=>2,'msg'=>'加入购物车失败'];
            }
    	}
    }

    // 检测库存
    public function checkGoodsNumber($banner_num,$banner_id,$already_number=0){
        $num = $banner_num+$already_number;
        // dd($num);
        $goods_num = DB::table('banner')->where('banner_id',$banner_id)->first();
        // echo $num;die;
        $goods_num = $goods_num->banner_num;
        // dd($goods_num);
        if($num>$goods_num){
            return false;
        }else{
            return true;
        }
    }

    // 列表展示
    public function cartList(){
        $data = DB::table('cart')->get();
        // dd($data);
        $count = DB::table('cart')->count();
        // dd($count);
        return view('index.cart.cartList',['data'=>$data,'count'=>$count]);
    }

    // 计算小计
    public function getTotal(){
        $banner_id = request()->banner_id;
        dd($banner_id);
    }

    // 计算总价
    public function getCount(){
        $banner_id = request()->banner_id;
        // dd($banner_id);
        if($banner_id){
            $user = DB::table('register')->first();
            $u_id = $user->u_id;
            $cartWhere = [
                ['u_id','=',$u_id],
                ['banner_id','=',$banner_id],
                ['is_del','=',1]
            ];
            $info = DB::table('cart')->where($cartWhere)->get();
            dd($info);
        }
    }

    // 获取总价
    public function getCount(){
        $goods_id = input('post.goods_id','');
        if(!empty($goods_id)){
            if($this->checkLogin()){
                // 从数据库获取 购买数量 商品价格
                $user_id = $this->getUserId();
                $cartWhere = [
                    ['user_id','=',$user_id],
                    ['c.goods_id','in',$goods_id],
                    ['is_del','=',1]
                ];
                $info = $this->m
                ->field("shop_price,buy_number")
                ->alias('c')
                ->join("shop_goods g","c.goods_id=g.goods_id")
                ->where($cartWhere)
                ->select();
            }else{
                // 从cookie中获取 购买数量 商品价格
                $goods_model = model('Goods');
                $where = [
                    ['goods_id','in',$goods_id],
                    ['status','=',1]
                ];
                $info = $goods_model->field('goods_id,shop_price')->where($where)->select();
                // dump($info);die;
                $str = cookie('cartInfo');
                $cartInfo = getBase64Info($str);
                // print_r($info);
                // print_r($cartInfo);die;
                foreach($info as $k=>$v){
                    foreach($cartInfo as $key=>$val){
                        if($v['goods_id'] == $val['goods_id']){
                            $info[$k]['buy_number'] = $val['buy_number'];
                        }
                    }
                }
            }

            // 总价
            $count = 0;
            foreach($info as $k=>$v){
                $count += $v['shop_price']*$v['buy_number'];
            }
            echo $count;
        }else{
            echo 0;
        }
    }
}
