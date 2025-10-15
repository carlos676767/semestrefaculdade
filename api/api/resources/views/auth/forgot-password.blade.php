<x-guest-layout>
    <div class="flex min-h-screen flex-col justify-center px-6 py-12 bg-gradient-to-br from-gray-900 via-gray-800 to-indigo-900">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-center">
            <img class="mx-auto h-12 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Logo">
            <h2 class="mt-6 text-3xl font-extrabold tracking-tight text-white">
                Esqueceu a senha?
            </h2>
            <p class="mt-2 text-sm text-gray-300">
                Digite seu e-mail e enviaremos um link para redefinir sua senha
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white/10 backdrop-blur-xl shadow-lg rounded-2xl px-8 py-6">
                
                <!-- Status da Sessão -->
                <x-auth-session-status class="mb-4 text-sm text-green-400" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-200">E-mail</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="mt-1 w-full rounded-lg bg-gray-900/40 border border-gray-700 text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Botão -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            Enviar Link de Redefinição
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-gray-400">
                    Lembrou sua senha? 
                    <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">
                        Entrar
                    </a>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</x-guest-layout>
