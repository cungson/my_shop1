<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \think\Session;

class Login extends Controller
{

    public function login(Request $request)
    {
    	if( $request -> isPost() ){

    		$code = $request -> param('code');
    		$admin_name = $request -> param('admin_name');
    		$password = $request -> param('password');
    		
    		if(!captcha_check($code)){
    			Session::set('error','验证码错误!');
				$this -> redirect( 'login/login' );
			};

			$adminInfo = Db('admin') -> where( ['admin_name'=>$admin_name] ) -> find();
			if( empty($adminInfo) || $adminInfo['password'] != md5($password) ){
				Session::set('error','账户名或密码错误!');
				$this -> redirect('login/login');
			}

			Session::set('admin_info',$adminInfo);
			Session::set('admin_id',$adminInfo['admin_id']);
			Session::delete('error');
			$this -> redirect('login/login');

    	}else{
     		return $this -> fetch();
     	}
	}

	public function logout()
	{
		Session::delete('admin_info');
		Session::delete('admin_id');
		$this -> redirect('login/login');
	}

	public function clear()
	{
		Session::delete('error');
	}

}
