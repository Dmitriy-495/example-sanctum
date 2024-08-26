<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{   

    public function show(Request $request)
    {
        return $request->user();
    }

    public function update(Request $request): Response
    {
        $attributes = $request->validate([
            'name' => ['string', 'min:1', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($request->user())],
            'password' => ['confirmed', Password::defaults()],
        ]);
        
        $request->user()->fill($attributes)->save();

        return response()->noContent();
    }
}