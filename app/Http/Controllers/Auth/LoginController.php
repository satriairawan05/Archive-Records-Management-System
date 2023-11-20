<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Constructor for LoginController.
     */
    public function __construct(private $validated = null, private $name = "")
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Display a form for a new User.
     */
    public function showRegisterForm(): \Illuminate\View\View
    {
        $this->name = 'Register Account!';
        return view('auth.register', [
            'name' => $this->name
        ]);
    }

    /**
     * Process Register for a new User.
     */
    public function register(Request $request)
    {
        $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!$validated->fails()) {
            try {
                \App\Models\User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                ]);

                \Illuminate\Support\Facades\Log::info('User dengan nama ' . $request->input('name') . 'berhasil di buat!');

                return redirect()->route('home');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('register')->with('loginError', $e->getMessage());
            }
        } else {
            return redirect()->route('register')->with('loginError', $validated->getMessageBag());
        }
    }

    /**
     * Display a listing for User of the resource.
     */
    public function showLoginForm(): \Illuminate\View\View
    {
        $this->name = 'Login to your Account!';
        return view('auth.login', [
            'name' => $this->name
        ]);
    }

    /**
     * Process login for User.
     */
    public function login(Request $request)
    {
        $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email'   => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if (!$validated->fails()) {
            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {

                \Illuminate\Support\Facades\Log::info('User dengan email ' . $request->input('email') . 'berhasil di login!');

                return redirect()->route('home');
            }
            return redirect()->route('login')->with('loginError', 'Email atau Password salah');
        } else {
            return redirect()->route('login')->with('loginError', $validated->getMessageBag());
        }
    }

    /**
     * Process logout for User.
     */
    public function logout(Request $request)
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            \Illuminate\Support\Facades\Auth::logout();

            \Illuminate\Support\Facades\Log::info('User berhasil di logout!');

            return redirect()->route('login');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('login');
    }
}
