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
    

    <div class="flex mt-3 mx-auto">
      <div class="flex bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600">
        <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
          <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
            Unpaid
          </button>
          <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
            Paid
          </button>
          <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-3" aria-selected="false" data-hs-tab="#segment-3" aria-controls="segment-3" role="tab">
            Payment History
          </button>
        </nav>
      </div>
    </div>
    
    <div class="mt-3">
      <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
        <p class="text-gray-500 dark:text-neutral-400">
          This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">first</em> item's tab body.
        </p>
      </div>
      <div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
        <p class="text-gray-500 dark:text-neutral-400">
          This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">second</em> item's tab body.
        </p>
      </div>
      <div id="segment-3" class="hidden" role="tabpanel" aria-labelledby="segment-item-3">
        <p class="text-gray-500 dark:text-neutral-400">
          This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">third</em> item's tab body.
        </p>
      </div>
    </div> 


  </div>