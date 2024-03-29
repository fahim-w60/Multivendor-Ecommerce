<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Middleware\RedirectIfAuthenticated;


// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/',[IndexController::class,'index']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard',[UserController::class,'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store',[UserController::class,'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout',[UserController::class,'UserLogout'])->name('user.logout');
    Route::post('/user/update/password',[UserController::class,'UserUpdatePassword'])->name('user.update.password');
    Route::post('/add-to-cart',[CartController::class,'AddToCart'])->name('user.addtocart');
    Route::get('/user/cart_details',[CartController::class,'UserCartDetails'])->name('user.cart_details');
    Route::get('/delete/product/session/{id}',[CartController::class,'SessionProductDelete'])->name('session.product.delete');
    Route::get('/confirm/order',[CartController::class,'ConfirmOrder'])->name('confirm.order');

    //for payment gateway
    Route::post('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('easy.checkout');
    Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //for payment gateway


});

// Route::get('/dashboard', function () {
//      return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// It Students Of Nepal
// Get Job Ready: Power BI Data Analytics for All Levels



require __DIR__.'/auth.php';



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


//Admin Dashboard
Route::middleware(['auth','role:admin'])->group(function (){

    Route::get('/admin/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class,'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class,'AdminProfileStore'])->name('admin.data.store');

    Route::get('/admin/change/password',[AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password',[AdminController::class,'AdminUpdatePassword'])->name('admin.update.password');

});


//vendor Dashboard
Route::middleware(['auth','role:vendor'])->group(function (){

    Route::get('/vendor/dashboard',[VendorController::class,'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout',[VendorController::class,'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile',[VendorController::class,'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store',[VendorController::class,'VendorProfileStore'])->name('vendor.data.store');

    Route::get('/vendor/change/password',[VendorController::class,'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password',[VendorController::class,'VendorUpdatePassword'])->name('vendor.update.password');




    Route::controller(VendorProductController::class)->group(function(){
        Route::get('/vendor/all/product','VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product','VendorAddProduct')->name('add.vendor.product');
        Route::post('/vendor/store/product' , 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}' , 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product' , 'VendorUpdateProduct')->name('vendor.update.product');


        Route::get('/vendor/subcategory/ajax/{category_id}' , 'VendorGetSubCategory');
        // Route::post('/store/product' , 'StoreProduct')->name('store.product');
        // Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
        // Route::post('/update/product' , 'UpdateProduct')->name('update.product');
        Route::get('vendor/delete/product/{id}','DeleteVendorProduct')->name('vendor.delete.product');
        Route::get('vendor/product/inactive/{id}','vendorInactiveProduct')->name('vendor.product.inactive');
        Route::get('vendor/product/active/{id}','vendorActiveProduct')->name('vendor.product.active');

    });

});


Route::get('/user/show/vendor/details/{id}',[UserController::class,'VendorDetailsForUser'])->name('user.vendor.details');
Route::get('/vendor/login',[VendorController::class,'Vendor_Login'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/admin/login',[AdminController::class,'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/vendor/becomevendor',[VendorController::class,'BecomeVendor'])->name('become.vendor');

Route::post('/vendor/register',[VendorController::class,'VendorRegister'])->name('vendor.register');




Route::middleware(['auth','role:admin'])->group(function (){

    //start brand area
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brand','AllBrand')->name('all.brand');
        Route::get('/add/brand','AddBrand')->name('add.brand');
        Route::post('/store/brand','StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}','EditBrand')->name('edit.brand');
        Route::post('/update/brand/','UpdateBrand')->name('brand.update');
        Route::get('/delete/brand/{id}','DeleteBrand')->name('delete.brand');
    });
    //end brand area

    //start category area
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/update/category/','UpdateCategory')->name('category.update');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });
    //end category area

    //start subcategory area
    Route::controller(SubcategoryController::class)->group(function(){
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory/','UpdateSubCategory')->name('subcategory.update');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');
    });
    //end csubategory area

    //start vendor manage area
    Route::controller(AdminController::class)->group(function(){

        //start inactive vendor area
        Route::get('/inactive/vendor','InactiveVendor')->name('inactive.vendor');
        Route::get('/inactive/vendor/details/{id}','InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/activate/vendor','ActivateVendor')->name('activate.vendor');
        //end inactive vendor area

        //start active vendor area
        Route::get('/active/vendor','ActiveVendor')->name('active.vendor');
        Route::get('/active/vendor/details/{id}','ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactivate/vendor','InActivateVendor')->name('iactivate.vendor');
        //end active vendor area

    });
    //end vendor manage area


    //start product area
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product','AllProduct')->name('all.product');
        Route::get('/add/product','AddProduct')->name('add.product');
        Route::post('/store/product' , 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
        Route::post('/update/product' , 'UpdateProduct')->name('update.product');
        Route::get('/delete/product/admin/{id}','deleteProduct')->name('delete.product.admin');
        // Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });
    //end product area

    //start slider area
    Route::controller(SliderController::class)->group(function(){
        Route::get('/all/slider','AllSlider')->name('all.slider');
        Route::get('/add/slider','AddSlider')->name('add.slider');
        Route::post('/store/slider','StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}','EditSlider')->name('edit.slider');
        Route::post('/update/slider/','UpdateSlider')->name('slider.update');
        Route::get('/delete/slider/{id}','DeleteSlider')->name('delete.slider');
    });
    //end slider area

     //start banner area
     Route::controller(BannerController::class)->group(function(){
        Route::get('/all/banner','AllBanner')->name('all.banner');
        Route::get('/add/banner','AddBanner')->name('add.banner');
        Route::post('/store/banner','StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}','EditBanner')->name('edit.banner');
        Route::post('/update/banner/','UpdateBanner')->name('banner.update');
        Route::get('/delete/banner/{id}','DeleteBanner')->name('delete.banner');
    });
    //end banner area




});



    //frontend product route
    Route::get('product/details/{id}/{slug}',[IndexController::class,'ProductDetails']);

    Route::get('/product/view/modal/{id}',[IndexController::class,'ProductViewAjax']);




    //end frontend product