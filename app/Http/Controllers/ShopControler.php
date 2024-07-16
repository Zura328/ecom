<?php

namespace App\Http\Controllers;

use App\Mail\ShippingStatusUpdate;
use App\Mail\UpdateShipping;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ShopControler extends Controller
{
    //
    public function index()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            $totalProducts = Products::count();
            $totalOrders = Order::count();
            $pendingOrders = Order::where('status', 'pending')->count();

            $relevantOrderIds = Shipping::query()
                ->where('status', 'received')
                ->orwhere('status', 'delivered')
                ->orWhere('payment_mode', 'card')
                ->orWhere('payment_mode', 'online')
                ->pluck('order_id');

            // Calculate total revenue for these orders
            $totalRevenue = Order::whereIn('id', $relevantOrderIds)->sum('total_price');

            // Fetch data for charts
            $orderStatusCounts = Order::select('status', \DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();

            // Fetch shipping statuses
            $shippingStatusCounts = Shipping::select('status', \DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();

            // Prepare data for charts
            $orderStatusLabels = $orderStatusCounts->pluck('status');
            $orderStatusData = $orderStatusCounts->pluck('count');
            $shippingStatusLabels = $shippingStatusCounts->pluck('status');
            $shippingStatusData = $shippingStatusCounts->pluck('count');

            return view('dashboard', compact(
                'totalProducts',
                'totalOrders',
                'pendingOrders',
                'totalRevenue',
                'orderStatusLabels',
                'orderStatusData',
                'shippingStatusLabels',
                'shippingStatusData'
            ));
        }
        $products = Products::all(); // Fetch all products
        return view('welcome', compact("products"));
    }

    public function products(Request $request)
    {
        $query = Products::query();

        // Search filter
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        } else {
            $search = null; // Default to null if no search term is provided
        }

        // Gender filter
        if ($request->has('gender') && $request->input('gender') != "") {
            $gender = $request->input('gender');
            $query->where('gender', $gender);
        } else {
            $gender = null; // Default to null if no gender filter is applied
        }

        // Season filter
        if ($request->has('season') && $request->input('season') != "") {
            $season = $request->input('season');
            $query->where('season', $season);
        } else {
            $season = null; // Default to null if no season filter is applied
        }

        // Category filter
        if ($request->has('category') && $request->input('category') != "") {
            $category = $request->input('category');
            $query->where('category', $category);
        } else {
            $category = null; // Default to null if no category filter is applied
        }

        $products = $query->paginate(15)->appends([
            'search' => $search,
            'gender' => $gender,
            'season' => $season,
            'category' => $category
        ]);

        // Load genders, seasons, and categories for dropdowns
        $genders = ['male', 'female'];
        $seasons = ['summer', 'winter'];
        $categories = ['casual', 'formal'];

        return view('products', compact('products', 'search', 'genders', 'seasons', 'categories'));
    }
    //shows pending shippings
    public function pending()
    {
        $pendingOrders = Shipping::where('status', 'pending')->orwhere('status', 'on the way')->orwhere('status', 'delivered')->orderby('status', 'asc')->with('order.product')->get();
        return view('shipping', compact('pendingOrders'));
    }



    // Add item to cart
    public function addtocart(Request $request, Products $product)
    {
        // Validate incoming request
        $request->validate([
            'size' => 'required', // Example: Only allow sizes S, M, L
            'quantity' => 'required|integer|min:1', // Quantity must be at least 1
        ]);

        // Create a new order or fetch an existing one (based on your business logic)
        $quantitysize = 0;
        switch ($request->size) {
            case "small":
                $quantitysize = $product->small;
                break;
            case "medium":
                $quantitysize = $product->medium;
                break;
            case "large":
                $quantitysize = $product->large;
                break;
            case "xlarge":
                $quantitysize = $product->xlarge;
                break;
        }

        if ($quantitysize >= $request->quantity) {
            Order::create([
                'customer_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'status' => "pending",
                'total_price' => $product->price * $request->quantity,
            ]);
            return redirect()->back()->with('success', 'Product added to order successfully.');
        } else {
            return redirect()->back()->with('fail', ' Your order has not been placed. There is only ' . $quantitysize . ' left of the selected product and size.');
        }
    }

    public function checkout()
    {
        // Fetch pending orders (if needed) to display in the checkout summary
        $orders = Order::where('status', 'pending')->where('customer_id', Auth::user()->id)->get(); // Adjust query as per your application logic

        return view('checkout', compact('orders'));
    }

    public function processCheckout(Request $request)
    {
        foreach ($request->input('order_ids') as $orderId) {
            $order = Order::find($orderId);
            if (!$order) {
                return redirect()->route('checkout')->with('fail', 'Order not found!');
            }

            $product = Products::find($order->product_id);
            if (!$product) {
                return redirect()->route('checkout')->with('fail', 'Product not found!');
            }

            // Check if quantity is sufficient
            switch ($order->size) {
                case "small":
                    $quantitySize = $product->small;
                    break;
                case "medium":
                    $quantitySize = $product->medium;
                    break;
                case "large":
                    $quantitySize = $product->large;
                    break;
                case "xlarge":
                    $quantitySize = $product->xlarge;
                    break;
                default:
                    $quantitySize = 0;
            }

            if ($quantitySize < $order->quantity) {
                return redirect()->route('checkout')->with('fail', 'Not enough quantity available for ' . $product->name);
            }

            // Create shipping record
            $deliveryGuy = User::where('role', 'delivery')->first();
            Shipping::create([
                'order_id' => $orderId,
                'delivery_guy_id' => $deliveryGuy->id,
                'payment_mode' => $request->input('payment_mode'),
                'shipping_address' => $request->input('shipping_address'),
                'shipping_method' => $request->input('shipping_method'),
                'status' => 'pending'
            ]);

            // Update order status and product quantity

            $newQuantity = $quantitySize - $order->quantity;
            $product->update([$order->size => $newQuantity]);
            $order->update(['status' => 'checked out']);
            if ($request->input('shipping_method') == 'regular')
                $order->update(['total_price' => $order->total_price +  50]);
            else
                $order->update(['total_price' => $order->total_price +  150]);
        }

        return redirect()->route('checkout')->with('success', 'Checkout successful!');
    }

    public function delivery()
    {
        $deliveries = Shipping::where('delivery_guy_id', Auth::user()->id)
            ->with(['order', 'order.product'])->where('status', '!=', 'delivered')->where('status', '!=', 'received')->orderby('shipping_method')
            ->get();

        return view('delivery', compact('deliveries'));
    }

    public function updateStatusDelivery(Request $request, $id)
    {
        $delivery = Shipping::findOrFail($id);

        // Validate request data if necessary

        // Update status based on current status
        switch ($delivery->status) {
            case 'pending':
                $newStatus = 'on the way';
                break;
            case 'on the way':
                $newStatus = 'delivered';
                break;
                // Add more cases as needed
        }

        $delivery->update(['status' => $newStatus]);

        // Send email notification to customer
        if ($delivery->order->customer->email) {
            Mail::to($delivery->order->customer->email)->send(new UpdateShipping($delivery));
        }

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function updateStatus($id)
    {
        $shipping = Shipping::findOrFail($id);
        $shipping->status = 'received';
        $shipping->save();

        return redirect()->back()->with('success', 'Shipping status updated to received.');
    }
}
