<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-center text-2xl font-bold text-slate-500">
    Items List
  </h1>
  
  <div class="flex justify-between items-center mt-3">
    <div class="flex">
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

    <div>
      From <input wire:model.live='date_awal' type="date" name="date_awal" id="date_awal" class="bg-white px-2">
      To <input wire:model.live='date_akhir' type="date" name="date_akhir" id="date_akhir" class="bg-white px-2">
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
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">#</th>
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Variant</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Stock</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">T.Bought</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">T.Sold</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($items as $item) 
                  @php
                    $terbeli = $item->sum('p_quantity');
                    $terjual = $item->sum('quantity');
                  @endphp     
                  <tr class="odd:bg-white even:bg-gray-100 hover:bg-yellow-100 dark:odd:bg-neutral-800 dark:even:bg-neutral-700 dark:hover:bg-neutral-700">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"><a href="/admin/products/{{ $products->where('id', $item->value('product_id'))->value('id') }}/edit">{{ $products->where('id', $item->value('product_id'))->value('id') }}</a></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $products->where('id', $item->value('product_id'))->value('name') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $products->where('id', $item->value('product_id'))->value('variant') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">@currency($products->where('id', $item->value('product_id'))->value('price'))</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">{{ $terbeli - $terjual }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">{{ $terbeli }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-end text-gray-800 dark:text-gray-200">{{ $terjual }}</td>
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
          {{-- {{ $items->links() }} --}}
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
             
            </div>
          </div> 
          
          <!-- pagination start -->
          <!-- pagination end -->

        </div>
      </div>
    </div>
   
  </div> 

</div>