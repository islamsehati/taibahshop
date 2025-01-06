<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-center text-2xl font-bold text-slate-500">
    Items List
  </h1>
  
  <div class="flex mt-3">
    <div class="mx-auto flex bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600">
      <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
        <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-1 px-2 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-yellow-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
          Items
        </button>
        <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-1 px-2 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-yellow-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
          Low Stock
        </button>
                 
      </nav>
    </div>
  </div>
  
  <div class="mt-3">
    <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
      <div class="flex flex-col bg-white p-0 pt-4 rounded-lg mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
          <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                  <tr>
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Variant</th>
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Stock</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">T. Bought</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">T. Sold</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($items as $item) 
                  @php

                  @endphp     
                  <tr wire:key='{{ $item->id }}' class="odd:bg-white even:bg-gray-100 hover:bg-yellow-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $item->order_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $item->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $item->variant }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($item->price)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">stok</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($item->nominal_plus - $cashback)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                      <div class="hs-dropdown [--strategy:fixed] [--adaptive:none] [--trigger:hover] hover:lg:text-yellow-500">
                        <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                        <div class="text-start hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white p-2 rounded-md shadow-lg before:absolute top-full before:-top-5 before:-start-0 before:w-full before:h-5">                       
                          <div class="py-1">
                            <a href="/admin/products/{{ $item->id }}/edit"><button class="w-full bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-slate-400">Details</button></a>
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
          <div class="flex justify-center my-5">
          {{-- {{ $items->links('pagination::bootstrap-4') }} --}}
          {{ $items->links() }}
          </div>
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
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Variant</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Stock</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($items as $item) 
                  @php

                  @endphp     
                  <tr wire:key='{{ $item->id }}' class="odd:bg-white even:bg-gray-100 hover:bg-yellow-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $item->order_id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $item->date_payment }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $payment_mtd !!}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($item->nominal_plus)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($cashback)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($item->nominal_plus - $cashback)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                      <div class="hs-dropdown [--strategy:fixed] [--adaptive:none] [--trigger:hover] hover:lg:text-yellow-500">
                        <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                        <div class="text-start hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white p-2 rounded-md shadow-lg before:absolute top-full before:-top-5 before:-start-0 before:w-full before:h-5">                       
                          <div class="py-1">
                            <a href="/my-orders/{{ $item->order_id }}"><button class="w-full bg-yellow-500 text-white py-2 px-4 rounded-md hover:bg-slate-400">Details</button></a>
                          </div>
                          
                          @if (auth()->user()->is_admin == 1)
                          <div class="py-1">
                            <a href="{{ route('printid', [$order->id]) }}"><button class="w-full bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-400"><i class="fa fa-print" aria-hidden="true"></i> Print</button></a>
                          </div>
                          <div class="py-1">
                            <a href="{{ route('printkitchen', [$order->id]) }}"><button class="w-full bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-400"><i class="fa fa-coffee" aria-hidden="true"></i> Kitchen</button></a>
                          </div>
                          @endif
                        
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
          <!-- pagination end -->

        </div>
      </div>
    </div>
   
  </div> 

</div>