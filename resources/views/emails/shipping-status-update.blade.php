<x-mail::message>

    <div>Dear {{ $delivery->order->customer->name }},</div>

    <div>Your order with ID {{ $delivery->order->id }} has been updated:</div>

    <div>New Status:{{ $delivery->status }}</div>

    <div>Thank you for choosing us!</div>

    <x-mail::button :url="url('/')">
        Redirect
    </x-mail::button>

</x-mail::message>
