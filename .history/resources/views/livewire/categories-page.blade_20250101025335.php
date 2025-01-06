<div class="w-full max-w-[85rem] pt-7 pb-10 px-4 sm:px-6 lg:px-8 mx-auto">

  <!-- Slider -->


  <div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-1.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-2.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-3.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-4.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 5 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="/docs/images/carousel/carousel-5.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
    </div>
    <!-- Slider indicators -->
    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

  <!-- End Slider -->

  <div class="text-lg font-semibold">Categories</div>
  <div 
  x-data="{}"
    x-init="$nextTick(() => {
        let ul = $refs.logos;
        ul.insertAdjacentHTML('afterend', ul.outerHTML);
        ul.nextSibling.setAttribute('aria-hidden', 'true');
    })"
  class="w-full overflow-x-auto lg:no-scrollbar mt-3 mb-7 pb-6">
    <div class="inline-flex flex-nowrap">
      <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-0">
          @foreach ($categories as $category)  
          <li>
            <a wire:key="{{ $category->id }}" href="products?selected_categories[0]={{ $category->id }}" class="text-center mx-auto">
              <div class="h-20 w-20 mx-2 bg-white hover:bg-yellow-300 border-white rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
                <div>
                  <img class="h-16 w-16 mx-auto" src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}">
                </div>
                <div class="mt-5">
                  <p class="leading-none line-clamp-2">{{ $category->name }}</p> 
                </div>
              </div>
            </a>
          </li>
          @endforeach 
      </ul>
      <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-0">
          @foreach ($categories as $category)  
          <li>
            <a wire:key="{{ $category->id }}" href="products?selected_categories[0]={{ $category->id }}" class="text-center mx-auto">
              <div class="h-20 w-20 mx-2 bg-white hover:bg-yellow-300 border-white rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
                <div>
                <img class="h-16 w-16 mx-auto" src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}">
              </div>
              <div class="mt-4">
                {{ $category->name }}
              </div>
              </div>
            </a>
          </li>
          @endforeach 
      </ul>
      <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-0">
          @foreach ($categories as $category)  
          <li>
            <a wire:key="{{ $category->id }}" href="products?selected_categories[0]={{ $category->id }}" class="text-center mx-auto">
              <div class="h-20 w-20 mx-2 bg-white hover:bg-yellow-300 border-white rounded-full dark:bg-yellow-900 dark:text-yellow-300 text-grey-500">
                <div>
                <img class="h-16 w-16 mx-auto" src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}">
              </div>
              <div class="mt-4">
                {{ $category->name }}
              </div>
              </div>
            </a>
          </li>
          @endforeach 
      </ul>
    </div>
  </div>

  <div class="text-lg font-semibold">Brands</div>
  <div class="mt-3 grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-4 sm:gap-6">
    @foreach ($brands as $brand)
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
  