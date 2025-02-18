<header class="{{ request()->is('pos')?'hidden' : 'flex'}} {{ request()->is('checkout')?'hidden' : 'flex'}}   
  z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-red-500 text-sm md:py-0 py-0 dark:bg-gray-800 shadow-md">
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
    <div class="
    {{ request()->is('my-account')?'hidden' : 'relative'}} 
      md:flex md:items-center md:justify-between">
      <div class="flex items-center justify-between">

        <a class="flex-none text-xl font-lobster text-yellow-400 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/" aria-label="Brand">TaibahShop</a>
        
        <div class="px-5 md:hidden font-medium flex items-center hover:text-gray-800 hover:lg:bg-yellow-500 hover:lg:h-2 hover:lg:pt-6 hover:lg:my-[0.68rem] hover:lg:px-3 hover:lg:-mx-3 hover:rounded-lg py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/cart">
            <label class="relative block text-center">
              <span class="sr-only">Search</span>
              <span class="text-red-400 absolute inset-y-0 right-0 flex items-center pl-2">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
              <input wire:keyup.enter='cariProduk()' wire:model="cari" class="placeholder:italic placeholder:text-red-400 block bg-red-500 w-full pl-0 pr-0 shadow-sm focus:outline-none focus:border-transparent focus:ring-transparent focus:ring-1 sm:text-sm" placeholder="Search menu..." type="search" name="search"/>
            </label>
        </div>

        @guest
          <a style="padding:5px 7px 5px 7px;" class="md:hidden px-3 py-1.5 inline-flex items-center text-sm text-nowrap font-semibold rounded-lg border border-transparent bg-yellow-400 text-white hover:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/login">
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
            Log in
          </a>
        @endguest

        @auth
        <a class="md:hidden font-medium flex items-center {{ request()->is('cart')?' text-white bg-yellow-500 px-2' : 'text-white'}} hover:text-gray-800 hover:lg:bg-yellow-500 hover:lg:h-2 hover:lg:pt-6 hover:lg:my-[0.68rem] hover:lg:px-3 hover:lg:-mx-3 hover:rounded-lg py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/cart">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
          </svg>
          <span class="mr-1">Cart</span> <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-red-50 border border-red-200 text-red-600">{{ $total_count }}</span>
        </a>
        @endauth
        
        <div class="hidden">
          <button type="button" class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="3" x2="21" y1="6" y2="6" />
              <line x1="3" x2="21" y1="12" y2="12" />
              <line x1="3" x2="21" y1="18" y2="18" />
            </svg>
            <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 6 6 18" />
              <path d="m6 6 12 12" />
            </svg>
          </button>
        </div>
      </div>

      <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
        <div class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
          <div class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700 pr-3">
            
            <a class="font-medium {{ request()->is('/')?' text-yellow-400' : 'text-white'}} hover:lg:text-red-500 hover:lg:bg-yellow-500 hover:lg:h-2 hover:lg:pt-1 hover:lg:px-3 hover:lg:-mx-3  hover:rounded-lg py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/" aria-current="page">Home</a> 

            <div class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--trigger:hover] max-md:pt-3 md:py-5 {{ request()->is('products') || request()->is('categories')?' md:bg-yellow-500 md:pt-3 md:pb-3 md:px-3 md:-mx-3 rounded-lg' : ''}} hover:text-white hover:lg:bg-yellow-500 hover:lg:h-2 hover:lg:pt-3 hover:lg:pb-8 hover:lg:px-3 hover:lg:-mx-3 hover:rounded-lg">
              <button type="button" class="flex items-center w-full text-white hover:text-gray-950 font-medium dark:text-gray-400 dark:hover:text-gray-500">
                Product
              </button>
  
              <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white md:shadow-md rounded-lg p-2 dark:bg-gray-800 md:dark:border dark:border-gray-700 dark:divide-gray-700 before:absolute top-full md:border before:-top-5 before:start-0 before:w-full before:h-5">
  
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" 
                href="/products">
                  All Product
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" 
                href="/products?featured[0]=1">
                Featured
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" 
                href="/products?promo[0]=1">
                Promo
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" 
                href="/categories">
                Categories
                </a>

              </div>
            </div>

            <a class="font-medium {{ request()->is('my-orders')?' text-yellow-400' : 'text-white'}}  hover:lg:text-red-500 hover:lg:bg-yellow-500 hover:lg:h-2 hover:lg:pt-1 hover:lg:px-3 hover:lg:-mx-3  hover:rounded-lg py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/my-orders">
              My Orders
            </a>

            <a class="hidden font-medium  md:flex items-center {{ request()->is('cart')?' text-yellow-400' : 'text-white'}} hover:text-gray-800 hover:lg:bg-yellow-500 hover:lg:h-2 hover:lg:pt-6 hover:lg:my-[0.68rem] hover:lg:px-3 hover:lg:-mx-3 hover:rounded-lg py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/cart">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="{{ request()->is('cart')?' text-yellow-400' : 'text-white'}} flex-shrink-0 w-5 h-5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
              <span class="mr-1 {{ request()->is('cart')?' text-yellow-400' : 'text-white'}}">Cart</span> <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-red-50 border border-red-200 text-red-600">{{ $total_count }}</span>
            </a>

            @guest
            <div class="pt-3 md:pt-0">
              <a class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-400 text-white hover:bg-yellow-500 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/login">
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
                Log in
              </a>
            </div>          
            @endguest

            @auth               
            <div class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--trigger:hover] max-md:pt-3 md:py-5 hover:text-white hover:lg:bg-yellow-500 hover:lg:h-2 hover:lg:pt-3 hover:lg:pb-8 hover:lg:px-3 hover:lg:-mx-3 hover:rounded-lg">
              <button type="button" class="flex items-center w-full {{ request()->is('my-account')?' text-yellow-400' : 'text-white'}} hover:text-gray-950 font-medium dark:text-gray-400 dark:hover:text-gray-500">
                {{ auth()->user()->name }}
              </button>
  
              <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white md:shadow-md rounded-lg p-2 dark:bg-gray-800 md:dark:border dark:border-gray-700 dark:divide-gray-700 before:absolute top-full md:border before:-top-5 before:start-0 before:w-full before:h-5">
                
                <!-- Header -->
                <div class="py-3 px-4 mb-2 border-b border-gray-200 dark:border-neutral-700">
                  <div class="flex items-center gap-x-3">
                    <img class="w-10 h-10 shrink-0 inline-block size-10 rounded-full ring-2 ring-white dark:ring-neutral-900" 
                    @auth
                    @if (auth()->user()->image != null)
                    src="{{ url('storage/'.auth()->user()->image) }}" 
                    @else
                    src="{{ url('storage/users/avatar/user.png') }}" 
                    @endif     
                    @endauth
                    @guest
                    src="{{ url('storage/users/avatar/user.png') }}" 
                    @endguest
                    alt="Avatar">
                    <div class="grow">
                      <p class="ml-0 text-sm text-gray-500 dark:text-neutral-500">
                        @auth
                        {{ auth()->user()->phone }}
                        @endauth
                        @guest
                            Anda belum MASUK
                        @endguest
                      </p>
                      <h4 class="font-semibold text-gray-800 dark:text-white">
                        @auth
                        <span class="ml-0 ms-0.5 inline-flex items-center align-middle gap-x-1.5 py-0.5 px-1.5 rounded-md text-[11px] font-medium bg-gray-800 text-white dark:bg-white dark:text-neutral-800">
                          @if (auth()->user()->is_admin == 1)
                          Admin
                          @else
                          Customer
                          @endif
                        </span>
                        @endauth
                      </h4>
                    </div>
                  </div>
                </div>
                <!-- End Header -->

                <a href="/admin" class="{{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}} flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                  Admin Panel <i class="fa fa-shield" aria-hidden="true"></i>
                </a>
                <a href="/pos" class="{{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}} flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                  POS <i class="fa fa-fax" aria-hidden="true"></i>
                </a>
                <a href="/items" class="{{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}} flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                  Items List <i class="fa fa-list" aria-hidden="true"></i>
                </a>
                <a href="/payments" class="{{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}} flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                  Payments List <i class="fa fa-money" aria-hidden="true"></i>
                </a>
  
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" 
                href="/branches">
                  Cabang <i class="fa fa-map-marker" aria-hidden="true"></i>
                </a>

                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" 
                href="/my-account">
                  Akun saya <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/logout">
                  Keluar <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
              </div>
            </div>
            @endauth

          </div>
        </div>
      </div>
    </div>
  </nav>

  <nav class="md:hidden fixed bottom-0 left-0 z-50 w-full h-10 bg-gray-800 dark:bg-gray-700 dark:border-gray-600">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto font-medium">
      
      <button onclick="location.href='/';" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
        <div class="w-5 h-5 mb-0.5 mx-auto {{ request()->is('/')?' text-yellow-500' : 'text-gray-500'}}  dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <i class="fa fa-home scale-[175%]" aria-hidden="true"></i>
        </div>
      </button>

      <button onclick="location.href='/categories';" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
        <div class="w-5 h-5 mb-0 mx-auto {{ request()->is('categories')?' text-yellow-500' : 'text-gray-500'}} dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <i class="fa fa-list scale-150" aria-hidden="true"></i>
        </div>
      </button>

      <button onclick="location.href='/products';" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
        <div class="w-5 h-5 mb-0 mx-auto {{ request()->is('products')?' text-yellow-500' : 'text-gray-500'}} dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <i class="fa fa-th-large scale-150" aria-hidden="true"></i>
        </div>
      </button>

      
      <button onclick="location.href='/my-orders';" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
          <div class="w-5 h-5 mb-1 mx-auto {{ request()->is('my-orders')?' text-yellow-500' : 'text-gray-500'}} dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <i class="fa fa-envelope scale-150" aria-hidden="true"></i>
          </div>
      </button>
      

      <div class="hs-dropdown [--placement:top-center] relative inline-flex flex-col pt-2 px-5 hover:bg-gray-50 group group">
      <button type="button" class="inline-flex flex-col items-center justify-center">
        <div class="w-5 h-5 mb-0 mx-auto  {{ request()->is('my-account')?' text-yellow-500' : 'text-gray-500'}} dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <i class="fa fa-user scale-150" aria-hidden="true"></i>
        </div>
      </button>
      <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 px-2 py-2 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropup">
        
        <!-- Header -->
        <div class="py-3 px-4 mb-1 border-b border-gray-200 dark:border-neutral-700">
          <div class="flex items-center gap-x-3">
            <a href="/my-account"><img class="w-10 h-10 shrink-0 inline-block size-10 rounded-full ring-2 ring-white dark:ring-neutral-900" 
            @auth
            @if (auth()->user()->image != null)
            src="{{ url('storage/'.auth()->user()->image) }}" 
            @else
            src="{{ url('storage/users/avatar/user.png') }}" 
            @endif     
            @endauth
            @guest
            src="{{ url('storage/users/avatar/user.png') }}" 
            @endguest
            alt="Avatar"></a>
            <div class="grow">
              <h4 class="font-semibold text-gray-800 dark:text-white">
                @auth
                {{ auth()->user()->name }}
                <span class="ml-0 ms-0.5 inline-flex items-center align-middle gap-x-1.5 py-0.5 px-1.5 rounded-md text-[11px] font-medium bg-gray-800 text-white dark:bg-white dark:text-neutral-800">
                  @if (auth()->user()->is_admin == 1)
                  Admin
                  @else
                  Customer
                  @endif
                </span>
                @endauth
              </h4>
              <p class="ml-0 text-sm text-gray-500 dark:text-neutral-500">
                @auth
                {{ auth()->user()->phone }}
                @endauth
                @guest
                    Anda belum MASUK
                @endguest
              </p>
            </div>
          </div>
        </div>
        <!-- End Header -->
        
        <div class="p-1 space-y-0.5">
          <a class=" @auth {{ auth()->user()->is_admin == 1 ?'flex' : 'hidden'}} @endauth @guest hidden @endguest items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
          href="/admin">
            Admin Panel <i class="fa fa-shield" aria-hidden="true"></i>
          </a>
          <a class=" @auth {{ auth()->user()->is_admin == 1 ?'flex' : 'hidden'}} @endauth @guest hidden @endguest items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
          href="/pos">
            POS <i class="fa fa-fax" aria-hidden="true"></i>
          </a>
          <a class=" @auth {{ auth()->user()->is_admin == 1 ?'flex' : 'hidden'}} @endauth @guest hidden @endguest items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
          href="/items">
            Items List <i class="fa fa-list" aria-hidden="true"></i>
          </a>
          <a class=" @auth {{ auth()->user()->is_admin == 1 ?'flex' : 'hidden'}} @endauth @guest hidden @endguest items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
          href="/payments">
            Payments List <i class="fa fa-money" aria-hidden="true"></i>
          </a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
          href="/branches">
          Cabang <i class="fa fa-map-marker" aria-hidden="true"></i>
          </a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
          href="/my-account">
            Syarat & Ketentuan <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
          </a>
          @guest
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/login">
            Masuk <i class="fa fa-sign-in" aria-hidden="true"></i>
          </a>
          @endguest
          @auth
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="/logout">
            Keluar <i class="fa fa-sign-out" aria-hidden="true"></i>
          </a>
          @endauth
        </div>
      </div>
      </div>

    </div>
  </nav>
</header>