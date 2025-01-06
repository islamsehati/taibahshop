<div class="w-full max-w-[85rem] py-8 px-4 sm:px-4 lg:px-4 mx-auto mb-10">
  <div class="container mx-auto">
    <div class="mb-4 flex justify-between">
      <h1 class="text-xl font-semibold">Shopping Cart</h1>
      <h6 wire:click='clearItem()' class="cursor-pointer text-red-500 text-sm underline underline-offset-2 mt-1.5 font-semibold text-right">Clear</h6>
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4"> 
    @forelse ($grup_items as $gr_item )
          
        <div class="block">
        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-4 mb-2">
          <h2 class="mb-2"><span style=" margin-right:0.5rem;" class="fa fa-map-marker text-green-600"></span>{{ $branches->where('id',$gr_item['branch_id'])->value('name')  }}</h2>
          <hr>
          <div>
          <table class="w-full">
            <tbody>

              @foreach ($cart_items->where('branch_id', $gr_item['branch_id']) as $item)

              <tr wire:key='{{ $item['product_id'] }}' >
                  <td class="py-3">
                    <div class="flex items-center">
                      <div>
                        <a href="/products/{{ $item['slug'] }}">
                          @if ( $item['image'] != null)
                            <img class="h-16 w-16 mr-4" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">                          
                          @else
                            <img class="h-16 w-16 mr-4" src="{{ url('storage/food-packaging.png') }}" alt="{{ $item['name'] }}">
                          @endif
                        </a>  
                      </div>
                      <div class="">
                        <div class="font-semibold"><a href="/products/{{ $item['slug'] }}">{{ $item['name'] }} {{ $item['variant'] }}</a></div>
                        
                        <div class="text-xs">
                        <span style=" margin-right:0.5rem;" class="fa fa-map-marker text-green-600"></span>{{ $branches->where('id',$item['branch_id'])->value('name') }}
                        <span class="ml-3"><span>@</span>{{ number_format($item['unit_amount']) }}</span>
                        </div>

                        <div class="flex items-center justify-start mt-2" livewire:modal.modal-cart>
                          <div class="bg-gray-100 rounded-md">
                            <button wire:click='decreaseQty({{ $item['product_id'] }})' class="z-10 relative border rounded-md py-1 w-7 -mr-3 bg-white hover:bg-yellow-400">-</button>
                            {{-- <a href="/products/{{ $item['slug'] }}" class="mx-2"><span class="text-center w-8" >{{ $item['quantity'] }}</span></a> --}}
                            
                            <button type="button" class="py-1 px-5 inline-flex items-center gap-x-2 text-sm font-medium border border-transparent bg-transparent text-black hover:text-white hover:bg-yellow-500 focus:outline-none focus:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-focus-management-modal-{{ $item['id'] }}" data-hs-overlay="#hs-focus-management-modal-{{ $item['id'] }}">
                              {{ $item['quantity'] }}
                            </button>
                            
                            <div id="hs-focus-management-modal-{{ $item['id'] }}" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-focus-management-modal-label">
                              <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                {{-- <form > --}}
                                  <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                                    <div class="flex justify-between items-center py-3 px-4 border-b">
                                      <h3 id="hs-focus-management-modal-label" class="font-bold text-gray-800">
                                        {{ $item['name'] }} {{ $item['variant'] }}
                                      </h3>
                                      <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-focus-management-modal-{{ $item['id'] }}">
                                        <span class="sr-only">Close</span>
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M18 6 6 18"></path>
                                          <path d="m6 6 12 12"></path>
                                        </svg>
                                      </button>
                                    </div>
                                    <div class="p-4 overflow-y-auto">
                                      <label for="input-label" class="block text-sm font-medium mb-2">Quantity</label>
                                      <input wire:keyup.enter='typeQty({{ $item['id'] }})' type="numeric" id="thisqty" name="thisqty" wire:model='thisqty' onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm text-center focus:border-yellow-400 focus:ring-yellow-400" placeholder="{{ $item['quantity'] }}" autofocus="" >
                                    </div>
                                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                                      <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-focus-management-modal-{{ $item['id'] }}">
                                        Close
                                      </button>
                                      <button wire:click='typeQty({{ $item['id'] }})' class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-400 text-white hover:bg-yellow-500 focus:outline-none focus:bg-yellow-500 disabled:opacity-50 disabled:pointer-events-none">
                                        Save changes
                                      </button>
                                    </div>
                                  </div>
                                {{-- </form> --}}
                              </div>
                            </div>
                            
                            {{-- <input type="numeric" wire.model='qty' wire:keydown.enter="typeQty({{ $item['id'] }}, {{ $item['qty'] }})"  class="text-center w-8" value="" > --}}
                            <button wire:click='increaseQty({{ $item['product_id'] }}, {{ $item['quantity'] }})' class="border rounded-md py-1 px-2 -ml-3 bg-white hover:bg-yellow-400">+</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="block text-end py-[12.6px]">
                    <div>total</div>
                    <div class="font-semibold">{{ number_format($item['total_amount']) }}</div>
                    <button wire:click='removeItem({{ $item['product_id'] }})' class="bg-slate-200 border-2 border-red-400 rounded-md px-2 hover:bg-red-500 hover:text-white hover:border-red-700 mt-1">
                      <span wire:loading.remove wire:target='removeItem({{ $item['product_id'] }})'><i class="fa fa-trash" aria-hidden="true"></i></span><span wire:loading wire:target='removeItem({{ $item['product_id'] }})'>...</span>   
                    </button>
                  </td>
                </tr>
                  
              @endforeach

              <!-- More product rows -->
            </tbody>
          </table>
          </div>
        </div>
        <div class="block mt-3 mb-5 w-full">
           <a href="/checkout?branch_id={{ $gr_item['branch_id'] }}"><button class=" text-center bg-red-500 text-white hover:bg-yellow-500 py-2 px-4 rounded-lg w-full">Checkout</button></a>
        </div>
      </div>
      @empty
      <div colspan="5" class="text-center py-4 text-4xl font-semibold text-slate-500">No items available in cart!</div>
      @endforelse
          
    </div>
  </div>
</div>

<script>
  window.addEventListener('cart-page', event => {
     window.location.reload(false); 
  })
</script>