<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

<style>
 
</style>

</head>
<body style="font-size: 12px; margin-bottom: 2em;">
            <div style="text-align: center;">
                <img src="{{ url('storage/Taibah-FC-LOGO-bulat-aja-w-Stroke.png') }}" alt="ZaharaPOS" width="100" />
                <h4>Taibah Fried Chicken</h4>
            </div>
            <div>
                <div style="justify-content: space-between; display: flex;">{{ $order->code_tr }}</div>
                <div style="display: flex; justify-content: flex-end; font-weight: bold; font-size: 20px;">{{ $order->id }}</div>
                    <div>Order by : {{ $order->user->name }}</div>
                    @if ($address->value('phone') != null)
                    <div>
                        for : {{ $address->value('first_name') }} {{ $address->value('last_name') }}, <br>
                        {{ $address->value('phone') }}
                    </div>
                    @elseif ($user->value('phone') != null)
                    <div>
                        an {{ $user->value('first_name') }} {{ $user->value('last_name') }}, <br>
                        {{ $user->value('phone') }}
                    </div>
                    @else
                    @endif

                    @if ($address->value('street_address') != null)
                    <div style="text-align: right;">
                        {{ $address->value('street_address') }}, <br>
                        {{ $villages->where('code',$address->value('village'))->value('name') }},
                        {{ $districts->where('code',$address->value('district'))->value('name') }},
                        {{ $cities->where('code',$address->value('city'))->value('name') }},
                        {{ $states->where('code',$address->value('state'))->value('name') }},<br>
                        {{ $address->value('zip_code') }}
                    </div>
                    @elseif ($user->value('street_address') != null)
                    <div style="text-align: right;">
                        {{ $user->value('street_address') }}, <br>
                        {{ $villages->where('code',$user->value('village'))->value('name') }},
                        {{ $districts->where('code',$user->value('district'))->value('name') }},
                        {{ $cities->where('code',$user->value('city'))->value('name') }},
                        {{ $states->where('code',$user->value('state'))->value('name') }},<br>
                        {{ $user->value('zip_code') }}
                    </div>
                    @else
                    @endif

                    Status :
                    @if ( $order->is_paid  == 1)
                        Paid
                    @else
                        Unpaid
                    @endif
                    - {{ $paymentlast->where('order_id', $order->id)->value('payment_method') }}<br>
                    {{ $order->status }} - {{ $order->sales_type }}
            </div>
             <br> 
    <div class="margin-top">
        <b>order items</b>
        @foreach ($orderitems as $orderitem)
        <div class="items">
            <div style="text-align: left;">{{ $orderitem->product->name }} {{ $orderitem->product->variant }}</div>
            <div style="justify-content: space-between; display: flex;"><span style="margin-left: 1em;">@currency($orderitem->unit_amount)</span><span>x{{ $orderitem->quantity }} = @currency($orderitem->total_amount)</span></div>
        </div>
        @endforeach
    </div>
 <br>
    <div class="total">
        <div style="justify-content: space-between; display: flex;"><span>Sub</span><span>@currency($order->grand_total + $order->discount - $order->shipping_amount)</span></div>
        <div style="justify-content: space-between; display: flex;"><span>Discount</span><span>@currency($order->discount)</span></div>
        <div style="justify-content: space-between; display: flex;"><span>Shipping</span><span>@currency($order->shipping_amount)</span></div>
        <div style="justify-content: space-between; display: flex;"><span>Total</span><span>@currency($order->grand_total)</span></div>
    </div>
 <hr size="3" color="black">
    <div style="justify-content: space-between; display: flex;"><span>Bayar</span><span>@currency($order->total_payment)</span></div>
    <div style="justify-content: space-between; display: flex;">
        @if ( $order->total_cashback < 0)
            <span>Belum Bayar</span>
        @else
            <span>Kembali</span>
        @endif 
         <span>@currency($order->total_payment - $order->grand_total)</span>
    </div>
 <br>
    <div style="text-align: center;">
        <div>Thank you</div>
        <div>&copy; TaibahPOS</div>
    </div>

    <script type = 'text/javascript'>  
        window.onload = function(){ window.print(); }
    </script>
</body>
</html>