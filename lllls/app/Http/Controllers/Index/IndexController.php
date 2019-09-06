<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function index(){
    	$data = DB::table('banner')->get();
    	return view('index.index',['data'=>$data]);
    }

    public function user(){
    	return view('index.user');
    }

    public function goodsList(){
        $data = DB::table('banner')->get();
        return view('index.goodsList',['data'=>$data]);
    }

    public function goodsDetail(){
    	$banner_id = request()->banner_id;
    	// dd($banner_id);
    	// if(!$banner_id){
    	// 	alert('请至少选择一件商品');
    	// }
    	$where = [
    		['banner_id','=',$banner_id],
    		['banner_status','=',1]
    	];
    	$res = DB::table('banner')->where($where)->first();
    	// dd($res);
    	$data = DB::table('banner')->get();
        $user = DB::table('register')->first();
        $u_email = $user->u_email;

        // 评论列表展示
        $pagesize = config('app.pageSize');
        $comment = DB::table('comment')->orderBy('created_at','desc')->paginate($pagesize);
        // dd($comment);
        // print_r(request()->ajax());
        if(request()->ajax()){
            return view('index.ajaxlist',['res'=>$res,'data'=>$data,'u_email'=>$u_email,'comment'=>$comment]);
        }
    	return view('index.goodsDetail',['res'=>$res,'data'=>$data,'u_email'=>$u_email,'comment'=>$comment]);
    }

    public function comment(){
        $data = request()->except('_token','id');
        // dd($data);
        $user = DB::table('register')->first();
        $u_email = $user->u_email;
        $info = [
            'name'=>$data['name'],
            'email'=>$data['email'],
            'order'=>$data['order'],
            'desc'=>$data['desc'],
            'created_at'=>time()
        ];
        $res = DB::table('comment')->insert($info);
        // dd($res);
        if($res){
            return ['code'=>1,'msg'=>'添加成功'];
        }else{
            return ['code'=>2,'msg'=>'添加失败'];
        }
    }
}
