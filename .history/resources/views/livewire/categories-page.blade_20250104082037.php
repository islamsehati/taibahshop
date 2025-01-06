<div class="w-full max-w-[85rem] pt-7 pb-10 px-4 sm:px-6 lg:px-8 mx-auto">

  <!-- Slider -->
  <div class="{{ $jumbotrons != null ? 'hidden' : ''}}">

  <div wire:ignore data-hs-carousel='{
    "isAutoPlay": true,
    "loadingClasses": "opacity-0",
    "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500"
    }' class="relative mb-7">
  <div class="hs-carousel relative overflow-hidden w-full lg:min-h-[30rem] md:min-h-80 sm:min-h-64 min-h-48 bg-white rounded-xl">
    <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
      
      @foreach ($jumbotrons as $jumbotron)
      <div class="hs-carousel-slide">
        <a wire:key="{{ $jumbotron->id }}" href='{{ $jumbotron->link }}'>
          <img src="{{ url('storage', $jumbotron->image) }}" alt="{{ $jumbotron->name }}" class="object-cover object-center w-full">
        </a>
      </div>
      @endforeach

    </div>
  </div>
  <button type="button" class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
    <span class="text-2xl" aria-hidden="true">
      <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"></path>
      </svg>
    </span>
    <span class="sr-only">Previous</span>
  </button>
  <button type="button" class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
    <span class="sr-only">Next</span>
    <span class="text-2xl" aria-hidden="true">
      <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m9 18 6-6-6-6"></path>
      </svg>
    </span>
  </button>
  <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2"></div>
  </div>

  </div>
  <!-- End Slider -->

  <div class="flex items-center justify-between">
    <div class="text-lg font-semibold">Categories</div>
    <label class="relative block text-center">
      <span class="sr-only">Search</span>
      <span class="text-red-400 absolute inset-y-0 right-0 flex items-center pl-2">
        <i class="fa fa-search" aria-hidden="true"></i>
      </span>
      <input wire:model.live="cariCat" class="placeholder:italic placeholder:text-red-400 block bg-transparent w-full pl-0 pr-0 shadow-sm focus:outline-none focus:border-transparent focus:ring-transparent focus:ring-1 sm:text-sm" type="text" name="search"/>
    </label>
  </div>

  <div
  class="w-full overflow-x-auto lg:no-scrollbar mt-3 mb-7 pb-4">
    <div class="inline-flex flex-nowrap">
      
      <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-0">
          @if ($cariCat == null)       
          <li>
            <a href="products?featured[0]=1" class="text-center mx-auto">
              <div class="h-16 w-16 mx-2 ml-0 bg-white hover:bg-yellow-200 border-white rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
                <div class="">
                  <img class="relative -bottom-2 h-12 w-12 mx-auto" src="{{ url('storage/star_15822141.png') }}" alt="Featured Product">
                </div>
                <div class="mt-5">
                  <p class="leading-none line-clamp-2 text-xs pb-2">Unggulan</p> 
                </div>
              </div>
            </a>
          </li>
          <li>
            <a href="products?promo[0]=1" class="text-center mx-auto">
              <div class="h-16 w-16 mx-2 bg-white hover:bg-yellow-200 border-white rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
                <div class="">
                  <img class="relative -bottom-2 h-12 w-12 mx-auto" src="{{ url('storage/indonesian-rupiah_7051105.png') }}" alt="Featured Product">
                </div>
                <div class="mt-5">
                  <p class="leading-none line-clamp-2 text-xs pb-2">Promo</p> 
                </div>
              </div>
            </a>
          </li>
          @endif
          @foreach ($categories->where('name', 'LIKE', '%' . $cariCat . '%')->get() as $category)  
          <li>
            <a wire:key="{{ $category->id }}" href="products?selected_categories[0]={{ $category->id }}" class="text-center mx-auto">
              <div class="h-16 w-16 mx-2 bg-white hover:bg-yellow-200 border-white rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
                <div class="">
                  <img class="relative -bottom-2 h-12 w-12 mx-auto" src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}">
                </div>
                <div class="mt-5">
                  <p class="leading-none line-clamp-2 text-xs pb-2">{{ $category->name }}</p> 
                </div>
              </div>
            </a>
          </li>
          @endforeach 
      </ul>
      
    </div>
  </div>

  <div class="flex items-center justify-between">
    <div class="text-lg font-semibold">Brands</div>
    <label class="relative block text-center">
      <span class="sr-only">Search</span>
      <span class="text-red-400 absolute inset-y-0 right-0 flex items-center pl-2">
        <i class="fa fa-search" aria-hidden="true"></i>
      </span>
      <input wire:model.live="cariBrn" class="placeholder:italic placeholder:text-red-400 block bg-transparent w-full pl-0 pr-0 shadow-sm focus:outline-none focus:border-transparent focus:ring-transparent focus:ring-1 sm:text-sm" type="text" name="search"/>
    </label>
  </div>

  <div class="mt-3 grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-4 sm:gap-6">
    @foreach ($brands->where('name', 'LIKE', '%' . $cariBrn . '%')->get() as $brand)
    <a wire:key="{{ $brand->id }}" class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products?selected_brands[0]={{ $brand->id }}">
      <div class="p-4 md:p-5">
        <div class="flex justify-between items-center">
          <div class="flex items-center">
            <img class="h-[5rem] w-[5rem] object-contain" src="{{ url('storage', $brand->image) }}" alt="{{ $brand->name }}">
            <div class="ms-3">
              <h3 class="group-hover:text-yellow-400 text-2xl font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                {{ $brand->name }}
              </h3>
            </div>
          </div>
          <div class="ps-3">
            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m9 18 6-6-6-6" />
            </svg>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>

  </div>
  