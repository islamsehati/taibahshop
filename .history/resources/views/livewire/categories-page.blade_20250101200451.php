<div class="w-full max-w-[85rem] pt-7 pb-10 px-4 sm:px-6 lg:px-8 mx-auto">

  <!-- Slider -->
  <div data-hs-carousel='{
    "dotsItemClasses": "hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500",
    "loadingClasses": "opacity-0",
    "isAutoPlay": true
    }' class="relative mb-7">
  <div class="hs-carousel relative overflow-hidden w-full lg:min-h-[30rem] md:min-h-80 sm:min-h-64 min-h-48 bg-white rounded-xl">
    <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">
      <div class="hs-carousel-slide">
        <a href="/products">
          <img src="{{ url('storage/stylish-young-businessman-driving-car.jpg') }}" alt="" class="object-cover object-center w-full">
        </a>
      </div>
      <div class="hs-carousel-slide">
        <a href="/products">
          <img src="{{ url('storage/medium-shot-islamic-woman-lifestyle.jpg') }}" alt="" class="object-cover object-center w-full">
        </a>
      </div>
      <div class="hs-carousel-slide">
        <a href="/products">
          <img src="{{ url('storage/muslim-woman-hijab-working-office-room.jpg') }}" alt="" class="object-cover object-center w-full">
        </a>
      </div>
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
  <!-- End Slider -->

  <div class="flex items-center justify-between">
    <div class="text-lg font-semibold">Categories</div>
    <label class="relative block max-md:mt-4 max-md:mb-2">
      <span class="sr-only">Search</span>
      <span class="absolute inset-y-0 left-0 flex items-center pl-2">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 30 30">
          <path d="M 13 3 C 7.4889971 3 3 7.4889971 3 13 C 3 18.511003 7.4889971 23 13 23 C 15.396508 23 17.597385 22.148986 19.322266 20.736328 L 25.292969 26.707031 A 1.0001 1.0001 0 1 0 26.707031 25.292969 L 20.736328 19.322266 C 22.148986 17.597385 23 15.396508 23 13 C 23 7.4889971 18.511003 3 13 3 z M 13 5 C 17.430123 5 21 8.5698774 21 13 C 21 17.430123 17.430123 21 13 21 C 8.5698774 21 5 17.430123 5 13 C 5 8.5698774 8.5698774 5 13 5 z"></path>
        </svg>
      </span>
      <input wire:model.live="cariCat" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-20 shadow-sm focus:outline-none focus:border-yellow-400 focus:ring-yellow-400 focus:ring-1 sm:text-sm" type="text" name="search"/>
    </label>
  </div>

  <div 
  class="w-full overflow-x-auto lg:no-scrollbar mt-3 mb-7 pb-4">
    <div class="inline-flex flex-nowrap">
      
      <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-0">
          <li>
            <a href="products?featured[0]=1" class="text-center mx-auto">
              <div class="h-16 w-16 mx-2 bg-white hover:bg-yellow-200 border-white rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
                <div class="">
                  <img class="relative -bottom-2 h-12 w-12 mx-auto" src="{{ url('storage/star_15822141.png') }}" alt="Featured Product">
                </div>
                <div class="mt-5">
                  <p class="leading-none line-clamp-2 text-xs">Featured</p> 
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
                  <p class="leading-none line-clamp-2 text-xs">Promo</p> 
                </div>
              </div>
            </a>
          </li>
          @foreach ($categories->where('name', 'LIKE', '%' . $cariCat . '%')->get() as $category)  
          <li>
            <a wire:key="{{ $category->id }}" href="products?selected_categories[0]={{ $category->id }}" class="text-center mx-auto">
              <div class="h-16 w-16 mx-2 bg-white hover:bg-yellow-200 border-white rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
                <div class="">
                  <img class="relative -bottom-2 h-12 w-12 mx-auto" src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}">
                </div>
                <div class="mt-5">
                  <p class="leading-none line-clamp-2 text-xs">{{ $category->name }}</p> 
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
  