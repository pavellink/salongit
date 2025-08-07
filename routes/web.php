<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::controller(\App\Http\Controllers\SiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/great', 'great')->name('great');
    Route::post('/toggle-aside', 'toggleAside')->name('toggle.aside');

    Route::get('/dr-500', 'dr500');
    Route::get('/get-dr-500', 'getDr500');

    Route::post('pre-order', 'preOrder')->name('preOrder');
});



Route::middleware(['verified', 'owner'])->controller(\App\Http\Controllers\LogController::class)->group(function () {
    Route::get('/log', 'index')->name('log');
    Route::get('/log/items', 'items')->name('log.items');
});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\CartController::class)->group(function () {
    Route::post('/cart/add', 'add')->name('cart.add');
    Route::post('/cart/update', 'update')->name('cart.update');
    Route::post('/cart/update/count', 'updateCount')->name('cart.update.count');
    Route::post('/cart/create-set', 'createSet')->name('cart.createSet');
    Route::post('/cart/store-set', 'storeSet')->name('cart.storeSet');
    Route::post('/cart/change-set', 'changeSet')->name('cart.changeSet');
    Route::post('/cart/update-set', 'updateSet')->name('cart.updateSet');
    Route::post('/cart/delete-set', 'deleteSet')->name('cart.deleteSet');
    Route::post('/cart/total', 'total')->name('cart.total');
    Route::post('/cart/delete', 'delete')->name('cart.delete');
    Route::post('/cart/clear-all', 'clearAll')->name('cart.clear_all');
    Route::post('/cart/success', 'success')->name('cart.success');
});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\CartProductController::class)->group(function () {
    Route::post('/cart-product/add', 'add')->name('cart-product.add');
    Route::post('/cart-product/update', 'update')->name('cart-product.update');
    Route::post('/cart-product/update/count', 'updateCount')->name('cart-product.update.count');
    Route::post('/cart-product/total', 'total')->name('cart-product.total');
    Route::post('/cart-product/delete', 'delete')->name('cart-product.delete');
    Route::post('/cart-product/clear-all', 'clearAll')->name('cart-product.clear_all');
    Route::post('/cart-product/success', 'success')->name('cart-product.success');
});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\PreController::class)->group(function () {
    Route::any('/pre', 'index')->name('pre');
    Route::get('/pre/edit/{id}', 'edit')->name('pre.edit');
    Route::post('/pre/update/{id}', 'update')->name('pre.update');
});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\OrdersController::class)->group(function () {
    Route::any('/orders/add', 'add')->name('orders.add');
    Route::any('/orders/pre', 'pre')->name('orders.pre');
    Route::get('/orders/create/{id}', 'create')->name('orders.create');
    Route::post('/orders/pre-store/{id}', 'preStore')->name('orders.preStore');
    Route::post('/orders/store/{id}', 'store')->name('orders.store');
    Route::get('/orders/edit/{id}', 'edit')->name('orders.edit');
    Route::post('/orders/update/{id}', 'update')->name('orders.update');
    Route::post('/orders/delete/{id}', 'delete')->name('orders.delete');

    Route::post('/orders/completed', 'completed')->name('orders.completed');
    Route::post('/orders/select-user', 'selectUser')->name('orders.selectUser');

    Route::post('/orders/change-status', 'changeStatus')->name('orders.change.status');
    Route::post('/orders/confirm-nal', 'confirmNal')->name('orders.confirm.nal');
});

/*Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\CabinetController::class)->group(function () {
    Route::get('/cabinet', 'index')->name('cabinet');
});*/

Route::middleware(['verified', 'admin'])->prefix('/items')->controller(\App\Http\Controllers\ItemsController::class)->group(function () {
    Route::get('/', 'index')->name('items');
    Route::get('/items', 'items')->name('items.items');
    Route::get('/create', 'create')->name('items.create');
    Route::get('/edit/{id}', 'edit')->where('id', '[0-9]+')->name('items.edit');
    Route::post('/update/{id}', 'update')->where('id', '[0-9]+')->name('items.update');
    Route::post('/delete', 'delete')->name('items.delete');
    Route::post('/position', 'updatePosition')->name('items.position');
    Route::get('/filter', 'filter')->name('items.filter');
});

