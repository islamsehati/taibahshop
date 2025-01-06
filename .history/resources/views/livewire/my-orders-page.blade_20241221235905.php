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
    

    <select id="tab-select" class="sm:hidden py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" aria-label="Tabs">
      <option value="#hs-tab-to-select-1">Tab 1</option>
      <option value="#hs-tab-to-select-2">Tab 2</option>
      <option value="#hs-tab-to-select-3">Tab 3</option>
    </select>
    
    <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700">
      <nav class="flex gap-x-2" aria-label="Tabs" role="tablist" data-hs-tab-select="#tab-select">
        <button type="button" class="hs-tab-active:bg-white hs-tab-active:border-b-transparent hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200 active" id="hs-tab-to-select-item-1" aria-selected="true" data-hs-tab="#hs-tab-to-select-1" aria-controls="hs-tab-to-select-1" role="tab">
          Tab 1
        </button>
        <button type="button" class="hs-tab-active:bg-white hs-tab-active:border-b-transparent hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200" id="hs-tab-to-select-item-2" aria-selected="false" data-hs-tab="#hs-tab-to-select-2" aria-controls="hs-tab-to-select-2" role="tab">
          Tab 2
        </button>
        <button type="button" class="hs-tab-active:bg-white hs-tab-active:border-b-transparent hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200" id="hs-tab-to-select-item-3" aria-selected="false" data-hs-tab="#hs-tab-to-select-3" aria-controls="hs-tab-to-select-3" role="tab">
          Tab 3
        </button>
      </div>
    </div>
    
    <div class="mt-3">
      <div id="hs-tab-to-select-1" role="tabpanel" aria-labelledby="hs-tab-to-select-item-1">
        <div class="p-3 sm:p-0">
          <p class="text-gray-500 dark:text-neutral-400">
            This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">first</em> item's tab body.
          </p>
        </div>
      </div>
      <div id="hs-tab-to-select-2" class="hidden" role="tabpanel" aria-labelledby="hs-tab-to-select-item-2">
        <div class="p-3 sm:p-0">
          <p class="text-gray-500 dark:text-neutral-400">
            This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">second</em> item's tab body.
          </p>
        </div>
      </div>
      <div id="hs-tab-to-select-3" class="hidden" role="tabpanel" aria-labelledby="hs-tab-to-select-item-3">
        <div class="p-3 sm:p-0">
          <p class="text-gray-500 dark:text-neutral-400">
            This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">third</em> item's tab body.
          </p>
        </div>
      </div>
    </div>


  </div>