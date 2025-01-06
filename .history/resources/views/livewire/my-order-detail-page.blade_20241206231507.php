<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">Order Details</h1>

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Customer
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            <div>
              @if ($address_firstname != null)
              {{ $address_firstname }} {{ $address_lastname }} 
              @else 
              {{ $user->where('id',$order->user_id)->value('name') }}
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 22h14" />
            <path d="M5 2h14" />
            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Order Date
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
              {{-- {{ $order_items[0]->created_at->format('d-m-Y') }} --}}
              {{ $order_items[0]->created_at }}
            </h3>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
            <path d="m12 12 4 10 1.7-4.3L22 16Z" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Order Status
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            
              @php
                  $status = '';

                  if($order->status == 'new'){
                      $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">New</span>';
                  }
                  if($order->status == 'processing'){
                      $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Processing</span>';
                  }
                  if($order->status == 'shipped'){
                      $status = '<span class="bg-orange-500 py-1 px-3 rounded text-white shadow">Shipped</span>';
                  }
                  if($order->status == 'delivered'){
                      $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Delivered</span>';
                  }
                  if($order->status == 'canceled'){
                      $status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Canceled</span>';
                  }  
              @endphp    
              {!! $status !!} {{ $order->sales_type }}
            
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
            <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
            <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Payment Status
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
              @php
                  $payment_status = '';

                  if($order->is_paid == 0){
                      $payment_status = '<span class="bg-red-400 py-1 px-3 rounded text-white shadow">Unpaid</span>';
                  }     
                  if($order->is_paid == 1){
                      $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Paid</span>';
                  }     
              @endphp   
              {!! $payment_status !!} {{ $paymentslast->payment_method }}
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->

  <div class="flex flex-col md:flex-row gap-4 mt-4">
    <div class="md:w-3/5">
      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <table class="w-full">
          <thead>
            <tr>
              <th class="text-left font-semibold">Product</th>
              <th class="text-left font-semibold">Price</th>
              <th class="text-center font-semibold">Qty</th>
              <th class="text-right font-semibold">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order_items as $item)
            <tr wire:key="{{ $item->id }}">
              <td class="py-4">
                <div class="flex items-center">
                  @if ($item->product->images != null)
                    <img class="h-16 w-16 mr-4" src="{{ url('storage', $item->product->images[0]) }}" alt="{{ $item->product->name }}">
                  @else
                    <img class="h-16 w-16 mr-4" src="{{ url('storage/food-packaging.png') }}" alt="{{ $item->product->name }}">
                  @endif
                  <span class="font-semibold">{{ $item->product->name }} {{ $item->product->variant }}</span>
                </div>
              </td>
              <td class="py-4">@currency($item->unit_amount)</td>
              <td class="py-4 text-center">
                {{ $item->quantity }}
              </td>
              <td class="py-4 text-right">@currency($item->total_amount)</td>
            </tr>          
            @endforeach

          </tbody>
        </table>
      </div>

      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-0">
        <h1 class="font-3xl font-bold text-slate-500 mb-3">Shipping Address</h1>
        <h1 class="font-3xl font-bold text-slate-500 mb-3">Order to {{ $order->branch->name }}</h1>
        <div class="flex justify-between items-center">
          <div class="pr-2"><p>
            @if(isset($address->street_address))
            {{ $address->street_address }}, {{ $villages->where('code',$address->village)->value('name') }}, {{ $districts->where('code',$address->district)->value('name') }}, {{ $cities->where('code',$address->city)->value('name') }}, {{ $states->where('code',$address->state)->value('name') }}, {{ $address->zip_code }}
            @else
            Alamat tidak terdaftar
            @endif
          </p></div>
          <div>
            <p class="font-semibold text-right">Phone :</p>
            <p>
              @if(isset($address->phone))
              {{ $address->phone }}
              @else
              -------
              @endif
            </p>
          </div>
        </div>
      </div>

    </div>
    <div class="md:w-2/5">
      <div class="bg-white rounded-lg shadow-md p-6 mb-4">
        <h1 class="font-3xl font-bold text-slate-500 mb-3">Notes</h1>
        <div class="[&>ul]:list-disc [&>ul]:ml-5">
          <p>
            {!! Str::markdown($order->notes) !!}
          </p>
        </div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Summary</h2>
        <div class="flex justify-between mb-2">
          <span>Subtotal</span>
          <span>@currency($item->order->grand_total + $item->order->discount - $item->order->shipping_amount)</span>
        </div>
        <div class="flex justify-between mb-2">
          <span>Discount</span>
          <span>@currency($item->order->discount)</span>
        </div>
        <div class="flex justify-between mb-2">
          <span>Shipping</span>
          <span>@currency($item->order->shipping_amount)</span>
        </div>
        <hr class="my-2">
        <div class="flex justify-between mb-4">
          <span class="font-semibold">Grand Total</span>
          <span class="font-semibold">@currency($item->order->grand_total)</span>
        </div>
        <div class="flex justify-between mb-2">
          <span class="">Payment</span>
          <span class="">@currency($item->order->total_payment)</span>
        </div>
        <div class="flex justify-between mb-2">
          <span class="">Cashback</span>
          <span class="">@currency($item->order->total_cashback)</span>
        </div>

      </div>

      
      <a href="/admin/orders/{{ $order->id  }}/edit" class="{{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}}">
      <button class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
        Edit
      </button>
        </a>
      
    </div>
  </div>

  <h3 class="text-xl font-bold text-slate-500 mt-10">Payment History</h3>

  <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Cashier</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Payment Method</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Nominal</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($payments->where('order_id', $order->id) as $key => $payment ) 
              @php
              $status = '';
              if($payment->payment_method == 'cash'){
                  $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Cash</span>';
              }
              if($payment->payment_method == 'transfer'){
                  $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Transfer</span>';
              }
              @endphp  
              <tr wire:key='{{ $payment->id }}' class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $user->where('id', $payment->updated_by)->value('name') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $payment->date_payment }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $status !!}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200 text-end">@currency($payment->nominal_plus)</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>