Route::middleware(['verified', 'admin'])->prefix('/services')->controller(\App\Http\Controllers\ServicesController::class)->group(function () {
    Route::get('/', 'index')->name('services');
    Route::get('/groups', 'groups')->name('services.groups');
    Route::get('/items', 'items')->name('services.items');
    Route::get('/create', 'create')->name('services.create');
    Route::get('/edit/{id}', 'edit')->where('id', '[0-9]+')->name('services.edit');
    Route::post('/update/{id}', 'update')->where('id', '[0-9]+')->name('services.update');
    Route::post('/delete', 'delete')->name('services.delete');
    Route::post('/position', 'updatePosition')->name('services.position');
    Route::get('/filter', 'filter')->name('services.filter');
});

Route::middleware(['verified', 'admin'])->prefix('/sets')->controller(\App\Http\Controllers\SetsController::class)->group(function () {
    Route::get('/', 'index')->name('sets');
    Route::get('/create', 'create')->name('sets.create');
    Route::post('/store', 'store')->name('sets.store');
    Route::get('/edit/{id}', 'edit')->where('id', '[0-9]+')->name('sets.edit');
    Route::post('/update/{id}', 'update')->where('id', '[0-9]+')->name('sets.update');
    Route::post('/delete', 'delete')->name('sets.delete');
    Route::post('/position', 'updatePosition')->name('sets.position');
});

Route::middleware(['verified', 'admin'])->prefix('/set-items')->controller(\App\Http\Controllers\SetItemsController::class)->group(function () {
    Route::post('/add', 'add')->name('setItems.add');
    Route::post('/update', 'update')->name('setItems.update');
    Route::post('/delete', 'delete')->name('setItems.delete');
});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\CalendarController::class)->group(function () {
    Route::get('/calendar', 'index')->name('calendar');
    Route::get('/days', 'days')->name('days');
    Route::get('/masters', 'masters')->name('masters');
    Route::get('/week', 'week')->name('week');
});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\ShiftController::class)->group(function () {
    Route::post('/shift/store', 'store')->name('shift.store');
    Route::get('/shift/who-works', 'whoWorks')->name('shift.whoWorks');
    Route::post('/shift/times', 'times')->name('shift.times');
    Route::post('/shift/delete', 'delete')->name('shift.delete');
});

/*Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\ShiftController::class)->group(function () {
    Route::post('/shift/store', 'store')->name('shift.store');
    Route::get('/shift/who-works', 'whoWorks')->name('shift.whoWorks');
});*/

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\ClientsController::class)->group(function () {
    Route::get('/clients', 'index')->name('clients');
    Route::get('/clients/items', 'items')->name('clients.items');
    Route::get('/clients/create', 'create')->name('clients.create');
    Route::get('/clients/edit/{id}', 'edit')->name('clients.edit');
    Route::post('/clients/update/{id}', 'update')->name('clients.update');

    Route::post('/clients/get-phone', 'getPhone')->name('clients.get_phone');

    Route::get('/clients/find', 'find')->name('clients.find');
});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\ModalController::class)->group(function () {
    Route::post('/modal/phone', 'phone')->name('modal.phone');
    Route::get('/modal/shift/add', 'addShift')->name('modal.shift.add');
    Route::get('/modal/shift/view', 'viewShift')->name('modal.shift.view');
    Route::get('/modal/order/view', 'viewOrder')->name('modal.order.view');


    Route::get('/modal/dialog/status', 'dialogStatus')->name('modal.dialog.status');
    Route::get('/modal/dialog/pay', 'dialogPay')->name('modal.dialog.pay');

    Route::get('/modal/dialog/history', 'dialogHistory')->name('modal.dialog.history');

});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\MessagesController::class)->group(function () {
    Route::post('/add', 'add')->name('messages.add');

});

Route::middleware(['verified', 'admin'])->controller(\App\Http\Controllers\HistoryController::class)->group(function () {
    Route::get('/history', 'view')->name('history.view');
});
