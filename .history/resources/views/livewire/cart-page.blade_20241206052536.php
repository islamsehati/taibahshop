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
            <tbody>

              @forelse ($cart_items as $item)

                <tr wire:key='{{ $item['product_id'] }}'>
                  
                  <div class="py-4">
                    <td>
                      <div class="flex items-center">
                        <a href="/products/{{ $item['slug'] }}">
                          @if ( $item['image'] != null)
                            <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">                          
                          @else
                            <img class="h-16 w-16 mr-4" src="{{ url('storage/food-packaging.png') }}" alt="{{ $item['name'] }}">
                          @endif
                        </a>  
                        <div>
                          <div class="font-semibold"><a href="/products/{{ $item['slug'] }}">{{ $item['name'] }} {{ $item['variant'] }}</a></div>
                            <h4>{{ number_format($item['unit_amount']) }}</h4>
                            
                            <div><span style=" margin-right:0.5rem;" class="fa fa-map-marker text-green-600"></span>{{ $branches->where('id',$item['branch_id'])->value('name') }}</div>
                        
                          </div>
                      </div>


                      
                    </td>
                    <td>
                      <h4>{{ number_format($item['total_amount']) }}</h4>
                    </td>
                    

                    
                  </div>
                </tr>
                <hr>

              @empty

                <tr>
                  <td colspan="5" class="text-center py-4 text-4xl font-semibold text-slate-500">No items available in cart!</td>
                </tr>
                  
              @endforelse

              <!-- More product rows -->
            </tbody>
          </table>
          <div class="mt-4">*Pastikan order hanya ke satu cabang</div>
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