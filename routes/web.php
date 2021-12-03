<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Comments;
use App\Role;
use App\Country;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/post/example',array("as"=> "admin",function(){
//     $url = route("admin");
//     return "This is admin page ".$url;
// }));

//Route::get('/post/{id}/{name}',[PostController::class,'index']);

Route::resource('posts',"PostController");

Route::get('/contact',"PostController@contact");

Route::get('/post/{id}/{name}',"PostController@show_post");


// Route::get('/insert',function(){

//     DB::insert('insert into post(title,content) values(?,?)',['php Laravel','Best Framework for php']);
// });

Route::get('/read',function(){
    $results = DB::select('select * from post');

    return $results;
});


//Eloquent ORM

Route::get('/read/{id}',function($id){

    $read = Post::find($id);

    //only for remeber me
    //$post = Post::where('user_count','<',50)->firstOrFail();
    if(empty($read)){
        return "No user available";
    }
    return $read;
});


Route::get('/insert',function(){

    //for update we are use same save methods 
    $post = new Post;

    $post->title = 'Next Js';
    $post->content = 'THis is framework of React js ';

    return $post->save();
});

Route::get('/allcomment',function(){

    //Comments::create(['desc'=>'This comment from route ',0]);

    //$results = Comments::all();

    $results = Comments::withTrashed()->where('id',2)->restore();
    return $results;
});

Route::get('/findcomment',function(){

    Comments::where('id',2)->where('is_admin',0)->update(['desc'=>'This is update form route yeeessssss']);

    //return $results;
});

Route::get('/softdelete',function(){

    Comments::find(2)->delete();

});

//has one to one relation ship
Route::get('/user/{id}/post',function($id){
    return User::find($id)->post;
});

//has inverse also
Route::get('post/{id}/user',function($id){
    return Post::find($id)->user;
});

Route::get('/post/{id}',function($id){
    return User::find($id)->post;
});

//one to many relationship
// Route::get('/user/{id}',function($id){
//     $users_post = User::find($id)->posts;

//     return $users_post;
// });

//many to many
Route::get('/user/{id}/role',function($id){
    
    $users = User::find($id)->roles;

    return $users;
});

Route::get('/role/{id}/user',function($id){
    
    $users = Role::find($id)->users;

    return $users;
});

// Route::get('/users/pivot',function(){

//     $users = User::find(1);

//     foreach($users->roles as $role)
//     {
//         return $role->pivot->created_At;
//     }
// });

Route::get('/user/country',function(){

    $country = Country::find(2);

    foreach($country->posts as $post){

        $data[] = $post;
    }
    return $data;
});
