<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\admin\Newss;

class News extends Controller
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
        if($query['cate_id']??''){
            $where['cate_id'] = $query['cate_id'];
        }
        if($query['news_title']??''){
            $where[] = ['news_title','like',"%$query[news_title]%"];
        }
        $pagesize = config('app.pageSize');
        $data = Newss::where($where)->paginate($pagesize);
        $res = DB::table('cate')->get();
        return view('admin.news.list',['data'=>$data,'res'=>$res,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $res = DB::table('cate')->get();
        return view('admin.news.add',['res'=>$res]);
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
            'news_title' => 'required|unique:news',
            'news_major' => 'required',
            'is_show' => 'required',
        ],[
            'news_title.required' => '文章名称必填',
            'news_title.unique' => '文章名称唯一',
            'news_major.required' => '文章重要性必填',
            'is_show.required' => '是否显示必填',
        ]);

        if ($validator->fails()) {
            return redirect('admin/news/add')->withErrors($validator)->withInput();
        }

        if($request->hasFile('news_logo')){
            $res = $this->upload($request,'news_logo');
            // dd($res);
            if($res['code']){
                $data['news_logo'] = $res['imgurl'];
            }
        }
        $res = Newss::create($data);
        if($res){
            return redirect('/admin/news/list');
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
