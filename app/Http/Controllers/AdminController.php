<?php

namespace App\Http\Controllers;

use App\Events\UserRoleUpdated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();
        $users = User::where('id', '!=', $currentUser->id)->get();

        return view('admin.users', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $oldRole = $user->role;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,manager,staff,customer',
        ]);

        // Kiểm tra xem có đang cố gắng thay đổi vai trò thành 'customer' không
        if ($request->input('role') === 'customer' && $oldRole !== 'customer') {
            return redirect()->back()->with('error', 'Bạn không thể chuyển người dùng thành Customer từ vai trò khác.');
        }

        $user->update($request->only('name', 'email', 'role'));

        // Xử lý event nếu vai trò đã thay đổi
        if ($oldRole !== $user->role) {
            event(new UserRoleUpdated($user, $oldRole));
        }

        return redirect()->route('admin.users')->with('success', 'Cập nhật người dùng thành công.');
    }


    public function destroy(User $user)
    {
        DB::table('customers')->where('email', $user->email)->delete();
        $user->delete();

        return redirect()->route('admin.users')->with('status', 'Xóa người dùng thành công.');
    }
}
