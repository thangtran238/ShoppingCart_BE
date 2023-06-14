<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    
    public function Login(Request $request)
    {
    $login =[
        'email' => $request -> input('email'),
        'password' => $request -> input('pw')
    ];
    if (Auth::attempt($login)){
        $user = Auth::user();
        Session::put('user',$user);
        echo '<script> alert("DN THANH CONG");window.location.assign("trangchu");</script>';
    }else{
        echo '<script> alert("DN THAT BAI");window.location.assign("login");</script>';
    }
    }

    public function Logout(){
        Session::forget('user');
        Session::forget('cart');
        return redirect('/trangchu');
    }

    public function Register(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
    
        $input['password'] = bcrypt($input['password']); // Mã hóa mật khẩu
    
        User::create($input);
    
        echo '
        <script>
            alert("Đăng ký thành công. Vui lòng đăng nhập");
            window.location.assign("login");
        </script>
        ';
    
    }
}
