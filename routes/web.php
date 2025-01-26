<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'show'])->name('home');
Route::get('/category/{slug}', [\App\Http\Controllers\HomeController::class, 'showCategoryItems'])->name('category.items.show');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'show'])->name('contact');
Route::post('contact/message', [\App\Http\Controllers\ContactController::class, 'sendMessage'])->name('contact.message.sent');
Route::get('/about', [\App\Http\Controllers\AboutController::class, 'show'])->name('about');
Route::get('/store/status', [\App\Http\Controllers\Admin\StoreStatusController::class, 'show'])->name('store.status');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'show'])->name('cart');
Route::get('/order', [\App\Http\Controllers\OrderController::class, 'show'])->name('order');
Route::view('/privacy-policy', "privacy-policy.show")->name('privacy.show');
Route::view('/terms-and-conditions', "terms-and-conditions.show")->name('terms.show');

Route::get('/sitemap', [\App\Http\Controllers\SitemapController::class, 'show'])->name('sitemap.show');
Route::prefix('admin')->name('admin.')->group(function () {

    Route::group(['middleware' => ['guest']], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Auth\AdminLoginController::class, 'show'])->name('login');
        Route::post('login', [\App\Http\Controllers\Admin\Auth\AdminLoginController::class, 'authenticate'])->name('login.submit');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::post('logout', [\App\Http\Controllers\Admin\Auth\AdminLogOutController::class, 'logout'])->name('logout');

        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'show'])->name('dashboard');

        Route::get('profile', [\App\Http\Controllers\Admin\User\UserProfileController::class, 'show'])->name('profile');
        Route::put('profile', [\App\Http\Controllers\Admin\User\UserProfileController::class, 'update'])->name('profile.update');
        Route::put('password', [\App\Http\Controllers\Admin\User\UserPasswordController::class, 'update'])->name('password.update');

        Route::get('categories', [\App\Http\Controllers\Admin\Category\CategoryPageController::class, 'show'])->name('categories');
        Route::get('categories/all', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'index'])->name('categories.index');
        Route::put('categories/status/{category}', [\App\Http\Controllers\Admin\Category\CategoryStatusController::class, 'update'])->name('categories.status.update');
        Route::post('categories', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'store'])->name('categories.store');
        Route::put('categories/{category}', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'destroy'])->name('categories.delete');

        Route::get('payment_methods', [\App\Http\Controllers\Admin\PaymentMethod\PaymentMethodPageController::class, 'show'])->name('payment_methods');
        Route::get('payment_methods/all', [\App\Http\Controllers\Admin\PaymentMethod\PaymentMethodController::class, 'index'])->name('payment_methods.index');
        Route::put('payment_methods/status/{paymentMethod}', [\App\Http\Controllers\Admin\PaymentMethod\PaymentMethodStatusController::class, 'update'])->name('payment_methods.status.update');
        Route::post('payment_methods', [\App\Http\Controllers\Admin\PaymentMethod\PaymentMethodController::class, 'store'])->name('payment_methods.store');
        Route::put('payment_methods/{paymentMethod}', [\App\Http\Controllers\Admin\PaymentMethod\PaymentMethodController::class, 'update'])->name('payment_methods.update');
        Route::delete('payment_methods/{paymentMethod}', [\App\Http\Controllers\Admin\PaymentMethod\PaymentMethodController::class, 'destroy'])->name('payment_methods.delete');

        Route::get('areas', [\App\Http\Controllers\Admin\Area\AreaPageController::class, 'show'])->name('areas');
        Route::get('areas/all', [\App\Http\Controllers\Admin\Area\AreaController::class, 'index'])->name('areas.index');
        Route::put('areas/status/{area}', [\App\Http\Controllers\Admin\Area\AreaStatusController::class, 'update'])->name('areas.status.update');
        Route::post('areas', [\App\Http\Controllers\Admin\Area\AreaController::class, 'store'])->name('areas.store');
        Route::put('areas/{area}', [\App\Http\Controllers\Admin\Area\AreaController::class, 'update'])->name('areas.update');
        Route::delete('areas/{area}', [\App\Http\Controllers\Admin\Area\AreaController::class, 'destroy'])->name('areas.delete');

        Route::get('items', [\App\Http\Controllers\Admin\Item\ItemPageController::class, 'show'])->name('items');
        Route::get('items/all', [\App\Http\Controllers\Admin\Item\ItemController::class, 'index'])->name('items.index');
        Route::put('items/status/{item}', [\App\Http\Controllers\Admin\Item\ItemStatusController::class, 'update'])->name('items.status.update');
        Route::post('items', [\App\Http\Controllers\Admin\Item\ItemController::class, 'store'])->name('items.store');
        Route::put('items/{item}', [\App\Http\Controllers\Admin\Item\ItemController::class, 'update'])->name('items.update');
        Route::post('items/replicate/{item}', [\App\Http\Controllers\Admin\Item\ItemController::class, 'replicate'])->name('items.replicate');
        Route::delete('items/image/{item}', [\App\Http\Controllers\Admin\Item\ItemImageController::class, 'destroy'])->name('items.image.delete');
        Route::delete('items/{item}', [\App\Http\Controllers\Admin\Item\ItemController::class, 'destroy'])->name('items.delete');

        Route::post('/items/{item}/ingredients', [\App\Http\Controllers\Admin\Item\ItemIngredientController::class, 'store'])->name('items.ingredients.store');
        Route::delete('/items/{item}/ingredients/{ingredient}', [\App\Http\Controllers\Admin\Item\ItemIngredientController::class, 'destroy'])->name('items.ingredients.destroy');

        Route::post('/items/{item}/services', [\App\Http\Controllers\Admin\Item\ItemServiceController::class, 'store'])->name('items.services.store');
        Route::delete('/items/{item}/services/{service}', [\App\Http\Controllers\Admin\Item\ItemServiceController::class, 'destroy'])->name('items.services.destroy');

        Route::get('services', [\App\Http\Controllers\Admin\Service\ServicePageController::class, 'show'])->name('services');
        Route::get('services/all', [\App\Http\Controllers\Admin\Service\ServiceController::class, 'index'])->name('services.index');
        Route::put('services/{service}', [\App\Http\Controllers\Admin\Service\ServiceController::class, 'update'])->name('services.update');
        Route::delete('services/{service}', [\App\Http\Controllers\Admin\Service\ServiceController::class, 'destroy'])->name('services.delete');
        Route::get('services/getCategories', [\App\Http\Controllers\Admin\Service\ServiceController::class, 'getCategories'])->name('services.getCategories');
        Route::put('services/status/{service}', [\App\Http\Controllers\Admin\Service\ServiceStatusController::class, 'update'])->name('services.status.update');
        Route::post('services', [\App\Http\Controllers\Admin\Service\ServiceController::class, 'store'])->name('services.store');
        Route::post('services/replicate/{service}', [\App\Http\Controllers\Admin\Service\ServiceController::class, 'replicate'])->name('services.replicate');


        Route::get('coupons', [\App\Http\Controllers\Admin\Coupon\CouponPageController::class, 'show'])->name('coupons');
        Route::get('coupons/all', [\App\Http\Controllers\Admin\Coupon\CouponController::class, 'index'])->name('coupons.index');
        Route::put('coupons/status/{coupon}', [\App\Http\Controllers\Admin\Coupon\CouponStatusController::class, 'update'])->name('coupons.status.update');
        Route::post('coupons', [\App\Http\Controllers\Admin\Coupon\CouponController::class, 'store'])->name('coupons.store');
        Route::put('coupons/{coupon}', [\App\Http\Controllers\Admin\Coupon\CouponController::class, 'update'])->name('coupons.update');
        Route::delete('coupons/{coupon}', [\App\Http\Controllers\Admin\Coupon\CouponController::class, 'destroy'])->name('coupons.delete');

        Route::get('store/status', [\App\Http\Controllers\Admin\StoreStatusController::class, 'show'])->name('store.status');
        Route::put('store/status', [\App\Http\Controllers\Admin\StoreStatusController::class, 'update'])->name('store.status.update');

        Route::get('settings', [\App\Http\Controllers\Admin\SettingsController::class, 'show'])->name('settings');
        Route::get('settings/all', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings/about', [\App\Http\Controllers\Admin\SettingsController::class, 'updateAbout'])->name('settings.about.update');
        Route::put('settings/global_alert', [\App\Http\Controllers\Admin\SettingsController::class, 'updateGlobalAlert'])->name('settings.global_alert.update');
        Route::put('settings/usd-rate', [\App\Http\Controllers\Admin\SettingsController::class, 'updateUsdRate'])->name('settings.usd-rate.update');

        Route::get('notifications', [\App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notifications');
        Route::get('notifications/unread', [\App\Http\Controllers\Admin\NotificationController::class, 'unread'])->name('notifications.unread');
        Route::put('notifications/mark-as-read', [\App\Http\Controllers\Admin\NotificationController::class, 'markAsRead'])->name('notifications.read');

        Route::get('customers', [\App\Http\Controllers\Admin\Customer\CustomerController::class, 'index'])->name('customers');
        Route::get('users', [\App\Http\Controllers\Admin\User\UserController::class, 'index'])->name('users');
        Route::post('users', [\App\Http\Controllers\Admin\User\UserController::class, 'store'])->name('users.store');
        Route::get('users/create', [\App\Http\Controllers\Admin\User\UserController::class, 'create'])->name('users.create');
        Route::delete('users/{user}', [\App\Http\Controllers\Admin\User\UserController::class, 'destroy'])->name('users.destroy');
        Route::post('message/send', [\App\Http\Controllers\Admin\MailController::class, 'send'])->name('message.send');


        Route::get('bnrs', [\App\Http\Controllers\Admin\Banner\BannerPageController::class, 'show'])->name('banners');
        Route::get('bnrs/all', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'index'])->name('banners.index');
        Route::put('bnrs/status/{banner}', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'updateStatus'])->name('banners.status.update');
        Route::post('bnrs', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'store'])->name('banners.store');
        Route::put('bnrs/{banner}', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'update'])->name('banners.update');
        Route::delete('bnrs/{banner}', [\App\Http\Controllers\Admin\Banner\BannerController::class, 'destroy'])->name('banners.delete');


        Route::get('orders', [\App\Http\Controllers\Admin\SubmittedOrderController::class, 'index'])->name('orders');
        Route::get('orders/{order}/status/{status}', [\App\Http\Controllers\Admin\OrderStatusController::class, 'update'])->name('orders.status.update');
        Route::delete('orders/{order}', [\App\Http\Controllers\Admin\SubmittedOrderController::class, 'destroy'])->name('orders.delete');
        Route::get('orders/{order}', [\App\Http\Controllers\Admin\SubmittedOrderController::class, 'show'])->name('orders.show');

        // Route::get('notifications', [\App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notifications');
        // Route::get('push-notifications', [\App\Http\Controllers\Admin\PushNotificationController::class, 'show'])->name('push-notifications');
        // Route::post('push-notifications', [\App\Http\Controllers\Admin\PushNotificationController::class, 'publishNotification'])->name('push-notifications.publish');
    });
});
Route::get('/img/{path}', [App\Http\Controllers\ImageController::class, 'show'])->where('path', '.*');
Route::get('{slug}', [\App\Http\Controllers\HomeController::class, 'showItem'])->name('item.show');
