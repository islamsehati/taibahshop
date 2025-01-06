<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-center text-2xl font-bold text-slate-500">
      @if ( $isadmin == 1) 
      Orders | Paid Today<br>
      Cash @currency($paymentcash - $my_orders_sum_cashback) | Tf @currency($paymenttf)<br>
      {{-- @currency($my_orders_sum_today)<br> --}}
      Pending ({{$my_orders_sum_unpaid_count}}) @currency($my_orders_sum_unpaid)
      @else
      My Orders | @currency($my_orders_sum)
      @endif
    </h1>
    
    @auth
          @if ($isadmin == 1)
    <div class="flex mt-3">
      <div class="mx-auto flex bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600">
        <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
          <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
            Orders
          </button>
          <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
            Payment History
          </button>
                   
        </nav>
      </div>
    </div>
    @endauth
    @endif 
    
    <div class="mt-3">
      <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
        <div class="flex flex-col bg-white p-0 rounded mt-4 shadow-lg">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
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
                            $status = '<span class="bg-orange-500 py-1 px-3 rounded text-white shadow cursor-pointer"><i class="fa fa-truck" aria-hidden="true"></i> Shipped</span>';
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
                            $payment_status = '<span class="bg-gray-600 py-1 px-3 rounded text-white shadow">Unpaid</span>';
                        }  
                        if($order->is_paid == 1){
                            $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Paid</span>';
                        }   
                        
                        if( empty($order->address->first_name) ){
                            $nama = '' ;
                        } else {
                            $nama = "-> " . $order->address->first_name . " " . $order->address->last_name;
                        }
                        
                        if( empty($order->address->phone) ){
                            $telp = '' ;
                        } else {
                            $telp = $order->address->phone;
                        }
    
                        $payment_last = $paymentlast->where('order_id', $order->id)->value('payment_method');
    
                    @endphp     
                    <tr wire:key='{{ $order->id }}' class="odd:bg-white even:bg-gray-100 hover:bg-yellow-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                      <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">

                        <div class="py-1 flex justify-between">
                          <span>{{ $order->id }}</span>
                          <span class="font-medium">{{ $order->user->name}} {{ $nama }} </span>
                        
                        {{-- <a href='/my-orders/{{ $order->id }}' class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">View Details</a> --}}
                        <span class="hs-dropdown [--strategy:fixed] [--adaptive:none] [--trigger:hover] hover:lg:text-yellow-500">
                          <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                          <div class="text-start hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white p-2 rounded-md shadow-lg before:absolute top-full before:-top-5 before:-start-0 before:w-full before:h-5">
                            
                            <div class="py-1">
                              <a href="{{ route('my-orders.show', ['order_id' => $order->id]) }}"><button class="w-full bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-slate-400">Details</button></a>
                            </div>
                            <div class="py-1">
                              <a href="{{ route('printid', [$order->id]) }}"><button class="w-full bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-400"><i class="fa fa-print" aria-hidden="true"></i> Print</button></a>
                            </div>
                            <div class="py-1">
                              <a href="{{ route('printkitchen', [$order->id]) }}"><button class="w-full bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-400"><i class="fa fa-coffee" aria-hidden="true"></i> Kitchen</button></a>
                            </div>
                          
                          </div>
                        </span>
                        </div>
                        <hr>
                        <div class="py-1 flex mt-2">
                          <span class="w-1/3 text-center"><span wire:click.prevent='changeStatus({{ $order->id }})'>{!! $status !!}</span>{{ $order->sales_type }}</span>
                          
                          <span class="w-1/3 text-center">{!! $payment_status !!}</span>
                          <span class="w-1/3 text-end">{{ $payment_last }}</span>
                        </div>

                        <div class="py-1 flex">
                        <span class="{{ Str::substr($order->date_order, 0, 10) != $today ?'text-green-600' : ''}} w-1/3">{{ $order->date_order }}</span>
                        <span class="w-1/3 text-center"><a href="http://wa.me/{{$telp}}">{{$telp}}</a></span>
                        <span class="w-1/3 text-end font-medium">@currency($order->grand_total)</span>
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
            <div class="flex justify-center my-5">
            {{-- {{ $orders->links('pagination::bootstrap-4') }} --}}
            {{ $orders->links() }}
            </div>
            <!-- pagination end -->
    
          </div>
        </div>
      </div>
      <div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
        @auth
        @if ($isadmin == 1)
        <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                  <thead>
                    <tr>
                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Method</th>
                      <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Payment</th>
                      <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Cashback</th>
                      <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Total</th>
                      <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($payments as $payment) 
                    @php
                        $payment_mtd = '';
                        $dateLast = $paymentlast->where('order_id',$payment->order_id)->value('date_payment');

                        if($payment->payment_method === 'cash'){
                            $payment_mtd = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Cash</span>';
                        } 
                        if($payment->payment_method === 'transfer'){
                            $payment_mtd = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Transfer</span>';
                        }   

                        if($payment->payment_method === 'cash' && $dateLast == $payment->date_payment){
                            $cashback = $orders->where('id', $payment->order_id)->where('is_paid', 1)->value('total_cashback');
                        }   else {
                          $cashback = 0;
                        }

                    @endphp     
                    <tr wire:key='{{ $payment->id }}' class="odd:bg-white even:bg-gray-100 hover:bg-yellow-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $payment->order_id }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $payment->date_payment }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $payment_mtd !!}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($payment->nominal_plus)</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($cashback)</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($payment->nominal_plus - $cashback)</td>
                      <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                        <div class="hs-dropdown [--strategy:fixed] [--adaptive:none] [--trigger:hover] hover:lg:text-yellow-500">
                          <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                          <div class="text-start hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white p-2 rounded-md shadow-lg before:absolute top-full before:-top-5 before:-start-0 before:w-full before:h-5">                       
                            <div class="py-1">
                              <a href="/my-orders/{{ $payment->order_id }}"><button class="w-full bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-slate-400">Details</button></a>
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
            {{-- {{ $payments->links('pagination::bootstrap-4') }} --}}
            {{-- {{ $payments->links() }} --}}
            </div>
            <!-- pagination end -->

          </div>
        </div>
        @endif
        @endauth
      </div>
    </div> 


  </div>