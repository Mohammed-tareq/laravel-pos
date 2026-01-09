<?php

use App\Livewire\Customers\CreateCustomer;
use App\Livewire\Customers\EditCustomer;
use App\Livewire\Customers\ListCustomers;
use App\Livewire\Items\CreateItem;
use App\Livewire\Items\EditItem;
use App\Livewire\Items\ListItems;
use App\Livewire\PaymentMethods\CreatePaymentMethod;
use App\Livewire\PaymentMethods\EditPaymentMethod;
use App\Livewire\PaymentMethods\ListPaymentMethods;
use App\Livewire\Sales\ListSales;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\EditUser;
use App\Livewire\Users\ListUsers;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
Route::middleware(['auth'])->prefix('admin')->group(function () {
    //====================================== user   ==============================//
    Route::get('/manage-user' , ListUsers::class)->name('users.index');
    Route::get('/user/create' , CreateUser::class)->name('user.create');
    Route::get('/edit/{user}/user' , EditUser::class)->name('user.update');
    //====================================== end user   ==============================//

    //======================================  items  ==============================//
    Route::get('/manage-item' , ListItems::class)->name('items.index');
    Route::get('/item/create' , CreateItem::class)->name('item.create');
    Route::get('/edit/{item}/item' ,EditItem ::class)->name('item.update');
    //====================================== end items  ==============================//

    //====================================== customer   ==============================//
    Route::get('/manage-customer' , ListCustomers::class)->name('customers.index');
    Route::get('/customer/create' , CreateCustomer::class)->name('customer.create');
    Route::get('/edit/{customer}/customer' , EditCustomer::class)->name('customer.update');
    //====================================== end customer   ==============================//

    //====================================== sales   ==============================//
    Route::get('/manage-sale' , ListSales::class)->name('sales.index');
    //======================================  end sales  ==============================//

    //====================================== payment method   ==============================//
    Route::get('/manage-payment-method' , ListPaymentMethods::class)->name('payment.method.index');
    Route::get('/payment/create' , CreatePaymentMethod::class)->name('payment.method.create');
    Route::get('/edit/{payment}/payment-method' , EditPaymentMethod::class)->name('payment.method.update');
    //======================================  end payment method  ==============================//
});