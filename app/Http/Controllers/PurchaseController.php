<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with('products')->get(); // Lấy dữ liệu với quan hệ sản phẩm

        return view('manager.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('manager.purchases.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'nullable|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'purchase_date' => 'nullable|date',
        ]);

        $purchaseDate = $request->input('purchase_date') ?? now()->format('Y-m-d');
        $totalAmount = $request->input('total_amount');

        // Create a new purchase
        $purchase = Purchase::create([
            'supplier_id' => $request->input('supplier_id'),
            'total_price' => $totalAmount,
            'purchase_date' => $purchaseDate,
        ]);

        // Lọc các sản phẩm có số lượng lớn hơn 0
        $filteredProducts = collect($request->input('products'))
            ->filter(function ($productData) {
                return $productData['quantity'] > 0;
            });

        foreach ($filteredProducts as $productData) {
            $productId = $productData['product_id'];
            $quantity = $productData['quantity'];

            try {
                $product = Product::findOrFail($productId);
                $totalPrice = $quantity * $product->price;

                // Create purchase details
                PurchaseProduct::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'total_price' => $totalPrice
                ]);
            } catch (\Exception $e) {
                Log::error('Error creating purchase: ' . $e->getMessage());
                return back()->withErrors('Có lỗi xảy ra khi tạo đơn mua. Vui lòng thử lại.');
            }
        }

        return redirect()->route('purchases.index')->with('success', 'Đơn mua đã được tạo thành công!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return view('manager.purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $suppliers = Supplier::all();

        $supplierProducts = Product::where('supplier_id', $purchase->supplier_id)->get();

        return view('manager.purchases.edit', [
            'purchase' => $purchase,
            'suppliers' => $suppliers,
            'products' => $supplierProducts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);

        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'nullable|integer|min:0',
            'total_amount' => 'required|numeric|min:0',
            'purchase_date' => 'nullable|date',
        ]);

        $purchaseDate = $request->input('purchase_date') ?? now()->format('Y-m-d');
        $totalAmount = $request->input('total_amount');

        $purchase->update([
            'supplier_id' => $request->input('supplier_id'),
            'total_price' => $totalAmount,
            'purchase_date' => $purchaseDate,
        ]);

        // Xóa các sản phẩm không có số lượng
        $filteredProducts = collect($request->input('products'))
            ->filter(function ($productData) {
                return $productData['quantity'] > 0;
            });

        // Xóa các sản phẩm có số lượng là 0
        $existingProductIds = $purchase->products->pluck('product_id')->toArray();
        $submittedProductIds = $filteredProducts->pluck('product_id')->toArray();

        // Xóa các sản phẩm cũ không còn trong danh sách mới
        foreach ($purchase->products as $purchaseProduct) {
            if (!in_array($purchaseProduct->product_id, $submittedProductIds)) {
                $purchaseProduct->delete();
            }
        }

        foreach ($filteredProducts as $productData) {
            $productId = $productData['product_id'];
            $quantity = $productData['quantity'];

            $product = Product::findOrFail($productId);
            $totalPrice = $quantity * $product->price;

            $purchaseProduct = $purchase->products()->updateOrCreate(
                ['product_id' => $productId],
                ['quantity' => $quantity, 'total_price' => $totalPrice]
            );
        }

        return redirect()->route('purchases.index')->with('success', 'Đơn mua đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $purchase = Purchase::findOrFail($id);
            $purchase->products()->delete();
            $purchase->delete();

            return redirect()->route('purchases.index')->with('success', 'Đơn hàng và các sản phẩm liên quan đã được xóa thành công.');
        } catch (\Exception $e) {
            return back()->withErrors('Có lỗi xảy ra khi xóa đơn hàng. Vui lòng thử lại.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);
        $newStatus = $request->input('status');

        if ($purchase->status == 'completed' && $newStatus != 'completed') {
            return redirect()->route('purchases.index')->with('error', 'Không thể thay đổi trạng thái từ "Hoàn thành" sang trạng thái khác.');
        }

        if (in_array($newStatus, ['pending', 'completed', 'cancelled'])) {
            $purchase->status = $newStatus;
            $purchase->save();
        }

        return redirect()->route('purchases.index')->with('success', 'Trạng thái đơn mua đã được cập nhật thành công!');
    }
}
