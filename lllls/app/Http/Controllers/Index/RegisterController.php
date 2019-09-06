<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RegisterController extends Controller
{
    public function register(){
    	return view('index.register.register');
    }

    public function checkEmail(){
    	$email = request()->email;
    	// dd($email);
    	$reg1 = '/^\w+@\w+\.com$||^1[34578]\d{9}$/';
        // $reg2 = '//';
    	if(!preg_match($reg1,$email)){
    		return ['code'=>0,'msg'=>'请输入正确格式'];
    	}else{
    		$data = DB::table('register')->where('u_email',$email)->count();
    		if($data>0){
    			return ['code'=>0,'msg'=>'账户已存在'];
    		}else{
    			return ['code'=>1,'msg'=>'√'];
    		}
    	}
    }

    public function sendEmail(){
        $email = request()->email;
        // dd($email);
        if(preg_match('/^\w+@\w+\.com$/',$email)){
        	$count = DB::table('register')->where('u_email',$email)->count();
            // dd($count);
        	if($count){
        		return ['code'=>0,'msg'=>'账户已存在'];
        	}

        	$rand = rand(1000,9999);
            // dd($rand);
        	session(['emailInfo'=>['u_email'=>$email,'u_code'=>$rand,'create_time'=>time()]]);
            // $emailInfo = session('emailInfo');
            // dd($emailInfo);
        	$this->send($email,$rand);
        }else if(preg_match('/^1[34578]\d{9}$/',$email)){
            $message = rand(1000,9999);
            session(['emailInfo'=>['u_email'=>$email,'u_code'=>$message,'create_time'=>time()]]);
            // $message = "欢迎注册珠宝公司，您的验证码是【".$code."】";
            // dd($message);
            $this->sendSms($email,$message);
        }
    }

    public function sendSms($email,$message){
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "1a7ee2f909d54738aedc999120662e20";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile=$email&param=code%3A$message&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
// dd($url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data = curl_exec($curl);
        return $data;
    }

    public function send($email,$rand){
        \Mail::raw($rand,function($message)use($email){
            // 设置主题
            $message->subject('欢迎注册TESIRO珠宝公司');
            // 设置接收方
            $message->to($email);
        });
    }

    public function registerDo(){
        $u_email = request()->u_email;
        $u_pwd = request()->u_pwd;
        $confirm = request()->confirm;
        $u_code = request()->u_code;
        // dd($u_code);

        $value = request()->session()->get('emailInfo', 'default');
        // dd($value['u_code']);
        if($value['u_code'] != $u_code){
            return ['code'=>2,'msg'=>'验证码错误'];exit;
        }

        $data['u_email'] = $u_email;
        $data['confirm'] = $confirm;
        $data['u_pwd'] = $u_pwd;
        $data['u_code'] = $u_code;
        $data['create_time'] = $value['create_time'];
        $res = DB::table('register')->insert($data);
        if($res){
            return ['code'=>1,'msg'=>'注册成功'];exit;
        }else{
            return ['code'=>2,'msg'=>'注册失败'];exit;
        }
    }

    public function login(){
        return view('index.register.login');
    }

    public function loginDo(){
        $u_email = request()->u_email;
        $u_pwd = request()->u_pwd;
        // dd($u_email);
        // dd($u_pwd);
        $data = DB::table('register')->where('u_email',$u_email)->first();
        // dd($data->u_email);
        if(($data->u_email) == $u_email){
            if(($data->u_pwd) == $u_pwd){
                return ['code'=>1,'msg'=>'登陆成功'];
            }else{
                return ['code'=>2,'msg'=>'登录失败'];
            }
        }
    }
}
