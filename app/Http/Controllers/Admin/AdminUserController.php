<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $currentAdminCount = User::where('role', 'admin')->count();
        $adminUser = Auth::user();

        // Cek jika user ingin mengubah rolenya sendiri (tidak diizinkan)
        if ($adminUser->id === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak bisa mengubah role akun Anda sendiri!');
        }

        // Cek apakah user adalah admin terakhir dan akan diubah menjadi user (tidak diizinkan)
        if ($user->role === 'admin' && $request->role === 'user' && $currentAdminCount <= 1) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa menghapus satu-satunya admin!');
        }

        // Update role user
        $user->update(['role' => $request->role]);

        return redirect()->route('admin.users.index')->with('success', 'Role user berhasil diperbarui.');
    }
}
