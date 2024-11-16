<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthenController extends Controller
{
    public function formDangKy()
    {
        return view('admin.auth.register');
    }

    public function dangKy()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::query()->create($data);

        $member = Role::firstOrCreate(['name' => 'member']);

        $user->roles()->attach($member->id);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function formDangNhap()
    {

        return view('admin.auth.login');
    }

    // public function dangNhap()
    // {
    //     // In ra dữ liệu để kiểm tra
    //     $nguoidung = request()->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // dd($nguoidung);

    //     // Thực hiện đăng nhập
    //     if (Auth::attempt($nguoidung)) {
    //         request()->session()->regenerate();

    //         $user = Auth::user();

    //         /**
    //          * @var User $user
    //          */

    //         if ($user->admin()) {
    //             return redirect()->route('admin.dashboard');
    //         } else {
    //             return redirect()->route('home');
    //         }
    //     }

    //     // Nếu đăng nhập thất bại, hiển thị lỗi
    //     return back()->withErrors([
    //         'email' => 'Email không chính xác hoặc mật khẩu không đúng.',
    //     ])->withInput();
    // }

    public function dangNhap()
    {
        // Xác thực dữ liệu đầu vào
        $nguoidung = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Thực hiện đăng nhập
        if (Auth::attempt($nguoidung)) {
            // Đăng nhập thành công, tạo lại session
            request()->session()->regenerate();

            // Lấy thông tin người dùng
            $user = Auth::user();

            // Kiểm tra quyền admin và chuyển hướng
            if ($user->admin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        // Nếu đăng nhập thất bại, trả về thông báo lỗi
        return back()->withErrors([
            'email' => 'Email không chính xác hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    public function dangXuat()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('home');
    }

    //đăng nhập bằng google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('/');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);
                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // đăng nhập bằng facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'facebook_id'=> $user->id,
                        'password' => encrypt('123456dummy')

                    ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {

            dd($e->getMessage());
        }
    }

    // đăng nhập bằng twitter
    public function redirectToTwitter()
    {

        return Socialite::driver('twitter')->redirect();

    }
    
    public function handleTwitterCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
            $finduser = User::where('twitter_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');

            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'Twitter_id'=> $user->id,
                        'password' => encrypt('123456dummy')
                    ]);
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
