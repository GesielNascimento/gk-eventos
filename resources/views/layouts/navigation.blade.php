<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Menu desktop -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('events.my')" :active="request()->routeIs('events.my')">
                        Minhas Inscrições
                    </x-nav-link>

                    <x-nav-link href="{{ url('/public-events') }}">
                        Eventos Públicos
                    </x-nav-link>

                    {{-- Dropdown de Categorias --}}
                    @php
                        use App\Models\Category;
                        $categories = $categories ?? Category::all();
                    @endphp

                    @if ($categories && $categories->count())
                        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
                            <button @mouseover="open = true" class="hover:text-blue-300 flex items-center gap-1">
                                Categorias
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" class="absolute bg-white border mt-2 rounded shadow-md z-10 w-48">
                                @foreach ($categories as $category)
                                    @if ($category->slug)
                                        <a href="{{ route('categories.showBySlug', ['slug' => $category->slug]) }}"
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-100">
                                            {{ $category->name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Área do usuário -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="fill-current h-4 w-4 ml-1" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Perfil
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    Sair
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">Entrar</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">Cadastrar</a>
                @endauth
            </div>

            <!-- Mobile hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('events.my')" :active="request()->routeIs('events.my')">
                Minhas Inscrições
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ url('/public-events') }}">
                Eventos Públicos
            </x-responsive-nav-link>

            <!-- Categorias -->
            @if ($categories && $categories->count())
                <div class="border-t border-gray-200 mt-2 pt-2">
                    <div class="px-4 font-semibold text-gray-600">Categorias</div>
                    @foreach ($categories as $category)
                        @if ($category->slug)
                            <x-responsive-nav-link :href="route('categories.showBySlug', ['slug' => $category->slug])">
                                {{ $category->name }}
                            </x-responsive-nav-link>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Usuário mobile -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        Perfil
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            Sair
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 text-gray-500 dark:text-gray-300">Visitante</div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">Entrar</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Cadastrar</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
