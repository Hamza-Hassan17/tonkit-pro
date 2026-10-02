<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountCodeController extends Controller
{
    public function index()
    {
        $codes = DiscountCode::orderByDesc('created_at')->paginate(20);

        return view('admin.discount-codes.index', compact('codes'));
    }

    public function create()
    {
        return view('admin.discount-codes.form', ['code' => new DiscountCode(['active' => true])]);
    }

    public function store(Request $request)
    {
        DiscountCode::create($this->validated($request));

        return redirect()->route('admin.discount-codes.index')->with('success', 'Discount code created.');
    }

    public function edit(DiscountCode $discountCode)
    {
        return view('admin.discount-codes.form', ['code' => $discountCode]);
    }

    public function update(Request $request, DiscountCode $discountCode)
    {
        $discountCode->update($this->validated($request, $discountCode));

        return redirect()->route('admin.discount-codes.index')->with('success', 'Discount code updated.');
    }

    public function destroy(DiscountCode $discountCode)
    {
        $discountCode->delete();

        return redirect()->route('admin.discount-codes.index')->with('success', 'Discount code deleted.');
    }

    private function validated(Request $request, ?DiscountCode $existing = null): array
    {
        $upper = strtoupper(trim((string) $request->input('code')));
        $request->merge(['code' => $upper]);

        $data = $request->validate([
            'code'        => [
                'required', 'string', 'max:40', 'regex:/^[A-Z0-9_-]+$/',
                Rule::unique('discount_codes', 'code')->ignore($existing?->id),
            ],
            'percent_off' => ['required', 'numeric', 'min:0', 'max:100'],
            'active'      => ['sometimes', 'boolean'],
        ]);
        $data['active'] = $request->boolean('active');

        return $data;
    }
}
