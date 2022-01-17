<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Ventas
            </h2>
        </div>
    </x-slot>
    <div class="mx-12 px-4 py-12 my-8 border">
        <section class="grid grid-cols-5 gap-6">
            <a href="{{ route('admin.ventas.index') . '?status=1' }}" class="bg-trueGray-600 rounded-lg py-8">
                <p class="text-center text-2xl text-white"><i class="fas fa-clock text-4xl"></i></p>
                <p class="text-center my-2 text-white">Ventas Pendientes</p>
                <p class="text-center text-2xl text-white">
                    {{ $pendiente }}
                </p>
            </a>
            <a href="{{ route('admin.ventas.index') . '?status=2' }}" class="bg-yellow-500 rounded-lg py-8">
                <p class="text-center text-2xl text-white"><i class="fas fa-credit-card text-4xl"></i></p>
                <p class="text-center my-2 text-white">Ventas Confirmadas</p>
                <p class="text-center text-2xl text-white">
                    {{ $confirmado }}
                </p>
            </a>
            <a href="{{ route('admin.ventas.index') . '?status=3' }}" class="bg-orange-600 rounded-lg py-8">
                <p class="text-center text-2xl text-white"><i class="fas fa-truck text-4xl"></i></p>
                <p class="text-center my-2 text-white">Ventas Despachadas</p>
                <p class="text-center text-2xl text-white">
                    {{ $despachado }}
                </p>
            </a>
            <a href="{{ route('admin.ventas.index') . '?status=4' }}" class="bg bg-green-800 rounded-lg py-8">
                <p class="text-center text-2xl text-white"><i class="fas fa-calendar-check text-4xl"></i></p>
                <p class="text-center my-2 text-white">Ventas Entregadas</p>
                <p class="text-center text-2xl text-white">
                    {{ $entregado }}
                </p>
            </a>
            <a href="{{ route('admin.ventas.index') . '?status=5' }}" class="bg-red-600 rounded-lg py-8">
                <p class="text-center text-2xl text-white"><i class="fas fa-times-circle text-4xl"></i></p>
                <p class="text-center my-2 text-white">Ventas Canceladas</p>
                <p class="text-center text-2xl text-white">
                    {{ $cancelado }}
                </p>
            </a>
        </section>

        @if ($orders->count())
            <section class="bg-white rounded-lg shadow-lg py-8 px-12 mt-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl mb-4 text-gray-700">Pedidos Recientes</h1>
                    <div>
                        <a href="{{ route('admin.ventas.index') }}" class="cursor-pointer hover:text-red-700 text-gray-700"
                            wire:click="destroy">
                            <i class="fas fa-reply-all text-gray-700 hover:text-red-700"></i>
                            Mostrar todo
                        </a>
                    </div>
                </div>

                <ul class="mb-4">
                    @foreach ($orders as $order)
                        <li class="border-b">
                            <a href="{{ route('admin.venta.show', $order) }}"
                                class="flex items-center py-2 px-4 hover:bg-gray-300 ">
                                <span class="w-12 text-center">
                                    @switch($order->status)
                                        @case(1)
                                            <i class="fas fa-clock text-trueGray-600"></i>
                                        @break
                                        @case(2)
                                            <i class="fas fa-credit-card text-yellow-500"></i>
                                        @break
                                        @case(3)
                                            <i class="fas fa-truck text-orange-600"></i>
                                        @break
                                        @case(4)
                                            <i class="fas fa-calendar-check text-green-800"></i>
                                        @break
                                        @case(5)
                                            <i class="fas fa-times-circle text-red-600"></i>
                                        @break

                                        @default
                                    @endswitch
                                </span>
                                <span class="text-gray-700">
                                    No. Venta: {{ $order->id }}
                                    <br>
                                    {{ $order->created_at->format('d/m/Y') }}
                                </span>

                                <div class="ml-auto">
                                    <p>
                                        @switch($order->status)
                                            @case(1)
                                                <span class="text-trueGray-600">Pendiente</span>
                                            @break
                                            @case(2)
                                                <span class="text-yellow-500">Confirmado</span>
                                            @break
                                            @case(3)
                                                <span class="text-orange-600">Despachado</span>
                                            @break
                                            @case(4)
                                                <span class="text-green-800">Entregado</span>
                                            @break
                                            @case(5)
                                                <span class="text-red-600">Cancelado</span>
                                            @break
                                            @default

                                        @endswitch
                                    </p>
                                    <span class="text-sm text-black">
                                        ${{ $order->total }} MXN
                                    </span>
                                </div>
                                <span>
                                    <i class="fas fa-caret-right ml-4 text-lg text-gray-700"></i>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                {{ $orders->links() }}
            </section>
        @else
            <div class="bg-white rounded-lg shadow-lg py-8 px-12 mt-4 text-gray-700">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl mb-4 text-gray-700">Ventas Recientes</h1>
                    <div>
                        <a href="{{ route('admin.ventas.index') }}" class="cursor-pointer hover:text-red-700 text-gray-700"
                            wire:click="destroy">
                            <i class="fas fa-reply-all text-gray-700 hover:text-red-700"></i>
                            Mostrar todo
                        </a>
                    </div>
                </div>
                <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border-t-4 border-red-500 dark:bg-red-200 dark:text-red-800"
                role="alert">
                <svg class="inline flex-shrink-0 mr-3 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div>
                    <span class="font-medium">Upss!</span> Aun no se ha realizado ninguna venta.
                </div>
            
            </div>
        @endif
    </div>

</x-admin-layout>
