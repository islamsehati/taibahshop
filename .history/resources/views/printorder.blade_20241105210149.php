<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

<style>
    h4 {
    margin: 0;
}
.w-full {
    width: 100%;
}
.w-half {
    width: 50%;
}
.margin-top {
    margin-top: 1.25rem;
}
.footer {
    font-size: 0.875rem;
    padding: 1rem;
    background-color: rgb(241 245 249);
}
table {
    width: 100%;
    border-spacing: 0;
}
table.products {
    font-size: 0.875rem;
}
table.products tr {
    background-color: rgb(96 165 250);
    border: 1px solid black;
}
table.products th {
    color: #ffffff;
    padding: 0.5rem;
    border: 1px solid black;
}
table tr.items {
    background-color: rgb(241 245 249);
    border: 1px solid black;
}
table tr.items td {
    padding: 0.5rem;
    border: 1px solid black;
}
table tr.items .angka {
    text-align: right;
}
.total {
    text-align: right;
    margin-top: 1rem;
    font-size: 0.875rem;
}
</style>
<script type = 'text/javascript'>  
    window.onload = function(){ window.print(); }
</script>
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ url('storage/Taibah-FC-LOGO-bulat-aja-w-Stroke.png') }}" alt="ZaharaPOS" width="100" />
            </td>
            <td class="w-half">
                <h4>Taibah Fried Chicken</h4>
            </td>
        </tr>
    </table>
 
    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>{{ $order->code_tr }}</h4></div>
                    <div>{{ $order->user->name }}</div>
                    @foreach ($addresses as $address)
                    <div>{{ $address->street_address }}, {{ $villages->where('code',$address->village)->value('name') }}, {{ $districts->where('code',$address->district)->value('name') }}, {{ $cities->where('code',$address->city)->value('name') }}, {{ $states->where('code',$address->state)->value('name') }}, {{ $address->zip_code }}</div>
                    @endforeach
                </td>
                <td class="w-half">
                    <div><h4>Status :</h4></div>
                    <div>
                    @if ( $order->is_paid  == 1)
                        Paid
                    @else
                        Unpaid
                    @endif
                </div> 
                    <div>{{ $order->status }}</div>
                </td>
            </tr>
        </table>
    </div>
 
    <div class="margin-top">
        <table class="products">
            <tr>
                {{-- <th>No</th> --}}
                <th>Desc</th>
                <th>Qty</th>
                <th>Price</th>
            </tr>
                {{-- @php 
                    $no =1;    
                @endphp --}}
                @foreach ($orderitems as $orderitem)
                <tr class="items">
                    {{-- <td class="">{{ $no++ }}</td> --}}
                    <td class="">{{ $orderitem->product->name }} {{ $orderitem->product->variant }} @ {{ $orderitem->unit_amount }}</td>
                    <td class="angka">{{ $orderitem->quantity }}</td>
                    <td class="angka">@currency($orderitem->total_amount)</td>
                </tr>
                @endforeach
        </table>
    </div>
 
    <div class="total">
        <div>Sub @currency($order->grand_total + $order->discount - $order->shipping_amount)</div>
        <div>Discount @currency($order->discount)</div>
        <div>Shipping @currency($order->shipping_amount)</div>
        <div>Total @currency($order->grand_total)</div>
    </div>
 
    <div class="footer margin-top">
        <div>Thank you</div>
        <div>&copy; TaibahPOS</div>
    </div>
</body>
</html>