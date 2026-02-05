<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    // Coupon List
    public function index()
    {
        $coupons = Coupon::all(); // ❗ orderBy hata diya (safe)
        return view('admin.coupons.index', compact('coupons'));
    }

    // Show Create Form
    public function create()
    {
        return view('admin.coupons.create');
    }

    // Store Coupon
    public function store(Request $request)
    {
        $request->validate([
            'coupon_code'    => 'required|unique:coupons,coupon_code',
            'discount_type'  => 'required|in:fixed,rate',
            'discount_value' => 'required|numeric|min:1',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'status'         => 'required|in:active,inactive',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupons.index')
            ->with('success', 'Coupon Added Successfully');
    }

    // Edit
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'coupon_code'    => 'required|unique:coupons,coupon_code,' . $id,
            'discount_type'  => 'required|in:fixed,rate',
            'discount_value' => 'required|numeric|min:1',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'status'         => 'required|in:active,inactive',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')
            ->with('success', 'Coupon Updated Successfully');
    }

    // Delete
    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();

        return redirect()->route('coupons.index')
            ->with('success', 'Coupon Deleted Successfully');
    }
}
