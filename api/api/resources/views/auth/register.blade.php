<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- Logo -->
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                alt="Logo da Empresa"
                class="h-12 w-auto mx-auto drop-shadow-lg" />

            <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-white">
                Crie sua conta ✨
            </h2>
            <p class="text-gray-400 text-sm text-center mt-2">
                Preencha os dados abaixo para se cadastrar
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl p-8 border border-white/10">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Nome -->
                    <div>
                        <x-input-label for="name" :value="__('Nome')" class="block text-sm font-medium text-white mb-1" />
                        <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name"
                            class="block w-full rounded-xl bg-white/10 border border-white/20 px-4 py-2 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-white mb-1" />
                        <x-text-input id="email" name="email" type="email" :value="old('email')" required autocomplete="username"
                            class="block w-full rounded-xl bg-white/10 border border-white/20 px-4 py-2 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400" />
                    </div>

                    <!-- Senha -->
                    <div>
                        <x-input-label for="password" :value="__('Senha')" class="block text-sm font-medium text-white mb-1" />
                        <x-text-input id="password" name="password" type="password" required autocomplete="new-password"
                            class="block w-full rounded-xl bg-white/10 border border-white/20 px-4 py-2 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400" />
                    </div>

                    <!-- Confirmar Senha -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="block text-sm font-medium text-white mb-1" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                            class="block w-full rounded-xl bg-white/10 border border-white/20 px-4 py-2 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-400" />
                    </div>

                    <!-- Botão -->
                    <div>
                        <x-primary-button
                            class="w-full justify-center rounded-xl bg-indigo-600 py-2.5 text-sm font-semibold text-white shadow-lg hover:bg-indigo-500 hover:shadow-indigo-500/40 focus:ring-2 focus:ring-indigo-400 transition">
                            {{ __('Cadastrar') }}
                        </x-primary-button>
                    </div>
                </form>

                <p class="mt-6 text-center text-sm text-gray-400">
                    Já tem uma conta?
                    <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">
                        Entrar
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</x-guest-layout>
