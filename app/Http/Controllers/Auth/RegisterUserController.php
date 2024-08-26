<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{   

    public function store(Request $request): Response
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        $user = User::create($attributes);

        Auth::login($user);

        return response($user, Response::HTTP_CREATED);
    }

    public function destroy(Request $request): Response
    {
        $user = $request->user();

        Auth::logout();
        
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        $user->delete();
        
        return response()->noContent();
    }
}