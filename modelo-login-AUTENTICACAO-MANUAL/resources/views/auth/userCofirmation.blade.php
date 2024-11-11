<x-layouts.main-layout pageTitle="Confirmação de Cadastro">
    
        <div class="container mt-5">
            <div class="row">
                <div class="card p-5 text-center">
                    <p class="display-6">A sua conta de usuároi foi confirmada com sucess.</p>
                    <p class="display-6 text-info fw-bold">Bem vindo(a), {{Auth::user()->username}}</p>
                    
                    <div class="mt-5">
                        <a href="{{ route('home') }}" class="btn tbn-secondary px-5">Ir para home</a>
                    </div>
                </div>
            </div>
        </div>
    
</x-layouts.main-layout>
