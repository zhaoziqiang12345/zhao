<?php

namespace app\http\middleware;

class CheckLogin
{
	use \traits\controller\Jump;
   
    public function handle($request, \Closure $next)
    {
    	if(empty(session('homeFlag'))){
    		session('back',$_SERVER['REQUEST_URI']);
    		return $this->error('请登录..','/login');
    	}

    	return $next($request);
    }
}
