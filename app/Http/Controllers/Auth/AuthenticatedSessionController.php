<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{   

    public function store(Request $request): Response
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email',],
            'password' => ['required', 'string'],
        ]);
         
        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();
            
            return response($request->user(), Response::HTTP_CREATED);
        }

        return response([
            'email' => 'Введенные учетные данные не верны...'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function destroy(Request $request): Response
    {
        Auth::logout();
        
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return response()->noContent();
    }
}