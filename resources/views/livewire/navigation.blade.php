<header class="bg-trueGray-800 h-15  w-full sticky top-0" style="z-index: 900" x-data="dropdown()">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-20">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" x-on:click="open=true"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">


                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                {{-- logo --}}
                <a href="/" class="flex-shrink-0 flex items-center">
                    <img class="block lg:hidden h-16 w-auto"
                        src="{{asset('img/logo.png')}}" alt="PreFall">
                    <img class="hidden lg:block h-12 w-auto object-cover"
                        src="{{asset('img/logo3.png')}}"
                        alt="PreFall">
                </a>
                <div class="hidden md:block ml-4">
                    <div class="flex">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a :class="{'border border-orange-600 bg-white bg-opacity-25 ' : open}" x-on:click="show()"
                            href="#"
                            class="flex mr-2 cursor-pointer items-center justify-center text-white px-3 py-2 rounded-md bg-white bg-opacity-25 hover:bg-orange-600 font-semibold">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <span class="ml-1 text-sm">Productos</span>
                        </a>
                        <a href="#"
                            class="text-white hover:bg-orange-600 px-3 py-2 rounded-md font-medium mr-2">Servicios</a>

                        <a href="#"
                            class="text-white hover:bg-orange-600 px-3 py-2 rounded-md font-medium mr-2">Nosotros</a>
                    </div>
                </div>
                <div class="flex-1 hidden md:block">
                    @livewire('search')
                </div>


            </div>

            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                @auth
                    <button type="button"
                        class="bg-gray-700 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">

                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->

                    <div class="mx-4 relative" x-data="{ open:false }">
                        <div>
                            <button type="button" x-on:click="open=true"
                                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-600 focus:ring-white"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="">
                            </button>
                        </div>


                        <div x-show="open" x-on:click.away="open=false"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-900 ring-1 ring-yellow-900 ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @can('admin.home')
                                <p class="text-sm text-white my-2 ml-2"><span class="text-md font-bold">Admin:
                                    </span>{{ auth()->user()->name }}</p>
                            @else
                                <p class="text-sm text-white my-2 ml-2"><span class="text-md font-bold">Usuario:
                                    </span>{{ auth()->user()->name }}</p>
                            @endcan
                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-sm text-white hover:text-orange-600" role="menuitem"
                                tabindex="-1" id="user-menu-item-0"><i
                                    class="fas fa-user mr-2 text-orange-600"></i>Mi perfil</a>
                            <a href="{{ route('orders.index') }}"
                                class="block px-4 py-2 text-sm text-white hover:text-orange-600" role="menuitem"
                                tabindex="-1" id="user-menu-item-0"><i
                                    class="fas fa-shopping-bag mr-2 text-orange-600"></i>Mis compras</a>
                            @can('admin.home')
                                <a href="{{ route('admin.index') }}" {{-- admin.home --}}
                                    class="block px-4 py-2 text-sm hover:text-orange-600 text-white" role="menuitem"
                                    tabindex="-1" id="user-menu-item-0">
                                    <i class="fas fa-user-cog mr-2 text-orange-600"></i>Administrador</a>
                            @endcan

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-white hover:text-orange-600" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2"
                                    onclick="event.preventDefault();
                                                                                                                    this.closest('form').submit();">
                                    <i class="fas fa-power-off mr-2 text-orange-600"></i>Cerrar Sesion
                                </a>
                            </form>
                        </div>

                    </div>
                @else
                    <div class="mx-4 relative" x-data="{ open:false }">
                        <div>
                            <button type="button" x-on:click="open=true"
                                class="bg-gray-600 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-600 focus:ring-white"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                            </button>
                        </div>


                        <div x-show="open" x-on:click.away="open=false"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-gray-900 ring-1 ring-yellow-900 ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="{{ route('register') }}"
                                class="block px-4 py-2 text-sm text-white hover:text-orange-600" role="menuitem"
                                tabindex="-1" id="user-menu-item-0"><i
                                    class="fas fa-fingerprint mr-2 text-orange-600"></i>Registrarse</a>
                            <a href="{{ route('login') }}"
                                class="block px-4 py-2 text-sm text-white hover:text-orange-600" role="menuitem"
                                tabindex="-1" id="user-menu-item-0"><i
                                    class="fas fa-user-circle mr-2 text-orange-600"></i>Iniciar sesion</a>

                        </div>

                    </div>

                @endauth

                @livewire('dropdown-cart')
               
            </div>
        </div>
    </div>

    <nav id="navigation-menu" x-show="open" :class="{'block': open, 'hidden': !open}"
        class="bg-trueGray-700 bg-opacity-25 w-full absolute hidden">
        {{-- Menu computer --}}
        <div class="container h-full hidden md:block">
            <div x-on:click.away="close()" class="grid grid-cols-4 h-full relative">
                <ul class="bg-trueGray-800 border-l border-t border-b border-orange-600">

                    @foreach ($categorias as $categoria)
                        <li class="navigation-link text-white hover:bg-white hover:text-orange-600">
                            <a href="{{ route('categorias.show', $categoria) }}"
                                class="py-2 px-4 text-sm flex justify-between items-center">
                                <div>
                                    <span class="mr-2">
                                        {!! $categoria->icono !!}
                                    </span>
                                    {{ $categoria->nombre }}
                                </div>

                                <i class="fas fa-angle-right text-orange-600"></i>
                            </a>
                            <div class="navigation-submenu bg-trueGray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                                <x-navigation-subcategories :categoria="$categoria" />
                            </div>
                        </li>
                    @endforeach


                </ul>
                <div class="col-span-3 bg-white">
                    <x-navigation-subcategories :categoria="$categorias->first()" />
                </div>
            </div>
        </div>
        {{-- menu mobil --}}
        <div class="bg-trueGray-700 h-full overflow-y-auto">
            <div class="container pt-4 pb-2">
                @livewire('search')
            </div>
            <ul>
                <p class="text-white hover:text-orange-600 p-4 font-semibold">Productos</p>
                @foreach ($categorias as $categoria)
                    <li class="text-white hover:bg-white hover:text-orange-600">
                        <a href="{{ route('categorias.show', $categoria) }}"
                            class="py-2 px-4 text-sm flex items-center">
                            <span class="flex justify-center w-9">
                                {!! $categoria->icono !!}
                            </span>
                            {{ $categoria->nombre }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="#"
                class="flex flex-col text-white hover:text-orange-600 px-3 py-2 rounded-md font-medium mr-2">Servicios</a>

            <a href="#"
                class="flex flex-col text-white hover:text-orange-600 px-3 py-2 rounded-md font-medium mr-2">Nosotros</a>
        </div>
    </nav>

</header>
