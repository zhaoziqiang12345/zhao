<?php
	
namespace app\admin\behavior;

class CheckLogin
{
	use \traits\controller\Jump;

	public function run()
	{
		if(empty(session('adminFlag'))){
			return $this->error('未登录','login/login');
		}
	}
}