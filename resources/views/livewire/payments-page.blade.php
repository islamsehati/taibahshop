<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-center text-2xl font-bold text-slate-500">
      Payments List
    </h1>
    
    <div class="flex justify-between items-center mt-3">
      <div class="flex">
        <div class="mx-auto flex bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600">
          <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
            <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-1 px-2 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-yellow-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
              Payments
            </button>
            <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-1 px-2 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-yellow-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
              Unpaid
            </button>
                    
          </nav>
        </div>
      </div>
  
      <div class="inline-flex flex-wrap justify-end text-end">
      <div class=""><span>From</span> <input wire:model.live='date_awal' type="date" name="date_awal" id="date_awal" class="bg-white px-2"></div>
      <div class=""><span>To</span> <input wire:model.live='date_akhir' type="date" name="date_akhir" id="date_akhir" class="bg-white px-2"></div>
      </div>
    </div>
    
    <div class="mt-3">
      <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
        <div class="flex flex-col bg-white p-5 rounded-lg mt-4 shadow-lg">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                  <thead>
                    <tr>
                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date Payment</th>
                      <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Method</th>
                      <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Nominal</th>
                      <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Kembali</th>
                      <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Total</th>
                    </tr>
                  </thead>
                  <tbody>
  
                    @foreach ($payments as $payment)     
                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-green-400 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><a href="/my-orders/{{ $orders->where('id',$payment->order_id)->value('id') }}">{{ $orders->where('id',$payment->order_id)->value('id') }}</a></td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $payment->date_payment }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $payment->payment_method }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@formatNumber($payment->nominal_plus)</td>
                      @if ($orders->where('id',$payment->order_id)->value('paid_at') == $payment->updated_at)
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@formatNumber($orders->where('id',$payment->order_id)->value('total_cashback'))</td>                      
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@formatNumber(($payment->nominal_plus) - $orders->where('id',$payment->order_id)->value('total_cashback'))</td>                      
                      @else
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">0</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@formatNumber($payment->nominal_plus)</td>
                      @endif
                    </tr>
                    @endforeach
                    @php
                      $jumlahkembalian = 0;
                      foreach($payments as $payment) {
                        if ($orders->where('id',$payment->order_id)->value('paid_at') == $payment->updated_at) {
                          $jumlahkembalian += $orders->where('id',$payment->order_id)->value('total_cashback');
                        } 
                      }
                    @endphp
      
                  </tbody>
                  <tfoot>
                    <tr>
                        <td colspan="3">CASH @formatNumber($payments->where('payment_method', 'cash')->sum('nominal_plus') - $jumlahkembalian) | TRANSFER @formatNumber($payments->where('payment_method', 'transfer')->sum('nominal_plus'))</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-end font-semibold text-gray-800 dark:text-gray-200">@formatNumber($payments->sum('nominal_plus'))</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-end font-semibold text-gray-800 dark:text-gray-200">@formatNumber($jumlahkembalian)</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-end font-bold text-gray-800 dark:text-gray-200">@formatNumber($payments->sum('nominal_plus') - $jumlahkembalian)</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div> 
            
            <!-- pagination start -->
            <!-- pagination end -->
    
          </div>
        </div>
      </div>
      <div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
        <div class="flex flex-col bg-white p-5 rounded-lg mt-4 shadow-lg">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="overflow-hidden">
  
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                  <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date Order</th>
                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Nominal Unpaid</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($ordersUnpaid->where('total_cashback', '<', 0) as $orderUpd)     
                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-green-400 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><a href="/my-orders/{{ $orderUpd->id }}">{{ $orderUpd->id }}</a></td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $orderUpd->date_order }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $users->where('id',$orderUpd->user_id)->value('name')  }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@formatNumber($orderUpd->total_cashback)</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-end font-bold text-gray-800 dark:text-gray-200">@formatNumber($ordersUnpaid->where('total_cashback', '<', 0)->sum('total_cashback'))</td>
                    </tr>
                  </tfoot>
                </table>
               
              </div>
            </div> 
            
            <!-- pagination start -->
            <!-- pagination end -->
  
          </div>
        </div>
      </div>
     
    </div> 
  
  </div>