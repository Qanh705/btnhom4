<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function index()
    {
        if (!Session::has('admin_id')) {
            return redirect('admin/login');
        }

        // Kiểm tra bảng products có tồn tại không
        if (!Schema::hasTable('products')) {
            return view('admin.products.index', ['products' => [], 'error' => 'Bảng sản phẩm chưa được tạo. Vui lòng chạy lệnh "php artisan migrate" để tạo bảng.']);
        }

        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        if (!Session::has('admin_id')) {
            return redirect('admin/login');
        }

        // Kiểm tra bảng products có tồn tại không
        if (!Schema::hasTable('products')) {
            return back()->with('error', 'Bảng sản phẩm chưa được tạo. Vui lòng chạy lệnh "php artisan migrate" để tạo bảng.');
        }

        $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric|min:0',
            'category' => 'required',
            'image' => 'required|image|max:2048'
        ]);

        if (Product::where('name', $request->name)->exists()) {
            return back()->with('message', 'Tên sản phẩm đã tồn tại. Vui lòng nhập lại');
        }

        if ($request->file('image')->getSize() > 2000000) {
            return back()->with('message', 'Kích thước hình ảnh không phù hợp.');
        }

        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads'), $imageName);
        
        // Ensure the image path is relative to public directory
        $imagePath = 'uploads/' . $imageName;

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return back()->with('message', 'Sản phẩm được thêm thành công');
    }

    public function update(Request $request)
    {
        if (!Session::has('admin_id')) {
            return redirect('admin/login');
        }

        // Kiểm tra bảng products có tồn tại không
        if (!Schema::hasTable('products')) {
            return back()->with('error', 'Bảng sản phẩm chưa được tạo. Vui lòng chạy lệnh "php artisan migrate" để tạo bảng.');
        }

        if (isset($request->name) && is_array($request->name)) {
            foreach ($request->name as $id => $name) {
                $product = Product::find($id);
                if ($product) {
                    $product->update([
                        'name' => $name,
                        'price' => $request->price[$id],
                        'category' => $request->category[$id]
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        if (!Session::has('admin_id')) {
            return redirect('admin/login');
        }

        // Kiểm tra bảng products có tồn tại không
        if (!Schema::hasTable('products')) {
            return back()->with('error', 'Bảng sản phẩm chưa được tạo. Vui lòng chạy lệnh "php artisan migrate" để tạo bảng.');
        }

        $product = Product::find($id);
        if ($product) {
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $product->delete();
        }

        return redirect()->route('admin.products.index');
    }
} 