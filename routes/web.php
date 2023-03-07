<?php

use App\Http\Controllers\ProfileController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $posts = Post::latest()->get();
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/store', function(Request $request) {
    
    $images = $request->file('images');
    
    foreach ($images as $image) {

        $post = new Post();

        $image_name = $image->getClientOriginalName();
        $image->move(public_path('images'), $image_name);

        $post->image = $image_name;
        $post->user_id = Auth::user()->id;
        $post->save();
    }

    return redirect('/dashboard');

});
