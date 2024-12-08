<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         $user = Auth::user();
    //         $token = $user->createToken('authToken')->plainTextToken;
    //         // Lấy danh sách vai trò của người dùng
    //         $roles = $user->roles->pluck('name'); // Trả về danh sách tên vai trò
    //         return response()->json([
    //             'message' => 'Login successful',
    //             'token' => $token,
    //             'user' => $user,
    //             'roles' => $roles, 
    //         ], 200);
    //     }

    //     return response()->json(['message' => 'Invalid credentials'], 401);
    // }
    public function login(Request $request)
    {
        // Xác thực đầu vào
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra nếu email không tồn tại
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'errors' => [
                    'email' => ['Email không tồn tại trong hệ thống.'],
                ],
            ], 422);
        }

        // Kiểm tra nếu mật khẩu không chính xác
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'errors' => [
                    'password' => ['Mật khẩu không đúng.'],
                ],
            ], 422);
        }

        // Đăng nhập thành công
        $request->session()->regenerate();
        $token = $user->createToken('authToken')->plainTextToken;
        $roles = $user->roles->pluck('name');

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
            'roles' => $roles,
        ], 200);
    }



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
