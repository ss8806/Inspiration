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

Route::get('/', 'TopController@top')->name('top');


Auth::routes();

Route::middleware('auth')
      ->group(function () {
        Route::get('ideas/index', 'IdeasController@showIdeas')->name('idea.index');
        Route::get('ideas/{idea}', 'IdeasController@showIdeaDetail')->name('idea');
        Route::get('ideas/{idea}/bought', 'IdeasController@showIdeaDetail')->name('idea.bought');
        Route::get('ideas/{idea}/buy', 'IdeasController@showBuyIdeaForm')->name('idea.buy');
        Route::post('ideas/{idea}/buy', 'IdeasController@buyIdea')->name('idea.buy');
        Route::get('sell', 'SellController@showSellForm')->name('sell');
        Route::post('sell', 'SellController@sellIdea')->name('sell');
        Route::get('ideas/{idea}/edit', 'EditIdeaController@showEditForm')->name('edit');
        Route::put('ideas/{idea}', 'EditIdeaController@editIdea')->name('update');
        Route::delete('ideas/{idea}/delete', 'EditIdeaController@destroyIdea')->name('delete');
        Route::get('ideas/{idea}/review', 'IdeasController@showIdeaReview')->name('idea.review');
        Route::get('ideas/{idea}/content', 'ContentController@showContent')->name('idea.content');
        Route::post('ideas/{idea}/review', 'ContentController@review')->name('review');
        
    });

Route::prefix('mypage')
->namespace('MyPage')
->middleware('auth')
->group(function () {
    Route::get('mypage', 'MypageController@showMypage')->name('mypage.mypage');
    Route::get('edit-profile', 'ProfileController@showProfileEditForm')->name('mypage.edit-profile');
    Route::post('edit-profile', 'ProfileController@editProfile')->name('mypage.edit-profile');
    Route::get('edit-icon', 'ProfileController@showProfileEditIcon')->name('mypage.edit-icon');
    Route::post('edit-icon', 'ProfileController@editIcon')->name('mypage.edit-icon');
    Route::get('edit-name', 'ProfileController@showProfileEditName')->name('mypage.edit-name');
    Route::post('edit-name', 'ProfileController@editName')->name('mypage.edit-name');
    Route::get('edit-email', 'ProfileController@showProfileEditEmail')->name('mypage.edit-email');
    Route::post('edit-email', 'ProfileController@editEmail')->name('mypage.edit-email');
    Route::get('edit-password', 'ProfileController@showProfileEditPassword')->name('mypage.edit-password');
    Route::post('edit-password', 'ProfileController@editPassword')->name('mypage.edit-password');
    Route::get('bought-ideas', 'BoughtIdeasController@showBoughtIdeas')->name('mypage.bought-ideas');
    Route::get('sold-ideas', 'SoldIdeasController@showSoldIdeas')->name('mypage.sold-ideas');
    Route::get('likes-ideas', 'LikesIdeasController@showlikesIdeas')->name('mypage.likes-ideas');
    Route::get('review-ideas', 'ReviewIdeasController@showReviewIdeas')->name('mypage.review-ideas');
});

Route::prefix('ideas')->name('ideas.')->group(function () {
    Route::put('/{idea}/like', 'IdeasController@like')->name('like')->middleware('auth');
    Route::delete('/{idea}/like', 'IdeasController@unlike')->name('unlike')->middleware('auth');
});
