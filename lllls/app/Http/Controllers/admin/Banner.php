<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin\Banners;
use DB;
use Illuminate\Validation\Rule;

class Banner extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagesize = config('app.pageSize');
        $data = Banners::paginate($pagesize);
        return view('admin.banner.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','id');
        // dd($data);

        $validator = \Validator::make($request->all(), [
            'banner_name' => 'required|unique:banner|max:10',
            'banner_sort' => 'required',
            'banner_url' => 'required',
            'banner_img' => 'required',
            'banner_status' => 'required',
        ],[
            'banner_name.required' => '链接名称必填',
            'banner_name.unique' => '链接名称唯一',
            'banner_name.max' => '链接名称最多10个字符',
            'banner_sort.required' => '链接排序必填',
            'banner_url.required' => '链接网址必填',
            'banner_img.required' => '链接图片必填',
            'banner_status.required' => '链接状态必填',
        ]);

        if ($validator->fails()) {
            return redirect('admin/banner/add')->withErrors($validator)->withInput();
        }

        // dd($request->hasFile('banner_img'));

        if($request->hasFile('banner_img')){
            $res = $this->upload($request,'banner_img');
            // dd($res);
            if($res['code']){
                $data['banner_img'] = $res['imgurl'];
            }
        }

        $res = Banners::create($data);
        if($res){
            return redirect('/admin/banner/list');
        }
    }

     // 文件上传
    public function upload(Request $request,$file){
        if($request->file($file)->isValid()){
            $photo = $request->file($file);
            $store_result = $photo->store(date('Ymd'));
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程出错'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data = DB::table('banner')->where('banner_id',$id)->first();
        $data = Banners::find($id);
        // dd($data);
        return view('admin.banner.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        // dd($data);

        $validator = \Validator::make($data, [
            'banner_name' => [
                'required',
                'max:10',
                Rule::unique('banner')->ignore($id,'banner_id'),
            ],
        ],[
            'banner_name.required' => '链接名称必填',
            'banner_name.unique' => '链接名称唯一',
            'banner_name.max' => '链接名称最多10个字符',
        ]);

        if ($validator->fails()) {
            return redirect('admin/banner/edit/'.$id)->withErrors($validator)->withInput();
        }


        if($request->hasFile('banner_img')){
            $res = $this->upload($request,'banner_img');
            // dd($res);
            if($res['code']){
                $data['banner_img'] = $res['imgurl'];
            }
        }

        $res = Banners::where('banner_id',$id)->update($data);
        // dd($res);
        if($res){
            return redirect('/admin/banner/list');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Banners::destroy($id);
        if($res){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>2,'msg'=>'删除失败'];
        }
    }

    // 检查名称唯一性
    public function checkName(Request $request){
        $banner_name = $request->banner_name;
        // dd($banner_name);
        if($banner_name){
            $where['banner_name'] = $banner_name;
            $count = Banners::where($where)->count();
            return ['code'=>1,'count'=>$count];
        }
    }
}
