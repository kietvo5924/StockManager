<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function showProfile()
    {
        $customer = Customer::where('email', Auth::user()->email)->first();

        if (!$customer) {
            return redirect()->route('dashboard')->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        return view('customer.profile', compact('customer'));
    }

    public function editProfile()
    {
        $customer = Customer::where('email', Auth::user()->email)->first();

        if (!$customer) {
            return redirect()->route('dashboard')->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        return view('customer.edit', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        // Cập nhật thông tin khách hàng trong bảng `customers`
        $customer = Customer::where('email', Auth::user()->email)->first();

        if (!$customer) {
            return redirect()->route('dashboard')->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $customer->update($request->only('name', 'phone', 'address'));

        return redirect()->route('customer.profile')->with('success', 'Cập nhật hồ sơ thành công.');
    }
}
