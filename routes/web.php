<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// CLient side rendering
    Route::get('/', function () {
        return redirect()->route('client.home');
    });

    Route::get('/home', 'AppController@index')->name('client.home');

    Route::get('/home/shop', 'ShopController@index')->name('client.shop');
    Route::get('/home/shop/search', 'ShopController@search')->name('client.shop.search');
    Route::get('/home/shop/category/{slug}', 'ShopController@category')->name('client.category');

    Route::get('/home/blog', 'BlogController@index')->name('client.blog');
    Route::get('/home/blog/tag/{slug}', 'BlogController@tag')->name('client.tag');

    Route::get('/home/blog/{slug}', 'BlogController@detail')->name('client.blog-detail');

    Route::get('/home/contact', 'AppController@contact')->name('client.contact');

    Route::get('/home/shop/product/{slug}', 'ShopController@detail')->name('client.product-detail');



//Auth check login for user
Route::group(['middleware' => 'auth'], function ()
{
    // Client shopping cart and checkout
    Route::get('/home/cart','CartController@index')->name('client.cart');
    Route::post('/home/cart', 'CartController@addToCart')->name('client.cart.add');
    Route::put('home/cart/update', 'CartController@updateCart')->name('client.cart.update');
    Route::delete('home/cart/remove', 'CartController@removeItem')->name('client.cart.remove');
    Route::delete('home/cart/clear', 'CartController@clearCart')->name('client.cart.clear');
    Route::get('/home/cart/checkout', 'CheckoutController@index')->name('client.checkout');
    Route::post('/home/cart/checkout', 'CheckoutController@store')->name('client.pcheckout');
    Route::get('/home/cart/checkout.success', 'CheckoutController@success')->name('client.checkout.success');

    // VNPay API
    Route::post('/vnpay_payment', 'PaymentController@vnpay')->name('vnpay');

    // Client wishlist cart
    Route::get('/home/wishlist', 'WishlistController@index')->name('client.wishlist');
    Route::post('/home/wishlist', 'WishlistController@addToWishlist')->name('client.wishlist.add');
    Route::delete('home/wishlist/remove', 'WishlistController@remove')->name('client.wishlist.remove');
    Route::delete('home/wishlist/clear', 'WishlistController@clearAll')->name('client.wishlist.clear');
    Route::post('home/wishlist/move', 'WishlistController@moveToCart')->name('client.wishlist.add.cart');

    // Client profile page
    Route::resource('home/user', 'UserController');
    Route::get('home/user/account/{user}', 'UserController@account')->name('user.account');
    Route::get('home/user/security/{user}', 'UserController@security')->name('user.security');
    Route::post('home/user/security/change-password', 'UserController@changePassword')->name('user.change.password');
    Route::get('home/user/purchase-history/{user}', 'UserController@purchaseHistory')->name('user.purchase.history');
    Route::get('home/user/purchase-history/detail/{id}', 'UserController@orderDetail')->name('user.order_detail');
    Route::get('home/user/profile/rating', 'UserController@ratingIndex')->name('user.rating');
    Route::post('home/user/profile/rating', 'UserController@rating')->name('user.pRating');
    Route::get('home/user/profile/rating/view/{id}', 'UserController@viewRating')->name('user.view.rating');
    Route::post('home/user/order/complete', 'UserController@received')->name('user.receive.order');
});


// Auth check login for admin site
// php artisan make:controller ... --resource => automatically create routes for CRUD
// php artisan route:list => check on routes directory and name created from above
Route::group(['prefix' => '/admin/', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'admin.login'], function ()
{
    Route::resource('tag', 'TagController');
    Route::resource('product', 'ProductController');
    Route::resource('admin', 'AdminController');
    Route::resource('user', 'UserController');
    Route::resource('blog', 'BlogController');
    Route::resource('order', 'OrderController');
    Route::resource('category', 'CategoryController');
    Route::resource('review', 'ReviewController');
});

