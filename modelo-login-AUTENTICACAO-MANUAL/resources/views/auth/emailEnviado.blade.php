<x-layouts.main-layout pageTitle="Email-Enviado">
 
        <div class="container mt-5">
            <div class="row">
                <div class="card p-5 text-center">
                    <p class="display-6">Foi enviado um email de confirmação para:</p>
                    <p class="display-6 text-info fw-bold">{{$user->email}}</p>
                    <p>Por favor confirme no link existente nesse email para poder concluir o seu registro.</p>
                    <div class="mt-5">
                        <a href="{{ route('login') }}" class="btn tbn-secondary px-5">Login</a>
                    </div>
                </div>
            </div>
        </div>
    
</x-layouts.main-layout>
