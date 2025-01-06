<div class="w-full max-w-[85rem] py-6 px-4 sm:px-6 lg:px-8 mx-auto">

  {{-- <p>The current URL is: {{url()->full()}}</p> --}}
  {{-- @if (url()->full() === 'http://ecommerce.test/products?selected_categories%5B0%5D=2') bg-yellow-300 @else --}}
  <div 
  x-data="{}"
    x-init="$nextTick(() => {
        let ul = $refs.logos;
        ul.insertAdjacentHTML('afterend', ul.outerHTML);
        ul.nextSibling.setAttribute('aria-hidden', 'true');
    })"
  class="w-full overflow-x-auto no-scrollbar pb-3 -mb-3 [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(30px-30px),transparent_100%)]">
    <div class="inline-flex flex-nowrap whitespace-nowrap animate-infinite-scroll">
      
      <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-0">
          @foreach ($categories as $category) 
          @php
                if( strpos( url()->full(), 'selected_categories%5B0%5D='.$category->id) ){
                  $bgwarna = 'bg-yellow-300';
                }else{
                  $bgwarna = 'bg-yellow-50';
              }     
          @endphp   
          <li><a wire:key="{{ $category->id }}" href="products?selected_categories[0]={{ $category->id }}"  
            class="{{ $bgwarna }} hover:bg-yellow-300 border-yellow-300 border text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
            {{ $category->name }}</a></li>
          @endforeach 

          @php
                if( strpos( url()->full(), 'featured%5B0%5D=1') ){
                  $bgwarnafeatured = 'bg-yellow-300';
                }else{
                  $bgwarnafeatured = 'bg-green-200';
                }     
                if( strpos( url()->full(), 'on_sale%5B0%5D=1')){
                  $bgwarnaonsale = 'bg-yellow-300';
                }else{
                  $bgwarnaonsale = 'bg-green-200';
                }     
          @endphp   
          <li><a href="/products?featured[0]=1"
            class="{{ $bgwarnafeatured }} hover:bg-yellow-300 border-green-500 border text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
            Featured</a></li>
          <li><a href="/products?on_sale[0]=1"
            class="{{ $bgwarnaonsale }} hover:bg-yellow-300 border-green-500 border text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
            On Sale</a></li>

          @foreach ($brands as $brand) 
          @php
                if( strpos( url()->full(), 'selected_brands%5B0%5D='.$brand->id) ){
                  $bgwarna = 'bg-yellow-300';
                }else{
                  $bgwarna = 'bg-yellow-50';
              }     
          @endphp  
          <li><a href="products?selected_brands[0]={{ $brand->id }}" 
            class="{{ $bgwarna }} hover:bg-yellow-300 border-yellow-300 border text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
            {{ $brand->name }}</a></li>
          @endforeach
      </ul>
      <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-0" aria-hidden="true">
          @foreach ($categories as $category) 
          @php
                if( strpos( url()->full(), 'selected_categories%5B0%5D='.$category->id) ){
                  $bgwarna = 'bg-yellow-300';
                }else{
                  $bgwarna = 'bg-yellow-50';
              }     
          @endphp   
          <li><a wire:key="{{ $category->id }}" href="products?selected_categories[0]={{ $category->id }}"  
            class="{{ $bgwarna }} hover:bg-yellow-300 border-yellow-300 border text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
            {{ $category->name }}</a></li>
          @endforeach 

          @php
                if( strpos( url()->full(), 'featured%5B0%5D=1') ){
                  $bgwarnafeatured = 'bg-yellow-300';
                }else{
                  $bgwarnafeatured = 'bg-green-200';
                }     
                if( strpos( url()->full(), 'on_sale%5B0%5D=1')){
                  $bgwarnaonsale = 'bg-yellow-300';
                }else{
                  $bgwarnaonsale = 'bg-green-200';
                }     
          @endphp   
          <li><a href="/products?featured[0]=1"
            class="{{ $bgwarnafeatured }} hover:bg-yellow-300 border-green-500 border text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
            Featured</a></li>
          <li><a href="/products?on_sale[0]=1"
            class="{{ $bgwarnaonsale }} hover:bg-yellow-300 border-green-500 border text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
            On Sale</a></li>

          @foreach ($brands as $brand) 
          @php
                if( strpos( url()->full(), 'selected_brands%5B0%5D='.$brand->id) ){
                  $bgwarna = 'bg-yellow-300';
                }else{
                  $bgwarna = 'bg-yellow-50';
              }     
          @endphp  
          <li><a href="products?selected_brands[0]={{ $brand->id }}" 
            class="{{ $bgwarna }} hover:bg-yellow-300 border-yellow-300 border text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
            {{ $brand->name }}</a></li>
          @endforeach
      </ul>
      
    </div>
  </div>

  <section class="mt-2 py-1 max-md:bg-slate-100 bg-white font-poppins dark:bg-gray-800 rounded-lg">
    <div class="-px-1 py-1 mx-auto max-w-7xl lg:py-4 md:px-6">
      <div class="flex flex-wrap mb-10 -mx-3">

        <div class="w-full">

          <div class="px-3 mb-4 ">
            <div class="items-center justify-between px-3 py-2 bg-gray-50 md:flex dark:bg-gray-900 ">
              
              <div  class="hidden md:block relative max-md:mb-4">
                <div class="flex justify-between">

                  <div class="hs-dropdown [--strategy:fixed] [--adaptive:none] [--trigger:hover] hover:lg:text-yellow-500">
                    <summary
                        class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600"
                        >
                        <span class="text-sm font-medium"> Filters </span>
                        
                        <span class="transition group-open:-rotate-180">
                          <svg
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          class="size-4"
                          >
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                              </svg>
                            </span>
                      </summary>

                    <div class="text-start hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white p-2 rounded-md shadow-lg before:absolute top-full before:-top-5 before:-start-0 before:w-full before:h-5">
                      
                      <div class="w-80 rounded border border-gray-200 bg-white">
                        <header class="flex items-center justify-between p-4">
                          <span class="text-sm font-bold text-gray-700"> Categories </span>
                        </header>
                        <ul class="inline-flex flex-wrap space-y-1 border-t border-gray-200 p-4">
                          @foreach ($categories as $category) 
                          <li wire:key="{{ $category->id }}" class="mr-1 mt-1 mb-1">
                          <input type="checkbox" wire:model.live="selected_categories" id="{{ $category->slug }}" value="{{ $category->id }}" class="hidden peer">
                            <label for="{{ $category->slug }}" class=" items-center pb-1 px-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" >
                              <span class="text-sm">{{ $category->name }}</span>
                            </label>
                          </input>
                          </li>             
                          @endforeach
                        </ul>
                      </div>

                      <div class="w-80 rounded border border-gray-200 bg-white">
                        <header class="flex items-center justify-between p-4">
                          <span class="text-sm font-bold text-gray-700"> Brand </span>
                        </header>
                        <ul class="inline-flex flex-wrap space-y-1 border-t border-gray-200 p-4">
                          @foreach ($brands as $brand) 
                          <li wire:key="{{ $brand->id }}" class="mr-1 mt-1 mb-1">
                          <input type="checkbox" wire:model.live="selected_brands" id="{{ $brand->slug }}" value="{{ $brand->id }}" class="hidden peer">
                            <label for="{{ $brand->slug }}" class=" items-center pb-1 px-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" >
                              <span class="text-sm">{{ $brand->name }}</span>
                            </label>
                          </input>
                          </li>             
                          @endforeach
                        </ul>
                      </div>

                      <div class="w-80 rounded border border-gray-200 bg-white">
                        <header class="flex items-center justify-between p-4">
                          <span class="text-sm font-bold text-gray-700"> Status </span>
                        </header>
                        <ul class="space-y-1 border-t border-gray-200 p-4">
                          <li>
                            <label for="featured" class="flex items-center dark:text-gray-300">
                              <input type="checkbox" id="featured" wire:model.live="featured" value="1" class="w-4 h-4 mr-2">
                              <span class="text-sm dark:text-gray-400">Featured</span>
                            </label>
                          </li>
                          <li>
                            <label for="on_sale" class="flex items-center dark:text-gray-300">
                              <input type="checkbox" wire:model.live="on_sale" value="1" class="w-4 h-4 mr-2">
                              <span class="text-sm dark:text-gray-400">On Sale</span>
                            </label>
                          </li>
                        </ul>
                      </div>

                      <div class="w-80 rounded border border-gray-200 bg-white">
                        <header class="flex items-center justify-between p-4">
                          <span class="text-sm font-bold text-gray-700"> Price </span>
                        </header>
                        <ul class="space-y-1 border-t border-gray-200 p-4">

                          <div>
                            <div class="font-semibold">@currency($price_range)</div>
                            <input type="range" wire:model.live="price_range" class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer" max="150000" value="150000" step="10000">
                            <div class="flex justify-between ">
                              <span class="inline-block text-sm font-bold text-blue-400 ">@currency(10000)</span>
                              <span class="inline-block text-sm font-bold text-blue-400 ">@currency(150000)</span>
                            </div>
                          </div>
              
                        </ul>
                      </div>
                    
                    </div>
                  </div>

                
                  
            
                

                <select wire:model.live="sort" class="block w-30 ml-5 text-sm bg-gray-50 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                  <option value="latest">Sort by latest</option>
                  <option value="price">Sort by Price</option>
                </select> 
                </div>
                </div>

                <div wire:ignore class="max-md:mt-2 w-1/4 max-md:w-full">
                  <select 
                    wire:change='changeBranch()' 
                  wire:model.live='branch' 
                  class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none"  
                  id="branch" 
                  data-hs-select='{
                    "hasSearch": true,
										"searchPlaceholder": "Search...",
										"searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
										"searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
										"placeholder": "Select Member",
										"toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
										"toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-[0.65rem] ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
										"dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
										"optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
										"optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 \" data-title></div></div></div>",
										"extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                  }' >
                  @foreach ($branches as $branch)
									<option value="{{ $branch->id }}">{{ $branch->name }}</option>
								  @endforeach
                  </select>
                </div>
               
                <label class="relative block max-md:mt-4 max-md:mb-2">
                  <span class="sr-only">Search</span>
                  <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 30 30">
                      <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"></path>
                    </svg>
                  </span>
                  <input wire:model.live="cari" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-20 shadow-sm focus:outline-none focus:border-yellow-400 focus:ring-yellow-400 focus:ring-1 sm:text-sm" placeholder="Search for menu..." type="text" name="search"/>
                </label>

            </div>
          </div>

          <a href="/products" class="@if ($url == 0) hidden @else flex @endif mb-2 mx-auto justify-center items-center">reset</a>

          {{-- Product Card Start --}}

          <div class="flex flex-wrap items-center">

            @foreach ($products as $product)   
            <div wire:key="{{ $product->id }}" class="w-1/3 px-2 mb-3 max-sm:w-1/2 max-md:w-1/3 lg:w-1/5">
              <div class="border rounded-xl hover:shadow-md border-gray-300 bg-white dark:border-gray-700">
                <div class="relative bg-yellow-300 border rounded-lg mx-2 my-2">
                  <a href="/products/{{ $product->slug }}" class="">
                    @if ( $product->images != null)
                    <img src="{{ url('storage', $product->images[0]) }}" alt="{{ $product->name }}" class="object-cover w-full h-40 mx-auto rounded-lg">
                    @else
                    <img src="{{ url('storage/food-packaging.png') }}" alt="{{ $product->name }}" class="object-cover w-full h-40 mx-auto rounded-lg">
                    @endif
                    
                  </a>
                </div>
                <div class="p-3 ">
                  <div class="flex items-center justify-between gap-2 mb-2">
                    <h3 class="truncate text-xl max-lg:text-lg font-medium dark:text-gray-400">
                      @if ( $product->variant != null)
                      {{ $product->variant }}
                      @else
                      {{ $product->name }} {{ $product->variant }}
                      @endif
                    </h3>
                  </div>
                  <div class="flex items-center justify-between">
                  <p class="text-lg max-lg:text-base">
                    <span class="text-green-600 dark:text-green-600">@currency($product->price)</span>
                    @if($product->strikethroughprice != null && $product->strikethroughprice >= 0)
                    <span class="mr-2 text-xs font-normal text-gray-500 line-through dark:text-green-600">@currency($product->strikethroughprice)</span>
                    @endif
                  </p>
                  <p><i class="fa fa-star text-yellow-400" aria-hidden="true"></i> {{ $product->rating }}</p>
                </div>
                </div>
                <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">

                  {{-- @php
                      $boughtqty = $orderitem->where('product_id', $product->id)->sum('p_quantity');
                      $soldqty = $orderitem->where('product_id', $product->id)->sum('quantity');
                      $stock = $boughtqty - $soldqty;
                  @endphp --}}
                  
                  {{-- @if ( $stock >= 1 && $product->in_stock == 1 ) --}}
                  @if ( $product->in_stock == 1 )
                  <a wire:click.prevent='addToCart({{ $product->id }})' href="#" class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3 " viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg><span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Add to Cart</span><span wire:loading wire:target='addToCart({{ $product->id }})'>Adding...</span>
                  </a>
                  @else
                  <a class="cursor-not-allowed text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300"><span>Habis</span></a>   
                  @endif

                </div>
              </div>
            </div>
            @endforeach

          </div>
          {{-- Product Card End --}}

          <!-- pagination start -->
          <style>
            nav div div p {
                margin-left: 20px;
                margin-right: 20px;
            }
          </style>
          <div class="flex justify-center mt-6">
            {{ $products->links() }}
          </div>
          <!-- pagination end -->

        </div>

        {{-- Grid End --}}      
        
      </div>
    </div>
  </section>

  <script>
		// window.addEventListener('products-page', event => {
		//    window.location.reload(false); 
		// })
  </script>

</div>
