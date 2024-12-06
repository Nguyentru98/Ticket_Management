<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            // Lấy danh sách vai trò của người dùng
            $roles = $user->roles->pluck('name'); // Trả về danh sách tên vai trò
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
                'roles' => $roles, 
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    // check login
    // public function login(Request $request)
    // {
    // // Xác thực thông tin đăng nhập
    // $credentials = $request->validate([
    //     'email' => 'required|email',
    //     'password' => 'required'
    // ], [
    //     'email.required' => 'Email is required.',
    //     'email.email' => 'Email must be a valid email address.',
    //     'password.required' => 'Password is required.'
    // ]);

    // // Kiểm tra thông tin người dùng
    // $user = User::where('email', $credentials['email'])->first();
    //     if (!$user || !Hash::check($credentials['password'], $user->password)) {
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }

    //     // Kiểm tra trạng thái hoạt động của người dùng
    //     if (!$user->is_active) {
    //         return response()->json(['message' => 'Your account is inactive.'], 403);
    //     }

    //     // Lấy danh sách vai trò của người dùng
    //     $roles = $user->roles->pluck('name'); // Trả về danh sách tên vai trò

    //     // Tạo token cho người dùng
    //     $token = $user->createToken('authToken')->plainTextToken;

    //     // Trả về phản hồi bao gồm token và vai trò
    //     return response()->json([
    //         'message' => 'Login successful',
    //         'token' => $token,
    //         'user' => $user, // Thông tin người dùng
    //         'roles' => $roles // Danh sách vai trò
    //     ], 200);
    // }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
