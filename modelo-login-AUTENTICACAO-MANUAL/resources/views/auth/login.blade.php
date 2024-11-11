<x-layouts.main-layout pageTitle="Login">
    {{-- Página padrão --}}
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-6">
                   
                    <h1>TESTANDO VIEW</h1>
                    <form action="{{ route('authenticate') }}" method="post" novalidate>
                        @csrf
                        <p class="display-6 text-center">LOGIN</p>
                        <div class="mb-3">
                            <label for="username">Usuário</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}">
                            @error('username')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
    
                        <div class="mt-4 d-flex justify-content-between">
                            <div>
                                <a href="{{route('register')}}">Ainda não tem conta?</a>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-secondary px-5">LOGIN</button>
                            </div>
                        </div>
                    </form>

                    {{-- Erros que podemos guardar na sessao --}}
                    @if (session('invalid_login'))
                    
                    <div class="alert alert-danger text-center mt-4">
                            {{-- {{session('invalid_login')}} --}}
                            <p>{{ session('invalid_login') }}</p>
                            
                    </div>
                        
                    @endif


    
                   </div>
            </div>
        </div>
    
</x-layouts.main-layout>