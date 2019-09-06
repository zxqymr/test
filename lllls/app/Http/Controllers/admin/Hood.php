<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\admin\Hoods;

class Hood extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = request()->all();
        $where = [];
        if($query['age_name']??''){
            $where['age_name'] = $query['age_name'];
        }
        if($query['audit_status']??''){
            $where['audit_status'] = $query['audit_status'];
        }
        if($query['is_recommend']??''){
            $where['is_recommend'] = $query['is_recommend'];
        }
        if($query['hood_name']??''){
            $where[] = ['hood_name','like',"%$query[hood_name]%"];
        }
        $res = DB::table('age')->get();
        $pagesize = config('app.pageSize');
        $data = Hoods::where($where)->paginate($pagesize);
        return view('admin.hood.list',['data'=>$data,'res'=>$res,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = DB::table('age')->get();
        return view('admin.hood.add',['res'=>$res]);
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
            'hood_name' => 'required|unique:hood',
        ],[
            'hood_name.required' => '链接名称必填',
            'hood_name.unique' => '链接名称唯一',
        ]);

        if ($validator->fails()) {
            return redirect('admin/hood/add')->withErrors($validator)->withInput();
        }
        if($request->hasFile('hood_img')){
            $res = $this->upload($request,'hood_img');
            // dd($res);
            if($res['code']){
                $data['hood_img'] = $res['imgurl'];
            }
        }
        $data = Hoods::create($data);
        if($data){
            return redirect('/admin/hood/list');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
