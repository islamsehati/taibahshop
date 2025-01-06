<div class="w-full max-w-[85rem] pt-5 pb-10 px-4 sm:px-6 lg:px-8 mx-auto">

  <div class="text-lg font-semibold">Categories</div>
  <div 
  x-data="{}"
    x-init="$nextTick(() => {
        let ul = $refs.logos;
        ul.insertAdjacentHTML('afterend', ul.outerHTML);
        ul.nextSibling.setAttribute('aria-hidden', 'true');
    })"
  class="w-full overflow-x-auto lg:no-scrollbar mt-3 mb-7">
    <div class="inline-flex flex-nowrap whitespace-nowrap">
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
  