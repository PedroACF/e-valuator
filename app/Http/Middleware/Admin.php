<?php

namespace EV\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next)
    {
        switch($this->auth->user()->role)
        {
            case 'ADMIN':
                //return redirect()->to('admin');
                break;
            case 'USER':
                return redirect()->to('user');
                break;
            default:
                return redirect()->to('login');
                break;
        }
        return $next($request);
    }
}
