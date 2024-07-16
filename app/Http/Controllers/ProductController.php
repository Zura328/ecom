<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Shipping;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function showUploadForm()
    {
        return view('upload_csv');
    }

    public function uploadCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $file = fopen($path, 'r');
        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            // Parse the date fields
            $created_at = Carbon::createFromFormat('d/m/Y H:i', $data['created_at'])->format('Y-m-d H:i:s');
            $updated_at = Carbon::createFromFormat('d/m/Y H:i', $data['updated_at'])->format('Y-m-d H:i:s');

            // Update the product
            Products::where('id', $data['id'])->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'image' => $data['image'],
                'gender' => $data['gender'],
                'small' => $data['small'],
                'medium' => $data['medium'],
                'large' => $data['large'],
                'xlarge' => $data['xlarge'],
                'season' => $data['season'],
                'category' => $data['category'],
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }

        fclose($file);

        return redirect('/upload-csv')->with('success', 'Products updated successfully!');
    }

    public function productTable()
    {
        $products = Products::paginate(10); // Change 10 to the number of products per page you want
        return view('products.index', compact('products'));
    }

    public function shippingTable()
    {
        $shippings = Shipping::paginate(10); // Change 10 to the number of products per page you want
        return view('shipping.index', compact('shippings'));
    }

    public function orderTable()
    {
        $orders = Order::paginate(10); // Change 10 to the number of products per page you want
        return view('order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'gender' => 'required',
            'season' => 'required',
            'category' => 'required',
            'small' => 'required|integer',
            'medium' => 'required|integer',
            'large' => 'required|integer',
            'xlarge' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $product = new Products;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->gender = $request->gender;
        $product->season = $request->season;
        $product->category = $request->category;
        $product->small = $request->small;
        $product->medium = $request->medium;
        $product->large = $request->large;
        $product->xlarge = $request->xlarge;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function updateStock(Request $request, $id)
    {
        $product = Products::findOrFail($id);
        $product->small = $request->input('small');
        $product->medium = $request->input('medium');
        $product->large = $request->input('large');
        $product->xlarge = $request->input('xlarge');
        $product->save();

        return redirect()->back()->with('success', 'Stock updated successfully.');
    }
}
