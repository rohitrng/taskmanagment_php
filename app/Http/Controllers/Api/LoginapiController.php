<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Facades\Validator;

class LoginapiController extends Controller
{
    // Registration
    public function register(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    // Login
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'password' => 'required',
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find the user by number
        $user = DB::connection('dynamic')->table('users')
        ->where('number', $request->number)
        ->first();

        if (!$user) {
            return response()->json(['error' => 'User a not found'], 404);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            // Return a JSON response if the password is incorrect
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        
        $users = [
            'id'=>$user->id,
            'number'=>$user->number,
            'email'=>$user->email,
            'created_at'=>$user->created_at,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => $users // You may want to exclude sensitive fields like password
        ], 200);
    }
}