//Admin site search function
Route::get('/admin/search', 'Admin\AdminController@index')->name('admin.search');
Route::get('/blog/search', 'Admin\BlogController@index')->name('blog.search');
Route::get('/category/search', 'Admin\CategoryController@index')->name('category.search');
Route::get('/product/search', 'Admin\ProductController@index')->name('product.search');
Route::get('/tag/search', 'Admin\TagController@index')->name('tag.search');
Route::get('/user/search', 'Admin\UserController@index')->name('user.search');
Route::get('/order/search', 'Admin\OrderController@index')->name('order.search');
Route::get('/message/search', 'SendEmailController@message')->name('message.search');
Route::get('/review/search', 'Admin\ReviewController@index')->name('review.search');

// Auth check login for admin
Route::group(['middleware' => 'admin.login'], function ()
{
    Route::get('admin/order/detail/{id}', 'Admin\OrderController@viewOrder')->name('admin.order_detail');
    Route::post('admin/order/detail/status/{id}', 'Admin\OrderController@status')->name('admin.order.status');

    Route::post('admin/user/restore/{id}', 'Admin\UserController@restore')->name('admin.user.restore');
    Route::post('admin/user/terminate/{id}', 'Admin\UserController@terminate')->name('admin.user.terminate');

    Route::post('admin/admin/restore/{id}', 'Admin\AdminController@restore')->name('admin.admin.restore');
    Route::post('admin/admin/terminate/{id}', 'Admin\AdminController@terminate')->name('admin.admin.terminate');

    Route::get('admin/profile/{admin}', 'Admin\AdminController@detail')->name('admin.detail');
    Route::post('admin/profile/{admin}/update', 'Admin\AdminController@profileUpdate')->name('admin.profile.update');

    Route::get('admin/message', 'SendEmailController@message')->name('admin.message.index');
    Route::get('admin/message/detail/{id}', 'SendEmailController@messageDetail')->name('admin.message.detail');
    Route::post('admin/message/status/{id}', 'SendEmailController@status')->name('admin.message.status');

    Route::post('admin/review/proceed', 'Admin\ReviewController@proceed')->name('admin.review.proceed');

    Route::get('/admin', 'Admin\AdminController@home')->name('admin.home');
});


//User Login, Logout and Register
Route::get('user/register', 'UserController@register')->name('user.register');
Route::post('user/register', 'UserController@store')->name('user.store');
Route::get('user/login', 'UserController@login')->name('user.login');
Route::post('user/login', 'UserController@pLogin')->name('user.pLogin');
Route::get('user/logout', 'UserController@logout')->name('user.logout');

//User social login
Auth::routes();
Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');


// Admin Login, Logout
Route::get('admin/login', 'Admin\AdminController@adminLogin')->name('admin.login');
Route::post('admin/login', 'Admin\AdminController@pAdminLogin')->name('admin.pLogin');
Route::get('admin/logout', 'Admin\AdminController@adminLogout')->name('admin.logout');


// Manual Route coding for CRUD function.
// Route::get('category/create', 'CategoryController@create')->name('category.create');
    // Route::post('category/create', 'CategoryController@store');
    // Route::get('category', 'CategoryController@index')->name('category.index');
    // Route::get('category/{id}/edit', 'CategoryController@edit')->name('category.edit');
    // Route::put('category/{id}/edit', 'CategoryController@update')->name('category.update');
    // Route::delete('category/delete/{id}', 'CategoryController@delete')->name('category.delete');

//Send confirm email in "Contact"
Route::get('/form', 'SendEmailController@index');
Route::post('/send/email', 'SendEmailController@send')->name('send');

Auth::routes();
Route::get('/test', 'HomeController@index')->name('home');

// Route::get('/testsite', 'TestController@index')->name('admin.test');
// Route::get('/testsite/input', 'TestController@testIndex')->name('admin.test2');
// Route::post('/testsite', 'TestController@test')->name('test');
// Route::post('/testsite/rating', 'TestController@ratingTest')->name('test.rating');
