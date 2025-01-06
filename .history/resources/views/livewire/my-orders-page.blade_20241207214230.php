<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-center text-2xl font-bold text-slate-500">
      @if ( $isadmin == 1) 
      Orders | Paid Today<br>
      Cash @currency($paymentcash - $my_orders_sum_cashback) | Tf @currency($paymenttf)<br>
      {{-- @currency($my_orders_sum_today)<br> --}}
      Pending ({{$my_orders_sum_today_unpaid_count}}) @currency($my_orders_sum_today_unpaid)
      @else
      My Orders | @currency($my_orders_sum)
      @endif
    </h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead>
                <tr>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                  @if ( $isadmin == 1)
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Customer</th>
                  @endif
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Status</th>
                  <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Payment Status</th>
                  <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Order Amount</th>
                  <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($orders as $order) 
                @php
                    $status = '';
                    $payment_status = '';

                    if($order->status == 'new'){
                        $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow cursor-pointer"><i class="fa fa-thumb-tack" aria-hidden="true"></i> New</span>';
                    }
                    if($order->status == 'processing'){
                        $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow cursor-pointer"><i class="fa fa-refresh" aria-hidden="true"></i> Processing</span>';
                    }
                    if($order->status == 'shipped'){
                        $status = '<span class="bg-orange-600 py-1 px-3 rounded text-white shadow cursor-pointer"><i class="fa fa-truck" aria-hidden="true"></i> Shipped</span>';
                    }
                    if($order->status == 'delivered'){
                        $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow cursor-pointer"><i class="fa fa-check-circle" aria-hidden="true"></i> Delivered</span>';
                    }
                    if($order->status == 'canceled'){
                        $status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow cursor-pointer"><i class="fa fa-times" aria-hidden="true"></i> Canceled</span>';
                    }

                    if($order->is_paid == 0){
                        $payment_status = '<span class="bg-red-400 py-1 px-3 rounded text-white shadow">Unpaid</span>';
                    }     
                    if($order->is_paid == 0 && $order->status == 'canceled'){
                        $payment_status = '<span class="bg-yellow-400 py-1 px-3 rounded text-white shadow">Unpaid</span>';
                    }  
                    if($order->is_paid == 1){
                        $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Paid</span>';
                    }   
                    
                    if( empty($order->address->first_name) ){
                        $nama = '' ;
                    } else {
                        $nama = "-> " . $order->address->first_name . " " . $order->address->last_name;
                    }

                    $payment_last = $paymentlast->where('order_id', $order->id)->value('payment_method');

                @endphp     
                <tr wire:key='{{ $order->id }}' class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $order->id }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $order->date_order }}</td>
                  @if ( $isadmin == 1) 
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $order->user->name}} {{ $nama }}</td>
                  @endif
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 cursor-pointer" wire:click.prevent='changeStatus({{ $order->id }})'>{!! $status !!} {{ $order->sales_type }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $payment_status !!}  {{ $payment_last }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($order->grand_total)</td>
                  <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    {{-- <a href='/my-orders/{{ $order->id }}' class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">View Details</a> --}}
                    <div class="hs-dropdown [--strategy:fixed] [--adaptive:none] [--trigger:hover]">
                      <i class="fa fa-bars" aria-hidden="true"></i>
                      <div class="text-start hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-transparent before:absolute top-full before:-top-5 before:-start-0 before:w-full before:h-5">
                        
                        <div class="py-2">
                          <a href="{{ route('my-orders.show', ['order_id' => $order->id]) }}" class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">Details</a>
                        </div>
                        <div class="py-2">
                          <a href="{{ route('printid', [$order->id]) }}" class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                        </div>
                      
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
  
              </tbody>
            </table>
          </div>
        </div> 
        
        <!-- pagination start -->
        <style>
          nav div div p {
              margin-left: 20px;
              margin-right: 20px;
          }
        </style>
        <div class="flex justify-center">
        {{-- {{ $orders->links('pagination::bootstrap-4') }} --}}
        {{ $orders->links() }}
        </div>
        <!-- pagination end -->

      </div>
    </div>
  </div>