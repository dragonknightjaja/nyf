<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
}); 
 
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('email/verify/{token}',['as' => 'email.verify', 'uses' => 'EmailController@verify']);

Route::get('questions/index','QuestionController@index')->name('question.index');
Route::get('questions/create','QuestionController@create')->name('question.create');
Route::post('questions/store','QuestionController@store')->name('question.store');
Route::get('questions/show/{id}','QuestionController@show')->name('question.show');
Route::get('questions/edit/{id}','QuestionController@edit')->name('question.edit');
Route::any('questions/update/{id}','QuestionController@update')->name('question.update');
Route::delete('questions/delete/{id}','QuestionController@destroy')->name('question.delete');


Route::get('articles/create','ArticleController@create')->name('article.create');
Route::post('articles/store','ArticleController@store')->name('article.store');
Route::get('articles/show/{id}','ArticleController@show')->name('article.show');
// Route::resource('questions','QuestionsController',['names'=>[
//     'create'=>'question.create',
//     'show'=>'question.show',
//     ]]);//注意第三个参数 
//Route::post('password/update','PasswordController@update');
Route::get('test','TestController@test')->name('test');