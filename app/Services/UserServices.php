<?php

namespace App\Services;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserServices
{
    // get all user
    public function getUser(Request $request)
    {
        // $users = User::with(['department', 'assignedUser', 'tickets'])->get();
        // return $users;
        
        // Nhận tham số từ request
        $id = $request->input('id'); // ID người dùng (tùy chọn)
        $fields = $request->input('fields', ['*']); // Các cột muốn lấy, mặc định lấy tất cả (*)

        // Nếu không có ID, trả về danh sách tất cả người dùng
        if (!$id) {
            // Đảm bảo rằng bạn chỉ định các cột cho các quan hệ
            $users = User::with([
                'department', 
                'assignedUser',
                'tickets',
            ])
                ->select($fields)  // Chỉ lấy các cột của bảng users
                ->get();

            return response()->json($users, 200);
        }

        // Nếu có ID, tìm người dùng theo ID
        $user = User::select($fields)->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    // get user phòng công nghệ
    public function getUserPCN()
    {
        $users = User::where('department_id', '1')->get();
        return $users;
    }
    // get name user
    public function getUserName(Request $request)
    {
        $user = User::find($request->user_id);
        return response()->json(['name' => $user->name]);
    }
    // register
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string',
            'phone' => 'required|numeric',
            'department' => 'required|numeric',
        ]);

        // User::create([
        //     'name' => $request->name, // Đảm bảo sử dụng đúng tên trường
        //     'phone' => $request->phone,
        //     'password' => Hash::make($request->password),
        //     'email' => $request->email,
        //     'department_id' => $request->department,
        // ]);
        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'phone' => $validatedData['phone'],
                'department_id' => $validatedData['department'],
            ]);
    
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during user creation',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json(['message' => 'User registered successfully'], 201); // Trả về phản hồi
    }

}
