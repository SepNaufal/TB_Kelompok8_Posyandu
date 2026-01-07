<nav x-data="{ open: false }" class="bg-gradient-to-r from-green-600 to-teal-600 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-white">Posyandu</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:bg-white/20 rounded-md transition {{ request()->routeIs('dashboard') ? 'bg-white/20' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('balita.index') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:bg-white/20 rounded-md transition {{ request()->routeIs('balita.*') ? 'bg-white/20' : '' }}">
                        Balita
                    </a>
                    <a href="{{ route('ibu-hamil.index') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:bg-white/20 rounded-md transition {{ request()->routeIs('ibu-hamil.*') ? 'bg-white/20' : '' }}">
                        Ibu Hamil
                    </a>
                    <a href="{{ route('lansia.index') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:bg-white/20 rounded-md transition {{ request()->routeIs('lansia.*') ? 'bg-white/20' : '' }}">
                        Lansia
                    </a>
                    <a href="{{ route('kader.index') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:bg-white/20 rounded-md transition {{ request()->routeIs('kader.*') ? 'bg-white/20' : '' }}">
                        Kader
                    </a>
                    <a href="{{ route('jadwal.index') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:bg-white/20 rounded-md transition {{ request()->routeIs('jadwal.*') ? 'bg-white/20' : '' }}">
                        Jadwal
                    </a>
                    <a href="{{ route('catatan.index') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white hover:bg-white/20 rounded-md transition {{ request()->routeIs('catatan.*') ? 'bg-white/20' : '' }}">
                        Catatan
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:bg-white/20 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white/20 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-green-700">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2 text-white hover:bg-white/20 {{ request()->routeIs('dashboard') ? 'bg-white/20' : '' }}">Dashboard</a>
            <a href="{{ route('balita.index') }}"
                class="block px-4 py-2 text-white hover:bg-white/20 {{ request()->routeIs('balita.*') ? 'bg-white/20' : '' }}">Balita</a>
            <a href="{{ route('ibu-hamil.index') }}"
                class="block px-4 py-2 text-white hover:bg-white/20 {{ request()->routeIs('ibu-hamil.*') ? 'bg-white/20' : '' }}">Ibu
                Hamil</a>
            <a href="{{ route('lansia.index') }}"
                class="block px-4 py-2 text-white hover:bg-white/20 {{ request()->routeIs('lansia.*') ? 'bg-white/20' : '' }}">Lansia</a>
            <a href="{{ route('kader.index') }}"
                class="block px-4 py-2 text-white hover:bg-white/20 {{ request()->routeIs('kader.*') ? 'bg-white/20' : '' }}">Kader</a>
            <a href="{{ route('jadwal.index') }}"
                class="block px-4 py-2 text-white hover:bg-white/20 {{ request()->routeIs('jadwal.*') ? 'bg-white/20' : '' }}">Jadwal</a>
            <a href="{{ route('catatan.index') }}"
                class="block px-4 py-2 text-white hover:bg-white/20 {{ request()->routeIs('catatan.*') ? 'bg-white/20' : '' }}">Catatan</a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-green-500">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-green-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-white/20">Profile</a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-white/20">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>