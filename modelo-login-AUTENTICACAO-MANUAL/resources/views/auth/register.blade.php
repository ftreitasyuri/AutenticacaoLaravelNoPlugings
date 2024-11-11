<x-layouts.main-layout pageTitle="Login">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <p class="display-6 text-center">
                    Cadastrar novo Usuário
                </p>
                <form action="{{route('store_user')}}" method="POST" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="alert alert-danger text-center mt-3">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="alert alert-danger text-center mt-3">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <div class="alert alert-danger text-center mt-3">{{$message}}</div>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="alert alert-danger text-center mt-3">{{$message}}</div>
                        @enderror

                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <div class="mb-3">
                                <a href="{{ route('login') }}">Já tenho conta de usuário</a><br>
                                {{-- <a href="{{ route('login') }}">Logar</a> --}}
                            </div>
                        </div>
                    </div>

                    <div class=" d-flex justify-content-center"><button type="submit"
                            class="btn btn-dark px-5">Criar acesso</button></div>
                </form>

                {{-- Se existir essa variavel --}}
                @if (session('server_error'))
                    <div class="alert alert-danger text-center mt-3">
                        {{session('server_error')}}
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-layouts.main-layout>