{{-- resources/views/client/auth/verification.blade.php --}}
@extends('client.core.client')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <div class="w-20 h-20 bg-yellow-500 rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-[#0a2b1f]">
                Verifique seu e-mail
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enviamos um link de confirmação para
                <span class="font-medium text-[#0d9488]">{{ session('email') ?? $email }}</span>
            </p>
        </div>
        
        <div class="bg-green-50 border border-green-400 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">
                        Confirme seu e-mail clicando no link que enviamos para você.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Não recebeu o e-mail?
                <button type="button" onclick="resendVerification()" 
                        class="font-medium text-[#0d9488] hover:text-[#0a2b1f]">
                    Reenviar e-mail de confirmação
                </button>
            </p>
        </div>
        
        <div class="border-t border-gray-200 pt-4">
            <div class="flex items-center justify-center">
                <div class="text-sm">
                    <a href="{{ route('login') }}" class="font-medium text-[#0d9488] hover:text-[#0a2b1f]">
                        ← Voltar para o login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
function resendVerification() {
    fetch('{{ route("verification.resend") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Novo link de verificação enviado para seu e-mail!');
        }
    });
}
</script> --}}
@endsection

{{-- Tela de conta ativada com sucesso --}}
@extends('client.core.client')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <div class="flex justify-center">
                <div class="w-20 h-20 bg-[#0d9488] rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-[#0a2b1f]">
                Conta Ativada!
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Sua conta foi verificada com sucesso.
            </p>
        </div>
        
        <div class="bg-green-50 border border-green-400 rounded-md p-4">
            <p class="text-sm text-green-700 text-center">
                Agora você precisa completar seu cadastro para acessar todos os serviços.
            </p>
        </div>
        
        <div>
            {{-- {{ route('complement-registration') }} --}}
            <a href="" 
               class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#0d9488] hover:bg-[#0a2b1f] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0d9488] transition-colors duration-200">
                Continuar para complementação cadastral
            </a>
        </div>
    </div>
</div>
@endsection