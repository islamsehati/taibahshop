<div class="w-full h-screen mx-auto"
 {{-- onclick="full_screen_on()" --}}
>

    <section class="rounded-lg font-poppins">
            <div class="flex flex-wrap">

                {{-- Grid Start --}}
                <div class="absolute right-0 w-2/3">
                    <div class="top-0 z-10 px-3 bg-slate-200">
                        <div class="items-center justify-between py-2 sm:flex sm:flex-row-reverse ">

                                <div class="flex justify-between mb-3 sm:mb-0">
                                    <div class="flex mx-auto sm:ml-3 text-nowrap hs-dropdown">
                                        <button id="hs-dropdown-with-title" type="button" class="inline-flex items-center px-2 py-1 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm hs-dropdown-toggle gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                            <i class="fa fa-envelope" aria-hidden="true"></i> Orders
                                        </button>
    
                                        <div class="z-50 hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-title">
                                              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-t-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/my-orders">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                Pesanan
                                              </a>
                                              <a class="flex items-center gap-x-3.5 py-2 px-3 text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/payments">
                                                <i class="fa fa-money" aria-hidden="true"></i>
                                                Pembayaran
                                              </a>
                                              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-b-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/items">
                                                <i class="fa fa-cube" aria-hidden="true"></i>
                                                Barang Terjual
                                              </a>
                                          </div>
                                        {{-- <a ><button onclick="toggle_full_screen();" class="p-1 text-sm text-white bg-blue-500 size-7"><x-fas-maximize class="w-3 h-3 mx-auto text-white"/></button></a> --}}
                                    </div>

                                    {{-- <select wire:model.live="sort"
                                        class="relative block pb-1 ml-5 text-sm text-gray-900 transition bg-transparent cursor-pointer md:bottom-0 bottom-1 w-30 hover:border-gray-600 dark:text-gray-400 dark:bg-gray-900">
                                        <option value="latest">Sort by latest</option>
                                        <option value="price">Sort by Price</option>
                                    </select> --}}
                                </div>
                            

                                <div class="flex flex-nowrap">

                                    <label class="relative block">
                                                <span class="sr-only">Search</span>
                                                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                                    height="20" viewBox="0 0 30 30">
                                                    <path
                                                    d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z">
                                                </path>
                                            </svg>
                                        </span>
                                        <input wire:model.live="cari" 
                                        {{-- autofocus="" --}}
                                        class="block sm:w-full w-[calc(100vw-33vw-4rem)] py-2 pr-20 text-sm bg-white border rounded-l-lg placeholder:italic placeholder:text-slate-400 border-slate-200 pl-9 focus:outline-none focus:border-green-400 focus:ring-green-400 focus:ring-1"
                                        placeholder="Cari..." type="text" name="search" />
                                    </label>
                    
                                    <div class="hs-dropdown [--strategy:fixed] [--adaptive:none] [--auto-close:inside]">
                                        <summary class="flex cursor-pointer items-center gap-2 pt-[0.5rem] pb-[0.5rem] px-2 text-gray-900 bg-white transition hover:border-green-400 rounded-r-lg border dark:border-none focus:outline-none focus:border-green-400 focus:ring-green-400 focus:ring-1">
                                            <div class="text-sm"><i class="fa fa-sliders" aria-hidden="true"></i></div>
                                        </summary>
                    
                                        <div class="h-[80vh] overflow-y-auto text-start hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-80 hidden z-40 bg-white px-2 shadow-lg before:absolute top-full before:-top-5 before:-start-0 before:w-full before:h-5">
                        
                                            <div class="w-full my-2 bg-white border border-gray-200 rounded">
                                                <header class="flex items-center justify-between p-4">
                                                    <span class="text-sm font-bold text-gray-700"> Categories </span>
                                                </header>
                                                <ul
                                                    class="inline-flex flex-wrap p-4 py-1 border-t border-gray-200">
                                                    @foreach ($categories as $category)
                                                        <li wire:key="{{ $category->id }}" class="mt-1 mb-1 mr-1">
                                                            <input type="checkbox" wire:model.live="selected_categories"
                                                                id="{{ $category->slug }}" value="{{ $category->id }}"
                                                                class="hidden peer">
                                                            <label for="{{ $category->slug }}"
                                                                class=" items-center pb-1 px-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                                <span class="text-sm">{{ $category->name }}</span>
                                                            </label>
                                                            </input>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                        
                                            <div class="w-full my-2 bg-white border border-gray-200 rounded">
                                                <header class="flex items-center justify-between p-4">
                                                    <span class="text-sm font-bold text-gray-700"> Brand </span>
                                                </header>
                                                <ul
                                                    class="inline-flex flex-wrap p-4 py-1 border-t border-gray-200">
                                                    @foreach ($brands as $brand)
                                                        <li wire:key="{{ $brand->id }}" class="mt-1 mb-1 mr-1">
                                                            <input type="checkbox" wire:model.live="selected_brands"
                                                                id="{{ $brand->slug }}" value="{{ $brand->id }}"
                                                                class="hidden peer">
                                                            <label for="{{ $brand->slug }}"
                                                                class=" items-center pb-1 px-1.5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                                                <span class="text-sm">{{ $brand->name }}</span>
                                                            </label>
                                                            </input>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                        
                                            <div class="w-full my-2 bg-white border border-gray-200 rounded">
                                                <header class="flex items-center justify-between p-4">
                                                    <span class="text-sm font-bold text-gray-700"> Status </span>
                                                </header>
                                                <ul class="p-4 space-y-1 border-t border-gray-200">
                                                    <li>
                                                        <label for="featured"
                                                            class="flex items-center text-blue-500 dark:text-gray-300">
                                                            <input type="checkbox" id="featured"
                                                                wire:model.live="featured" value="1"
                                                                class="w-4 h-4 mr-2">
                                                            <span class="text-sm text-blue-500 dark:text-gray-400">Featured</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="promo"
                                                            class="flex items-center text-blue-500 dark:text-gray-300">
                                                            <input type="checkbox" wire:model.live="promo"
                                                                value="1" class="w-4 h-4 mr-2">
                                                            <span class="text-sm text-blue-500 dark:text-gray-400">Promo</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                        
                                            <div class="w-full my-2 bg-white border border-gray-200 rounded">
                                                <header class="flex items-center justify-between p-4">
                                                    <span class="text-sm font-bold text-gray-700"> Order by </span>
                                                </header>
                                                <ul class="p-4 space-y-1 border-t border-gray-200">
                                                    <li>
                                                        <label for="featured"
                                                            class="flex items-center text-blue-500 dark:text-gray-300">
                                                            <input type="radio" id="featured"
                                                                wire:model.live="sort" 
                                                                value="latest"
                                                                class="w-4 h-4 mr-2">
                                                            <span class="text-sm text-blue-500 dark:text-gray-400">Latest</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="promo"
                                                            class="flex items-center text-blue-500 dark:text-gray-300">
                                                            <input type="radio" 
                                                                wire:model.live="sort"
                                                                value="price" 
                                                                class="w-4 h-4 mr-2">
                                                            <span class="text-sm text-blue-500 dark:text-gray-400">Price</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                        
                                            <div class="w-full my-2 bg-white border border-gray-200 rounded">
                                                <header class="flex items-center justify-between p-4">
                                                    <span class="text-sm font-bold text-gray-700"> Price </span>
                                                </header>
                                                <ul class="p-4 space-y-1 border-t border-gray-200">
                        
                                                    <div>
                                                        <div class="font-semibold text-blue-500">@currency($price_range)</div>
                                                        <input type="range" wire:model.live="price_range"
                                                            class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                                            max="10000000" value="10000000" step="1000000">
                                                        <div class="flex justify-between ">
                                                            <span
                                                                class="inline-block text-sm font-bold text-blue-500 ">@currency(1000000)</span>
                                                            <span
                                                                class="inline-block text-sm font-bold text-blue-500 ">@currency(10000000)</span>
                                                        </div>
                                                    </div>
                        
                                                </ul>
                                            </div>
                        
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="hidden mr-3 md:flex hs-dropdown">
                                    <button class="font-lobster" id="hs-dropdown-with-title" type="button" class="inline-flex items-center px-4 py-3 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm hs-dropdown-toggle gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                        TaibahShop
                                    </button>

                                    <div class="z-50 hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-title">
                                        <div class="p-1 space-y-0.5">
                                          <span class="block px-3 pt-2 pb-1 text-xs font-medium text-gray-400 uppercase dark:text-neutral-500">
                                            Halaman
                                          </span>
                                          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            Beranda
                                          </a>
                                          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/cart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            Troli
                                          </a>
                                        </div>
                                        <div class="p-1 space-y-0.5">
                                          <span class="block px-3 pt-2 pb-1 text-xs font-medium text-gray-400 uppercase dark:text-neutral-500">
                                            Kontak
                                          </span>
                                          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="https://wa.me/6287881231119">
                                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                            Bantuan
                                          </a>
                                        </div>
                                      </div>
                                </div>

                        </div>
                    </div>

                    <button wire:click='resetProductsTile()' class="w-full sticky top-0 z-10 {{ $url == 0 ? ' hidden' : 'flex' }} py-1 mb-2 mx-auto justify-center items-center bg-slate-100">
                        reset
                    </button>

                    {{-- Product Card Start --}}

                    <div class="flex flex-wrap items-center justify-center mx-auto">

                        @foreach ($products as $product)
                            <div wire:key="{{ $product->id }}"
                                class="w-1/2 px-0 mb-0 xs:w-1/3 sm:w-1/3 md:w-1/4 lg:w-1/5">
                                <div
                                    class="bg-white border group hover:bg-gray-800 focus:bg-gray-800 border-slate-200 hover:border-slate-400 focus:border-slate-400 dark:border-gray-700">
                                    <div onclick="showModalPro({{ $product->id }})"
                                        class="relative {{ $product->is_active == 1 ? 'bg-gray-100' : 'bg-gray-400' }} cursor-pointer scale-90">
                                            @if ($product->images != null || $product->images === "[]")
                                                <img src="{{ Str::replace('%2F', '/',url('storage', $product->images[0])) }}"
                                                    alt="{{ $product->name }}"
                                                    class="object-cover w-full mx-auto aspect-square">
                                            @else
                                                <img src="{{ url('storage/food-packaging.png') }}"
                                                    alt="{{ $product->name }}"
                                                    class="object-cover w-full mx-auto aspect-square">
                                            @endif
                                    </div>
                                    <div class="px-3 pb-2">
                                        <div class="flex items-center justify-between gap-2">
                                            <h3 class="text-sm font-medium truncate group-hover:text-white group-focus:text-white max-lg:text-sm dark:text-gray-400">
                                                @if (Str::contains($product->variant, $product->name))
                                                    {{ $product->variant }}
                                                @else
                                                    {{ $product->name }} {{ $product->variant }}
                                                @endif
                                            </h3>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm max-lg:sm">
                                                <span
                                                    class="text-green-600 group-hover:text-lime-400 group-focus:text-lime-400 dark:text-green-600 text-nowrap">
                                                    @if (Str::length($product->price) > 6)
                                                    Rp{{  Number::forHumans($product->price, precision: 2) }}
                                                    @else
                                                    @currency($product->price)
                                                    @endif
                                                    </span>
                                                {{-- @if ($product->strikethroughprice != null && $product->strikethroughprice >= 0)
                                                    <span
                                                        class="pr-2 text-xs font-normal text-gray-500 line-through dark:text-green-600">@currency($product->strikethroughprice)</span>
                                                @endif --}}
                                            </p>
                                            {{-- <p class="text-xs text-nowrap"><i class="text-yellow-400 fa fa-star" aria-hidden="true"></i> {{ $product->rating }}</p> --}}
                                        </div>
                                    </div>
                                    <div class="flex justify-center p-1 border-t border-gray-300 dark:border-gray-700">

                                        {{-- @php
                                            $boughtqty = $orderitem->where('product_id', $product->id)->sum('p_quantity');
                                            $soldqty = $orderitem->where('product_id', $product->id)->sum('quantity');
                                            $stock = $boughtqty - $soldqty;
                                        @endphp --}}

                                        {{-- @if ($stock >= 1 && $product->in_stock == 1) --}}
                                        @if ($product->in_stock == 1)
                                            <span onclick="showModalPro({{ $product->id }})"
                                                class="flex items-center text-gray-500 cursor-pointer dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-300">
                                                <span wire:loading wire:target='addToCart({{ $product->id }})'>...</span>
                                                @if ($cartcek->where('product_id', $product->id)->where('created_by', auth()->user()->id)->value('quantity') > 0)
                                                    <span class="w-full mr-2" wire:loading.remove wire:target='addToCart({{ $product->id }})'><i class="fa fa-chevron-circle-left text-red-400" aria-hidden="true"></i></span>
                                                    <span class="w-full px-5 bg-blue-200 rounded-md" wire:loading.remove wire:target='addToCart({{ $product->id }})'>{{ $cartcek->where('product_id', $product->id)->where('created_by', auth()->user()->id)->value('quantity') }}</span>
                                                    <span class="w-full ml-2" wire:loading.remove wire:target='addToCart({{ $product->id }})'><i class="fa fa-chevron-circle-right text-green-500" aria-hidden="true"></i></span>
                                                @else
                                                    <span class="flex items-center flex-nowrap" wire:loading.remove wire:target='addToCart({{ $product->id }})'>
                                                        +Cart
                                                    </span>
                                                @endif 
                                                <span wire:loading wire:target='addToCart({{ $product->id }})'>...</span>
                                            </span>
                                        @else
                                            <a class="flex items-center space-x-2 text-gray-500 cursor-not-allowed dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-300"><span>Habis</span></a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach ($productsAllModal as $product)
                    <!-- Start ModalProduk -->
                    <span id="modalProd-{{ $product->id }}" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-focus-management-modal-{{ $product->id }}" data-hs-overlay="#hs-focus-management-modal-{{ $product->id }}"
                        class="absolute top-0 -z-50"> modalProduk </span>
                      <div id="hs-focus-management-modal-{{ $product->id }}" class="[--body-scroll:true] [--overlay-backdrop:false] hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto" role="dialog" tabindex="-1" aria-labelledby="hs-focus-management-modal-label">
                        <div class="m-3 mt-0 transition-all ease-out opacity-0 hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 sm:max-w-lg sm:w-full sm:mx-auto">
                          {{-- <form > --}}
                            <div class="flex flex-col border shadow-sm pointer-events-auto bg-gray-50 rounded-xl">
                              <div class="flex items-center justify-between px-4 py-3 border-b">
                                <h3 class="font-bold text-gray-800">
                                  {{ $product->name }} : {{ $product->variant }}
                                </h3>
                                <div class="flex justify-end">
                                    <a href="/products/{{ $product->slug }}" class="inline-flex items-center justify-center mr-2 text-gray-800 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200">
                                        <i class="fa fa-share text-blue-500" aria-hidden="true"></i>
                                    </a>
                                    <button type="button" class="inline-flex items-center justify-center text-red-400 bg-gray-100 border border-transparent rounded-full size-8 gap-x-2 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled" aria-label="Close" data-hs-overlay="#hs-focus-management-modal-{{ $product->id }}">
                                        <span class="sr-only">Close</span>
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 6 6 18"></path>
                                            <path d="m6 6 12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                </div>
                              <div class="p-4 overflow-y-auto">
                                <label for="input-label" class="block mb-2 text-sm font-medium">Quantity : <span class="text-blue-500">{{ $cartcek->where('product_id', $product->id)->where('created_by', auth()->user()->id)->value('quantity') }} </span></label>
                                <input 
                                type="number" id="thisqty" name="thisqty" wire:model='thisqty' 
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" 
                                class="block w-full px-4 py-3 text-sm text-center border-gray-200 rounded-lg focus:border-green-400 focus:ring-green-400" 
                                @if ($cartcek->where('product_id', $product->id)->where('created_by', auth()->user()->id)->value('quantity') > 0)
                                wire:keyup.enter='addToCart({{ $product->id }}); soundBeep.play();'
                                placeholder="ubah qty" 
                                @else
                                wire:keyup.enter='addToCart({{ $product->id }}); setTimeout(scrollBottom, 5000); soundBeep.play();'
                                placeholder="inputkan qty" 
                                @endif 
                                autofocus="">
                              </div>
                              <div class="flex items-center px-4 py-3 border-t gap-x-2 {{ $cartcek->where('product_id', $product->id)->where('created_by', auth()->user()->id)->value('quantity') > 0 ? 'justify-between' : 'justify-end' }}">
                                @if ($cartcek->where('product_id', $product->id)->where('created_by', auth()->user()->id)->value('quantity') > 0)
                                <button type="button" wire:click='removeItem({{ $product->id }})'
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-red-400 rounded-lg gap-x-2 hover:bg-gray-400 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled" data-hs-overlay="#hs-focus-management-modal-{{ $product->id }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                                @endif
                                <div>
                                <button type="button" class="closeButtonModalProduk inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg gap-x-2 hover:bg-gray-300 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled" data-hs-overlay="#hs-focus-management-modal-{{ $product->id }}">
                                  Batal
                                </button>
                                <button type="button"
                                id='addToCartButton' 
                                @if ($cartcek->where('product_id', $product->id)->where('created_by', auth()->user()->id)->value('quantity') > 0)
                                    wire:click='addToCart({{ $product->id }}); soundBeep.play();'
                                @else
                                    wire:click='addToCart({{ $product->id }}); setTimeout(scrollBottom, 5000); soundBeep.play();'
                                @endif
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-lg gap-x-2 hover:bg-green-600 focus:bg-green-600 focus:outline-none disabled:opacity-50 disabled" data-hs-overlay="#hs-focus-management-modal-{{ $product->id }}">
                                    Simpan
                                </button> 
                                </div>
                      
                              </div>
                            </div>
                          {{-- </form> --}}
                        </div>
                      </div>
                    <!-- End ModalProduk -->
                      @endforeach

                    </div>
                    {{-- Product Card End --}}

                    <!-- pagination start -->
                    {{-- <style>
                        nav div div p {
                            margin-left: 20px;
                            margin-right: 20px;
                        }
                    </style> --}}
                    <div 
                    class="mx-6"
                    >
                        {{ $products->links() }}
                    </div>
                    <!-- pagination end -->

                    


                </div>
                {{-- Grid End --}}

                {{-- LIST ITEM START --}}
                <div id="ListItem" class="fixed left-0 w-1/3 h-screen p-2 overflow-auto bg-white">
                      
                       <div class="pb-28">
                            <table class="w-full">
                                <body class="w-full">
                                    @forelse ($cart_items as $item)
                                    <tr class="text-xs font-normal bg-gray-100 border border-gray-300 lg:text-sm" wire:key='{{ $item['id'] }}' wire:loading.class="bg-red-300" wire:loading.class.remove="bg-gray-100" wire:target='removeItem({{ $item['product_id'] }})'>
                                        @php
                                            $panjangNama = $item['name'].$item['name'];
                                        @endphp
                                        <td>
                                            <div class="absolute w-[80%] sm:w-full pl-2 {{ Str::length($panjangNama) > 27 ? 'xs:-mt-6 -mt-8' : '-mt-5' }} text-wrap sm:mt-0 sm:relative">
                                                <a href="/products/{{ $item['slug'] }}" class="hover:text-blue-500">{{ $loop->iteration }}.
                                                    @if (Str::contains($item['variant'], $item['name']))
                                                    {{ $item['variant'] }}
                                                    @else
                                                    {{ $item['name'] }} {{ $item['variant'] }}
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                        <td onclick="showModalPro({{ $item['product_id'] }})" class="{{ Str::length($panjangNama) > 27 ? 'xs:pt-8 pt-12' : 'pt-5' }} sm:pt-0 cursor-pointer hover:bg-gray-300" 
                                            {{-- aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-focus-management-modal-{{ $item['product_id'] }}" data-hs-overlay="#hs-focus-management-modal-{{ $item['product_id'] }}" --}}
                                            >
                                            <div class="w-10 p-1 text-right">
                                                    <b>{{ $item['quantity'] }}</b>
                                                
                                            </div>
                                        </td>
                                        <td class="{{ Str::length($panjangNama) > 27 ? 'xs:pt-8 pt-12' : 'pt-5' }} sm:pt-0"><div class="p-1 text-end">@formatNumber($item['total_amount'])</div></td>
                                        <td wire:click='removeItem({{ $item['product_id'] }})' class="text-center cursor-pointer hover:bg-red-400">
                                            <span class="p-1" wire:loading.remove wire:target='removeItem({{ $item['product_id'] }})'>X</span><span class="p-1" wire:loading wire:target='removeItem({{ $item['product_id'] }})'>...</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <div colspan="5" class="py-4 text-xl font-semibold text-center text-slate-500">No items available in cart!</div>
                                    @endforelse
                                    
                                </body>
                            </table>
                            @if ($cartcek->where('branch_id', auth()->user()->branch_id)->where('created_by', auth()->user()->id)->count() > 0)
                            <div class="w-full pt-5 mx-auto text-center">
                                <button wire:dblclick='clearItemByBranch({{ Auth::user()->branch_id }})'  
                                    class="text-sm font-semibold text-red-500 underline cursor-pointer underline-offset-2">
                                    <span class="p-1" wire:loading.remove wire:target='clearItemByBranch({{ Auth::user()->branch_id }})'>Clear</span>
                                    <span class="p-1" wire:loading wire:target='clearItemByBranch({{ Auth::user()->branch_id }})'>......</span>
                                </button>
                            </div>
                            @endif
                      </div>
                  
                      <div class="fixed left-0 w-1/3 px-2 py-2 mt-2 -mb-2 bg-white bottom-2">
                        <div class="flex justify-between w-full mb-2">
                            <div>
                                Qty : {{ $cartcek->where('branch_id', auth()->user()->branch_id)->where('created_by', auth()->user()->id)->sum('quantity') }}
                            </div>
                            <div class="font-bold text-end">TOTAL : @formatNumber($grand_total)</div>
                        </div>

                        <div class="flex justify-between w-full">
                            <a >
                                <button wire:click='refreshPage();' class="px-4 py-2 text-sm text-center text-white bg-yellow-500 hover:bg-yellow-600">
                                    <i class="fa fa-refresh" wire:loading.remove wire:target='refreshPage();' class="mx-auto text-white"></i>
                                    <div wire:loading wire:target='refreshPage();' wire:loading.class="inline-block" class="hidden -mb-1 animate-spin size-5 border-[3px] border-current border-t-transparent text-white-600 rounded-full dark:text-orange-500" role="status" aria-label="loading">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                </button>
                            </a>
                            <a href="/checkout?branch_id={{ auth()->user()->branch_id }}"
                                class="w-full py-2 text-sm text-center text-white bg-blue-500 hover:bg-blue-600">
                                <button class="hidden mx-auto sm:flex">
                                    CHECKOUT
                                </button>
                                <button class="text-center sm:hidden">
                                    CO
                                </button>
                            </a>
                            <a>
                                <button onclick="toggle_full_screen();" class="px-4 py-2 text-sm text-center text-white bg-green-500 hover:bg-green-600">
                                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>

                      </div>

                </div>
                {{-- LIST ITEM END --}}

            </div>
    </section>

    @auth
        @if (auth()->user()->is_admin == 1)
            <audio controls id="sound-beep" src="/storage/audio/beep-barcode-kasir.mp3" preload="auto"
                class="hidden"></audio>
        @endif
    @endauth
    <script>
        const addToCartButton = document.getElementById('addToCartButton');
        const soundBeep = document.getElementById('sound-beep');
        let elemListItem = document.getElementById('ListItem');
        
        addToCartButton.addEventListener('click', function() {
            setTimeout(scrollBottom, 5000);
            soundBeep.play();
        });

        function scrollBottom() {
         elemListItem.scrollTop = elemListItem.scrollHeight;
        }; 

        function showModalPro(id) {
            let IDnya = "modalProd-"+id;
            let ProdID = document.getElementById(IDnya);
            ProdID.click();
        }

     function toggle_full_screen()
        {
            if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen))
            {
                if (document.documentElement.requestFullScreen){
                    document.documentElement.requestFullScreen();
                }
                else if (document.documentElement.mozRequestFullScreen){ /* Firefox */
                    document.documentElement.mozRequestFullScreen();
                }
                else if (document.documentElement.webkitRequestFullScreen){   /* Chrome, Safari & Opera */
                    document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                }
                else if (document.msRequestFullscreen){ /* IE/Edge */
                    document.documentElement.msRequestFullscreen();
                }
            }
            else
            {
                if (document.cancelFullScreen){
                    document.cancelFullScreen();
                }
                else if (document.mozCancelFullScreen){ /* Firefox */
                    document.mozCancelFullScreen();
                }
                else if (document.webkitCancelFullScreen){   /* Chrome, Safari and Opera */
                    document.webkitCancelFullScreen();
                }
                else if (document.msExitFullscreen){ /* IE/Edge */
                    document.msExitFullscreen();
                }
            }
        }
    //  function full_screen_on()
    //     {
    //         if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen))
    //         {
    //             if (document.documentElement.requestFullScreen){
    //                 document.documentElement.requestFullScreen();
    //             }
    //             else if (document.documentElement.mozRequestFullScreen){ /* Firefox */
    //                 document.documentElement.mozRequestFullScreen();
    //             }
    //             else if (document.documentElement.webkitRequestFullScreen){   /* Chrome, Safari & Opera */
    //                 document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
    //             }
    //             else if (document.msRequestFullscreen){ /* IE/Edge */
    //                 document.documentElement.msRequestFullscreen();
    //             }
    //         }
    //     }

    window.addEventListener('pos-page', event => {
		   window.location.reload(false); 
		})
    </script>

</div>
