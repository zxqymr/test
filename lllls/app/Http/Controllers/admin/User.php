<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin\Users;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagesize = config('app.pageSize');
        $data = Users::paginate($pagesize);
        return view('admin.user.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
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
            'user_name' => 'required|unique:user|max:10',
            'user_pwd' => 'required',
            'user_rand' => 'required',
        ],[
            'user_name.required' => '管理员名称必填',
            'user_name.unique' => '管理员名称唯一',
            'user_name.max' => '管理员名称最多10个字符',
            'user_pwd.required' => '密码必填',
            'user_rand.required' => '会员等级必填',
        ]);

        if ($validator->fails()) {
            return redirect('admin/user/add')->withErrors($validator)->withInput();
        }

        $res = Users::create($data);
        if($res){
            return redirect('/admin/user/list');
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
