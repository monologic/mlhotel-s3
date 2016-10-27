<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Hotel;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'usuario';
    //protected $redirectAfterLogout = 'login';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    protected function authenticated()
    {   
        if (Auth::user()->activo == 0) {
            return redirect('logout');
        }
        else{
            Auth::user()->usuariotipo;
            if (Auth::user()->usuariotipo->nombre != "Root") {
                Auth::user()->empleado;
                Auth::user()->empleado->hotel;
            }
            $ruta = $_SERVER['HTTP_HOST'];
            $h = Hotel::all();
            if (count($h) > 0) {
                $nombre = urlencode($h[0]->nombre);
                $dir = urlencode($h[0]->direccion);
                return redirect()->away('http://sykver.runait.com/verification/'.$nombre.'/'.$dir.'/'.$ruta);
            }
            else
                return redirect()->intended($this->redirectPath());
        }
    }
}
