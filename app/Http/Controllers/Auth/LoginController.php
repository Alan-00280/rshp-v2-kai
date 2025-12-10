<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    // protected function authenticated(Request $request, $user)
    // {
    //     // $userRole = $user->roleUsers()->first()->role->idrole;
    //     // $userRoleName = $user->roleUsers()->first()->role->nama_role;

    //     dd($user);

    //     $namaRole = Role::where('idrole', $user->roleUser[0]->idrole ?? null)->first();

    //      $userRole = $user->roleUser[0]->idrole ?? null;

    //     $userRoleName = $namaRole->nama_role ?? 'User';

    //     switch ($userRole) {
    //         case '1':
    //             return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
    //         case '2':
    //             return redirect()->route('dokter.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
    //         case '3':
    //             return redirect()->route('admin.dashboard-perawat')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
    //         case '4':
    //             return redirect()->route('resepsionis.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
    //         default:
    //             return redirect()->route('pemilik.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
    //     }
    
    // }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::with(['roleUser' => function($query){
            $query->where('status', 1);    
        }, 'roleUser.role'])
        ->where('email',$request->input('email'))
        ->first();

        if (!$user){
            return redirect()->back()
            ->withErrors(['email' => ' Email tidak ditemukan. Silakan coba lagi.'])
            ->withInput();
        }
        
        // Cek password
        if (!\Hash::check($request->password, $user->password)){
            return redirect()->back()
            ->withErrors(['password' => ' Password salah. Silakan coba lagi.'])
            ->withInput();
        }

        $namaRole = Role::where('idrole', $user->roleUser[0]->idrole ?? null)->first();

        // Login user ke session
        Auth::login($user);

        // simpan session user
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $user->roleUser[0]->idrole ?? 'user',
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $user->roleUser[0]->status ?? 'active',
        ]);

        $userRole = $user->roleUser[0]->idrole ?? null;

        $userRoleName = $namaRole->nama_role ?? 'User';

        switch ($userRole) {
            case '1':
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
            case '2':
                return redirect()->route('dokter.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
            case '3':
                return redirect()->route('admin.dashboard-perawat')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
            case '4':
                return redirect()->route('resepsionis.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
            default:
                return redirect()->route('pemilik.dashboard')->with('success', 'Selamat datang, ' . $user->nama . '! Anda login sebagai ' . $userRoleName . '.');
        }
    
    }
    Public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
