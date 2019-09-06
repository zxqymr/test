<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brands;
use Illuminate\Support\Facades\Cookie;

class Brand extends Controller
{
    /**
     * Display a listing of the resource.
     * 列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo request()->cookie('author');
        Cookie::queue(Cookie::forget('author'));
        // Cookie::forget('author');
        echo Cookie::get('author');
        // request()->session()->forget('name');
        // $res = request()->session()->get('name','kkk'); 
        // session(['name'=>'pppp']);
        // session(['age'=>'17']);
        // request()->session()->flush();
        // $name = request()->session()->all();
        // dd($name);

        $query = request()->all();
        $where = [];
        if($query['brand_name']??''){
            $where[] = ['brand_name','like',"%$query[brand_name]%"];
        }
        if($query['brand_url']??''){
            $where['brand_url'] = $query['brand_url'];
        }
        $pagesize = config('app.pageSize');

        DB::connection()->enableQueryLog();
        $data =  Brands::where($where)->orderBy('brand_id','desc')->paginate($pagesize);
        $logs = DB::getQueryLog();
        // dd($logs);
        return view('brand.list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     * 添加表单页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo 123;
        // $name = session('name');
        // echo $name;
        Cookie::queue('author','学院君',12);
        // echo Cookie::get('author');
        // return response('hi')->cookie('name','1811',12);
        return view('brand.add');
    }

    /**
     * Store a newly created resource in storage.
     * 添加执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // 第二种validate验证
    //public function store(\App\Http\Requests\StoreBrandPost $request)
    public function store(Request $request)
    {
        // 获取所有
        $data = request()->except(['_token','id']);
        // $data = request()->input();
        // $data = request()->all();
        // $data = $request->input();
        // $data = $request->all();
        // dd($data);

        // 第一种validate验证
        // $validatedData = $request->validate([
        //     'brand_name' => 'required|unique:brand|max:10',
        //     'brand_logo' => 'required',
        //     'brand_desc' => 'required',
        //     'brand_url' => 'required',
        // ],[
        //     'brand_name.required' => '品牌名称必填',
        //     'brand_name.unique' => '品牌名称唯一',
        //     'brand_name.max' => '品牌名称最多10个字符',
        //     'brand_logo.required' => '品牌logo必填',
        //     'brand_desc.required' => '品牌描述必填',
        //     'brand_url.required' => '品牌网址必填',
        // ]);

        // 第三种验证
        $validator = \Validator::make($request->all(), [
            'brand_name' => 'required|unique:brand|max:10',
            'brand_logo' => 'required',
            'brand_desc' => 'required',
            'brand_url' => 'required',
        ],[
            'brand_name.required' => '品牌名称必填',
            'brand_name.unique' => '品牌名称唯一',
            'brand_name.max' => '品牌名称最多10个字符',
            'brand_logo.required' => '品牌logo必填',
            'brand_desc.required' => '品牌描述必填',
            'brand_url.required' => '品牌网址必填',
        ]);
        
        if ($validator->fails()) {
            return redirect('brand/add')->withErrors($validator)->withInput();
        }

        // 文件上传
        if($request->hasFile('brand_logo')){
            $res = $this->upload('brand_logo');
            // dd($res);
            if($res['code']){
                $data['brand_logo'] = $res['imgurl'];
            }
        }

        // 入库
        // $res = DB::table('brand')->insert($data);
        $res = Brands::create($data);
        // dd($res);
        if($res){
            return redirect('/brand/list');
        }
    }

    // 文件上传
    public function upload($file){
        if(request()->file($file)->isValid()){
            $photo = request()->file($file);
            $store_result = $photo->store(date('Ymd'));
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程出错'];
        }
    }

    /**
     * Display the specified resource.
     * 展示详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 修改表单页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 修改执行
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * 删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
