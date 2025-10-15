<x-guest-layout class=" ">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br px-6 py-12">
        <!-- Card -->
        <div class="relative w-full max-w-md bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-white/10">

            <!-- Logo -->
            <div class="flex flex-col items-center">
                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                    alt="Logo da Empresa"
                    class="h-12 w-auto drop-shadow-lg" />
                <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-white">
                    Bem-vindo de volta 👋
                </h2>
                <p class="text-gray-400 text-sm mt-2">Entre com suas credenciais para continuar</p>
            </div>

            <!-- Formulário -->
            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

             
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white mb-1" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username"
                        class="block w-full rounded-xl bg-white/10 border border-white/20 px-4 py-2 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <x-input-label for="password" :value="__('Senha')" class="text-sm font-medium text-white" />
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-indigo-400 hover:text-indigo-300 transition">
                                Esqueceu?
                            </a>
                        @endif
                    </div>
                    <x-text-input id="password" type="password" name="password" required
                        autocomplete="current-password"
                        class="block w-full rounded-xl bg-white/10 border border-white/20 px-4 py-2 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400" />
                </div>

            

                <!-- Botão -->
                <div>
                    <x-primary-button
                        class="w-full justify-center rounded-xl bg-indigo-600 py-2.5 text-sm font-semibold text-white shadow-lg hover:bg-indigo-500 hover:shadow-indigo-500/40 focus:ring-2 focus:ring-indigo-400 transition">
                        {{ __('Entrar') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Rodapé -->
            <p class="mt-6 text-center text-sm text-gray-400">
                Não tem uma conta?
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">
                    Cadastre-se
                </a>
            </p>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</x-guest-layout>
