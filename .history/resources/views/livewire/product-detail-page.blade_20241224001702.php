<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">
      <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
        <div class="flex flex-wrap -mx-4">
          

            @if ( $product->images != null)
            <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ url('storage', $product->images[0]) }}' }">
            @else
            <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ url('storage/food-packaging.png') }}' }">
            @endif

            <div class="sticky top-0 z-10 overflow-hidden ">
              <div class="relative mb-6 lg:mb-10 lg:h-2/4 ">
                <img x-bind:src="mainImage" alt="" class="object-cover w-full lg:h-full ">
              </div>
              <div class="flex-wrap flex max-xl:flex">

                @if ( $product->images != null)
                @foreach ($product->images as $image)
                <div class="w-1/5 p-2 sm:w-1/4" x-on:click="mainImage='{{ url('storage', $image) }}'">
                  <img src="{{ url('storage', $image) }}" alt="{{ $product->name }}" class="object-cover w-full lg:h-20 cursor-pointer hover:border hover:border-blue-500">
                </div>
                @endforeach
                @else
                <div class="w-1/5 p-2 sm:w-1/4" x-on:click="mainImage='{{ url('storage/food-packaging.png') }}'">
                  <img src="{{ url('storage/food-packaging.png') }}" alt="produk tanpa gambar" class="object-cover w-full lg:h-20 cursor-pointer hover:border hover:border-blue-500">
                </div>
                @endif

              </div>
              <div class="px-6 pb-6 mt-6 border-t border-gray-300 dark:border-gray-400 ">
                <div class="flex flex-wrap items-center mt-6">
                  <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 text-gray-700 dark:text-gray-400 bi bi-truck" viewBox="0 0 16 16">
                      <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                      </path>
                    </svg>
                  </span>
                  <h2 class="text-lg font-bold text-gray-700 dark:text-gray-400">Free Delivery*</h2><span class="text-xs">&ensp; selama promo</span>
                </div>
              </div>
            </div>
          </div>

          <div class="w-full px-4 md:w-1/2 ">
            <div class="lg:pl-20">
              <div class="mb-2">
                <h2 wire:model="name" class="max-w-xl mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                  {{ $product->name }} {{ $product->variant }}</h2>
                <p class="inline-block mb-3 text-4xl font-bold text-gray-700 dark:text-gray-400 ">
                  <span>@currency($product->price)</span>
                  @if($product->strikethroughprice != null && $product->strikethroughprice >= 0)
                  <span class="text-base font-normal text-gray-500 line-through dark:text-gray-400">@currency($product->strikethroughprice)</span>  
                  @endif
                </p> 
                <div class="flex justify-around mx-4 mb-2">
                  <span class="text-center py-5"><i class="fa fa-map-marker text-green-600"></i><br> {{ $branch }}</span>
                  <span class="border-l-2 py-5"></span>
                  <span class="text-center py-5"><i class="fa fa-star text-yellow-400" aria-hidden="true"></i><br> {{ $product->rating }}/5</span>
                  <span class="border-r-2 py-5"></span>
                  <span class="text-center py-5"><i class="fa fa-th-list text-red-500"></i><br> {{ $category }}</span>
                </div>
                
                @if (count($variants) > 1)
                <div>
                  <a class="text-black text-xs font-bold px-2 py-2 mr-1">Variant</a>
                  @foreach ($variants as $variant)
                    @php
                          if( $variant->id == $product->id ){
                            $bgwarna = 'bg-yellow-400';
                          }else{
                            $bgwarna = 'bg-yellow-100';
                        }     
                    @endphp 
                  <div class="inline-block mt-4 mr-1">
                    <a wire:key="{{ $variant->id }}" wire:navigate class="text-xs {{ $bgwarna }} border border-yellow-400 rounded-md hover:bg-red-500 hover:border-red-500 hover:text-white px-3 py-2" href="/products/{{ $variant->slug }}">{{ $variant->variant }}</a>
                  </div>
                  @endforeach
                </div>   
                @else
                <div class="mt-4">Product has no variants</div> 
                @endif
              </div>

              <div class="hidden md:flex mb-5 pt-4 mt-5 justify-between border-t">
                <div for="" class="text-nowrap w-20 pb-1 text-xl font-semibold text-gray-700 border-b border-blue-300 dark:border-gray-600 dark:text-gray-400">Quantity</div>
                <div class="relative flex flex-row w-32 h-10  bg-transparent rounded-lg">
                  
                  <button wire:click='decreaseQty' class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
                    <span class="m-auto text-2xl font-thin">-</span>
                  </button>

                  <input wire:keyup.enter='addToCart({{ $product->id }})' autofocus required type="numeric" wire:model='quantity' value="" min=1 onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black">
                  
                  <button wire:click='increaseQty' class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
                    <span class="m-auto text-2xl font-thin">+</span>
                  </button>
                </div>
              </div>

              <div class="hidden md:flex flex-wrap items-center gap-4">

                {{-- @php
                  $boughtqty = $orderitem->where('product_id', $product->id)->sum('p_quantity');
                  $soldqty = $orderitem->where('product_id', $product->id)->sum('quantity');
                  $stock = $boughtqty - $soldqty;
                @endphp --}}

                {{-- @if ( $stock >= 1 && $product->in_stock == 1 ) --}}
                @if ( $product->in_stock == 1 )
                  
                  <button 
                    wire:click='addToCart({{ $product->id }})' 
                    class="w-full p-4 bg-red-500 rounded-md lg:full dark:text-gray-200 text-gray-50 hover:bg-yellow-400 dark:bg-blue-500 dark:hover:bg-blue-700">
                    <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Add to cart</span><span wire:loading wire:target='addToCart({{ $product->id }})'>Adding...</span>
                  </button>
                  
                @else
                <button class="w-full p-4 bg-gray-500 rounded-md lg:full dark:text-gray-200 text-gray-50 hover:bg-yellow-400 dark:bg-blue-500 dark:hover:bg-blue-700">
                  <span>Habis</span>
                </button>
                @endif
              </div>

              <div class="mt-8 [&>ul]:list-disc [&>ul]:ml-5">                   
                {{-- <span>Stock {{ $stock }}</span> --}}
              <p class="max-w-md text-gray-700 dark:text-gray-400">
                {!! Str::markdown($product->description) !!}</p>
              
                @if($product->tags != '')
                @php
                  $tags = Str::of($product->tags)->explode(',')
                @endphp
                  <p class="mt-3 max-w-md text-gray-700 dark:text-gray-400">
                    @foreach ($tags as $tag)
                    <span class="bg-yellow-100 m-1 px-2 rounded-md">
                      #{{$tag}}
                    </span>
                    @endforeach
                @endif
              </p>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="md:hidden fixed bottom-0 left-0 z-50 w-full h-30 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
    
        <div class="flex justify-between">
          <div class="my-2 mx-2 mr-1 relative flex flex-row w-32 h-10 bg-transparent rounded-lg">
            
            <button wire:click='decreaseQty' class="w-20 h-full text-gray-600 bg-gray-300 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-400">
              <span class="m-auto text-2xl font-thin">-</span>
            </button>

            <input wire:keyup.enter='addToCart({{ $product->id }})' autofocus required type="numeric" wire:model='quantity' value="" min=1 onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-300 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black">
            
            <button wire:click='increaseQty' class="w-20 h-full text-gray-600 bg-gray-300 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-400">
              <span class="m-auto text-2xl font-thin">+</span>
            </button>
          </div>
          @if ( $product->in_stock == 1 )
            <button 
              wire:click='addToCart({{ $product->id }})' 
              class="w-full my-2 mx-2 ml-1 bg-red-500 rounded-md lg:full dark:text-gray-200 text-gray-50 hover:bg-yellow-400 dark:bg-blue-500 dark:hover:bg-blue-700">
              <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Add to cart</span><span wire:loading wire:target='addToCart({{ $product->id }})'>Adding...</span>
            </button>
          @else
            <button class="w-full my-2 mx-2 ml-1 bg-gray-500 rounded-md lg:w-2/5 dark:text-gray-200 text-gray-50 hover:bg-yellow-400 dark:bg-blue-500 dark:hover:bg-blue-700">
              <span>Habis</span>
            </button>
          @endif
        </div>
      </div>

    </section>
  </div>