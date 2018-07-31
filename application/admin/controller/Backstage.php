<?php
namespace app\admin\controller;
use \think\Controller;
use \think\Request;
use \think\Session;

class Backstage extends Controller
{
	public function index()
	{
		return $this -> fetch();
	}

	public function welcome()
	{
		return $this -> fetch();
	}
}
