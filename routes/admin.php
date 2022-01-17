<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductoController;
use App\Http\Livewire\Admin\CreateProducto;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Controllers\admin\InstructivoController;
use App\Http\Controllers\admin\UsuarioController;
use App\Http\Livewire\Admin\ShowProducts;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\VentaController;
use App\Http\Livewire\Admin\BransComponent;
use App\Http\Livewire\Admin\EstadoComponent;
use App\Http\Livewire\Admin\MunicipioComponent;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\ShowEstado;

Route::get('/', ShowProducts::class)->name('admin.index'); 

Route::get('productos/create', CreateProducto::class)->name('admin.productos.create');
Route::get('productos/{producto}/edit', EditProduct::class)->name('admin.productos.edit');
Route::post('productos/{producto}/files', [ProductoController::class, 'files'])->name('admin.productos.files');

Route::get('categorias', [CategoryController::class, 'index'])->name('admin.categorias');
Route::get('categorias/{categoria}', ShowCategory::class)->name('admin.categorias.show');

Route::get('marcas', BransComponent::class)->name('admin.marcas.index');

Route::get('ventas', [VentaController::class, 'index'])->name('admin.ventas.index');
Route::get('ventas/{order}', [VentaController::class, 'show'])->name('admin.venta.show');

Route::get('estados', EstadoComponent::class)->name('admin.estados.index');
Route::get('estados/{estado}', ShowEstado::class)->name('admin.estados.show');
Route::get('municipios/{municipio}', MunicipioComponent::class)->name('admin.municipios.show');

 

