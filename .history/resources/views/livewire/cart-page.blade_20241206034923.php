<div class="w-full max-w-[85rem] py-8 px-4 sm:px-4 lg:px-4 mx-auto mb-10">
  <div class="container mx-auto">
    <div class="mb-4">
      <h1 class="text-xl font-semibold">Shopping Cart</h1>
      <h6 wire:click='clearItem()' class="cursor-pointer text-red-500 text-sm underline underline-offset-2 -mt-6 font-semibold text-right">Clear</h6>
    </div>
    <div class="flex gap-3 flex-col sm:flex-row"> 
      <div class="md:w-3/5">
        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-2">
          <table class="w-full">
            <thead>
              <tr>
                <th class="text-left font-semibold"> </th>
                <th class="text-left font-semibold">Product</th>
                <th class="text-right font-semibold pr-9">Qty</th>
              </tr>
            </thead>
            <tbody>

              @forelse ($cart_items as $item)

                <tr wire:key='{{ $item['product_id'] }}'>
                  <td><button wire:click='removeItem({{ $item['product_id'] }})' class="bg-slate-300 border-2 border-red-400 rounded-lg px-2 hover:bg-red-500 hover:text-white hover:border-red-700">
                  <span wire:loading.remove wire:target='removeItem({{ $item['product_id'] }})'>X</span><span wire:loading wire:target='removeItem({{ $item['product_id'] }})'>...</span>   
                  </button></td>
                  <td class="py-4">
                    <div class="flex items-center">
                      <a href="/products/{{ $item['slug'] }}">
                        @if ( $item['image'] != null)
                          <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">                          
                        @else
                          <img class="h-16 w-16 mr-4" src="{{ url('storage/food-packaging.png') }}" alt="{{ $item['name'] }}">
                        @endif
                      </a>  
                      <div class="block">
                        <div class="font-semibold"><a href="/products/{{ $item['slug'] }}">{{ $item['name'] }} {{ $item['variant'] }}</a></div>
                        <div>{{ number_format($item['unit_amount']) }} -> {{ number_format($item['total_amount']) }}</div>
                        {{-- <div>{{ $item['branch_id'] }}</div> --}}
                        <div><span style=" margin-right:0.5rem;" class="fa fa-map-marker text-green-600"></span>{{ $branches->where('id',$item['branch_id'])->value('name') }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="py-4">
                    <div class="flex items-center justify-end" livewire:modal.modal-cart>
                      <button wire:click='decreaseQty({{ $item['product_id'] }})' class="border rounded-md py-1 w-7 mr-1">-</button>
                      <a href="/products/{{ $item['slug'] }}" class="mx-2"><span class="text-center w-8" >{{ $item['quantity'] }}</span></a>
                      {{-- <input type="numeric" wire.model='qty' wire:keydown.enter="typeQty({{ $item['id'] }}, {{ $item['qty'] }})"  class="text-center w-8" value="" > --}}
                      <button wire:click='increaseQty({{ $item['product_id'] }}, {{ $item['quantity'] }})' class="border rounded-md py-1 px-2 ml-1">+</button>
                    
                      <!-- Modal toggle -->
<button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Product
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                        <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">Select category</option>
                            <option value="TV">TV/Monitors</option>
                            <option value="PC">PC</option>
                            <option value="GA">Gaming/Console</option>
                            <option value="PH">Phones</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Description</label>
                        <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>                    
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new product
                </button>
            </form>
        </div>
    </div>
</div> 
                    
                    </div>
                  </td>
                </tr>

              @empty

                <tr>
                  <td colspan="5" class="text-center py-4 text-4xl font-semibold text-slate-500">No items available in cart!</td>
                </tr>
                  
              @endforelse

              <!-- More product rows -->
            </tbody>
          </table>
          *Pastikan order hanya ke satu cabang
        </div>
      </div>
      <div class="md:w-2/5">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg font-semibold mb-4">Summary</h2>
          <div class="flex justify-between mb-2">
            <span>Subtotal</span>
            <span>@currency($grand_total)</span>
          </div>
          <div class="flex justify-between mb-2 text-gray-400">
            <span>Shipping*</span>
            <span>@currency(0)</span>
          </div>
          <div class="flex justify-between mb-2 text-gray-400">
            <span>Discount*</span>
            <span>@currency(0)</span>
          </div>
          <hr class="my-2">
          <div class="flex justify-between mb-2">
            <span class="font-semibold">Grand Total</span>
            <span class="font-semibold">@currency($grand_total)</span>
          </div>
          
          @if ($cart_items)
          <a href="/checkout" class="block text-center bg-red-500 text-white hover:bg-yellow-500 py-2 px-4 rounded-lg mt-4 w-full">Checkout</a>
          @endif

          <div class="mt-2">*Akan disesuaikan oleh kasir</div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('cart-page', event => {
     window.location.reload(false); 
  })
</script>