<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */
/*
  Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
  });
 */
Route::post('/get-product-attribute', ['as' => 'api.get_product_attribute', 'uses' => 'Api\ProductController@getProductAttribute']);
Route::post('/get-sale-product-attribute', ['as' => 'api.get_sale_product_attribute', 'uses' => 'Api\ProductController@getSaleProductAttribute']);
Route::post('/slugify', ['as' => 'api.slugify', 'uses' => 'Api\BackendController@slugify']);
Route::post('/select-address', ['as' => 'api.select_address', 'uses' => 'Api\BackendController@select_address']);
Route::get('/change-status', ['as' => 'api.change_status', 'uses' => 'Api\BackendController@changeStatus']);
Route::post('/apply-coupon', ['as' => 'api_apply', 'uses' => 'Api\BackendController@apply']);
Route::post('/save-tag', ['as' => 'api.save_tag', 'uses' => 'Backend\TagController@add']);
Route::post('/update-tag', ['as' => 'api.update_tag', 'uses' => 'Backend\TagController@update']);
Route::post('/remove-tag', ['as' => 'api.remove_tag', 'uses' => 'Backend\TagController@delete']);
Route::post('/get-tags', ['as' => 'api.get_tags', 'uses' => 'Backend\TagController@getTagsByGalleryId']);
Route::post('/add-subscriber', ['as' => 'api.add_subscriber', 'uses' => 'Api\FrontendController@addSubscriber']);
Route::post('/get-recent-post', ['as' => 'api.get_recent_post', 'uses' => 'Api\FrontendController@getRecentPost']);
Route::post('/get-recent-post-mobile', ['as' => 'api.get_recent_post_mobile', 'uses' => 'Api\FrontendController@getRecentPostMobile']);
Route::post('/register-marketing', ['as' => 'api.register-marketing', 'uses' => 'Api\FrontendController@registerMarketing']);
Route::post('/register-member', ['as' => 'api.register-member', 'uses' => 'Api\FrontendController@registerMember']);
Route::post('/register-construction', ['as' => 'api.register-construction', 'uses' => 'Api\FrontendController@registerConstruction']);
Route::post('/check-user-marketing', ['as' => 'api.check-user-marketing', 'uses' => 'Api\FrontendController@checkUserMarketing']);
Route::post('/check-user-construction', ['as' => 'api.check-user-construction', 'uses' => 'Api\FrontendController@checkUserConstruction']);
Route::post('/get-products', ['as' => 'api.get_products', 'uses' => 'Api\FrontendController@getProducts']);
Route::post('/get-gallery-tags', ['as' => 'api.get_gallery_tags', 'uses' => 'Api\FrontendController@getTags']);
Route::post('/get-products-by-tag', ['as' => 'api.get_products_by_tag', 'uses' => 'Api\FrontendController@getProductsByTag']);
Route::post('/send-contact', ['as' => 'api.send_contact', 'uses' => 'Api\FrontendController@sendContact']);
Route::post('/add-review', ['as' => 'api.add_review', 'uses' => 'Api\ReviewController@addReview']);
Route::post('/register-member', ['as' => 'api.register-member', 'uses' => 'Api\FrontendController@registerMember']);
Route::post('/upload', ['as' => 'api.upload', 'uses' => 'Api\FrontendController@upload']);
Route::post('/uploadImage', ['as' => 'api.uploadimage', 'uses' => 'Api\FrontendController@uploadImage']);
Route::post('/delete_image', ['as' => 'api.upload', 'uses' => 'Api\FrontendController@delete_image']);


Route::post('/panigate/{page}', ['as' => 'api.panigate', 'uses' => 'Api\FrontendController@panigate']);
