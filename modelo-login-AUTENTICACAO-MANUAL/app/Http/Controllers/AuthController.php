<?php

namespace App\Http\Controllers;

use App\Mail\NewUserConfirmation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use illuminate\Support\Str;



class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // echo "Autenticado";
        // dd($request->email );

        $credentials = $request->validate(
            [
                'username' => 'required|min:3|max:30',
                'password' => 'required|min:6|max:32',
                // 'password' => 'required|min:6|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            [
                'username.required' => 'O usuário é obrigatório',
                'username.min' => 'O usuário deve ter no minímo :min caracteres',
                'username.max' => 'O usuário deve ter no minímo :max caracteres',

                'password.required' => 'O campo senha é obrigatório',
                'password.min' => 'A senha deve ter no minímo :min caracteres',
                'password.max' => 'A senha deve ter no máximo :max caracteres',
                // 'password.regex' => 'A senha deve conter pelo menos uma letra minúscula, uma letra maiúscula e um número'


            ]
        );

        // Verificar se existe o user
        $user = User::where('username', $credentials['username'])
            ->where('active', true)
            ->where(function ($query) {
                $query->whereNull('blocked_until')
                    ->orWhere('blocked_until', '<=', now());
            })
            ->whereNotNull('email_verified_at')
            ->whereNull('deleted_at')
            ->first();


        if (!$user) {
            return back()->withInput()->with([
                'invalid_login' => 'Login Inválido'
            ]);
        }

        // Verificar se a password é válida
        if (!password_verify($credentials['password'], $user->password)) {
            return back()->withInput()->with([
                'invalid_login' => 'Login Inválido'
            ]);
        }

        // Atualizando o ultimo login
        $user->last_login = now();
        $user->blocked_until = null;
        $user->save();

        // Logando e permanecendo na sessão com os dados do usuário
        $request->session()->regenerate();
        Auth::login($user);

        // Redirecionando
        return redirect()->intended(route('home', ['user' => $user]));
    }
    // Deslogando
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Redirecionando para register view
    public function register()
    {
        return view('auth.register');
    }

    // Função para cadastrar um novo usuário
    public function store_user(Request $request)
    {

        // dd($request);
        // form validation
        $request->validate(
            [
                'username' => 'required|min:3|max:30|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:32',

                'password_confirmation' => 'required|same:password',

                // 'password' => 'required|min:6|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            [
                'username.required' => 'O usuário é obrigatório',
                'username.unique' => 'Esse usuário não é válido',
                'username.min' => 'O usuário deve ter no minímo :min caracteres',
                'username.max' => 'O usuário deve ter no minímo :max caracteres',

                'email.required' => 'O email é obrigatório',
                'email.unique' => 'O email não é valido',


                'password.required' => 'O campo senha é obrigatório',
                'password.min' => 'A senha deve ter no minímo :min caracteres',
                'password.max' => 'A senha deve ter no máximo :max caracteres',
                // 'password.regex' => 'A senha deve conter pelo menos uma letra minúscula, uma letra maiúscula e um número'

                'password_confirmation.required' => 'O campo senha é obrigatório',
                'password_confirmation.same' => 'As senhas devem ser iguais',
                // 'password_confirmation.max' => 'A senha deve ter no máximo :max caracteres',
                // 'password.regex' => 'A senha deve conter pelo menos uma letra minúscula, uma letra maiúscula e um número'


            ]
        );





        // Definir novo usuário e criar o token para soliciar a confirmação de email
        $user = new User(); //model
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->token = Str::random(64);

        // Verificar se já tem os dados 
        // dd('teste');

        // Gerar link para confirmar o email
        $confirm_link = route('new_user_confirmation', ['token' => $user->token]);
        // 
        // dd($confirm_link);
        // Enviar o email
        // Mail::to('ftreitasyuri@gmail.com')->send(new NewUserConfirmation($user->username, $confirm_link));
        $resultEmail = Mail::to($user->email)->send(new NewUserConfirmation($user->username, $confirm_link));



        // dd($user->email);        
        // Verificar se o email foi enviado
        if (!$resultEmail) {
            return back()->withInput()->with([
                'server_error' => 'Ocorreu um erro ao tentar enviar o e-mail!'
            ]);
        }

        // Criar o usuário
        $user->save();

        $testeUser = User::find($user->id);
        // dd($testeUser->email);

        // Apresentar view de sucess

        return view('auth.emailEnviado', compact('user'));
    }

    public function new_user_confirmation($token)
    {
        // echo "Confirme fdsfdsf";
        // Verificar se o token é válido
        $user = User::where('token', $token)->first();

        if(!$user){
            return redirect()->route('login');
        }

        // Confirmar o registro do usuário

        $user->email_verified_at = Carbon::now();
        $user->token = null;
        $user->active = true;
        $user->save();

        // Autenticação automática do usuário
        // Auth::login($user);

        // Apresentar uma mensagem de sucesso
        // return view('auth.userConfirmation');
        return view('auth.login');

    }
}
