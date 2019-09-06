<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
// 	session(['uid'=>88]);
//     return view('welcome',['name'=>'郑新琪']);
// });

// Route::view('/','welcome',['name'=>'郑新琪']);

//路由闭包请求
// Route::get('/goods', function () {
//     echo '123';
// });

//路由url请求
Route::get('/goods','Goods@index');

Route::get('/from',function(){
	return "<form action='/from_do' method='post'>".csrf_field()."<input type=text name=name><button>提交</button></form>";
});

// Route::post('/from_do',function(){
// 	return request()->name;
// });

// Route::match(['get','post'],'/from_do',function(){
// 	return request()->name;
// });

// Route::any('/from_do',function(){
// 	return request()->name;
// });

//路由传参
Route::get('/goods/{catid}/{id}',function($catid,$id){
	echo $catid.'-'.$id;
});

// Route::get('/goods/{id?}',function($id=4){
// 	echo $id;
// });

//路由重定向
Route::get('/goods/{id?}',function($id=4){
	return redirect('/goods');
})->where('id','\d+');

//正则约束
// Route::get('/goods/{name}',function($name){
// 	return 'hello';
// })->where('name','[A-Za-z]+');


Route::prefix('/brand')->middleware('checklogin')->group(function(){
	Route::get('add','Brand@create');
	Route::post('do_add','Brand@store');
	Route::get('list','Brand@index');
	Route::get('edit/{id}','Brand@edit');
	Route::get('del/{id}','Brand@destroy');
});

Route::prefix('admin/banner')->group(function(){
	Route::get('add','admin\Banner@create');
	Route::post('do_add','admin\Banner@store');
	Route::get('list','admin\Banner@index');
	Route::get('edit/{id}','admin\Banner@edit');
	Route::post('update/{id}','admin\Banner@update');
	Route::post('del/{id}','admin\Banner@destroy');
	Route::post('checkName','admin\Banner@checkName');
});

Route::prefix('admin/user')->group(function(){
	Route::get('add','admin\User@create');
	Route::post('do_add','admin\User@store');
	Route::get('list','admin\User@index');
	Route::get('edit/{id}','admin\User@edit');
	Route::get('del/{id}','admin\User@destroy');
});

Route::prefix('admin/news')->group(function(){
	Route::get('add','admin\News@create');
	Route::post('do_add','admin\News@store');
	Route::get('list','admin\News@index');
	Route::get('edit/{id}','admin\News@edit');
	Route::get('del/{id}','admin\News@destroy');
});

Route::prefix('admin/hood')->group(function(){
	Route::get('add','admin\Hood@create');
	Route::post('do_add','admin\Hood@store');
	Route::get('list','admin\Hood@index');
	Route::get('edit/{id}','admin\Hood@edit');
	Route::get('del/{id}','admin\Hood@destroy');
});

Route::any('/index','admin\Index@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/','Index\IndexController@index');

Route::prefix('index/register')->group(function(){
	Route::get('register','Index\RegisterController@register');
	Route::post('checkEmail','Index\RegisterController@checkEmail');
	Route::post('sendEmail','Index\RegisterController@sendEmail');
	Route::post('registerDo','Index\RegisterController@registerDo');
	Route::get('login','Index\RegisterController@login');
	Route::post('loginDo','Index\RegisterController@loginDo');
});

Route::prefix('index/cart')->group(function(){
	Route::get('cartList','Index\CartController@cartList');
	Route::post('cartListDo','Index\CartController@cartListDo');
	Route::post('getCount','Index\CartController@getCount');
});

Route::prefix('/index')->group(function(){
	Route::get('user','Index\IndexController@user');
	Route::get('goodsDetail','Index\IndexController@goodsDetail');
	Route::get('goodsList','Index\IndexController@goodsList');
	Route::post('comment','Index\IndexController@comment');
});

