<div class="w-full max-w-[85rem] py-5 px-0 sm:px-0 lg:px-2 mx-auto">
    <div class="flex w-full h-full">
      <main class="w-full mx-auto p-4">
        <div class="flex w-full justify-center mx-auto h-auto">
          <div class="block w-full md:w-1/2 items-center rounded-[20px] mx-auto p-4 bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
              <div class="relative flex h-32 w-full justify-center rounded-xl bg-cover" >
                  <img src="{{ url('storage/Wallpaper-Hitam-Taibah.png') }}" class="absolute flex h-32 w-full justify-center rounded-xl object-cover"> 
                  <div class="absolute -bottom-12 flex h-[87px] w-[87px] items-center justify-center rounded-full border-[4px] border-white bg-pink-400 dark:!border-navy-700">
                      <img class="h-full w-full rounded-full" 
                      @if (auth()->user()->image != null)
                          src="{{ url('storage/'.auth()->user()->image) }}"
                      @else
                          src="{{ url('storage/users/avatar/user.png') }}"
                      @endif
                     
                      alt="" />
                  </div>
              </div> 
              <div class="mt-16 flex flex-col items-center">
                  <h4 class="text-xl font-bold text-navy-700 dark:text-white">
                    {{ auth()->user()->name }}
                  </h4>
                  <p class="text-base font-normal text-gray-600">{{ auth()->user()->email }}</p>
              </div> 
              <div class="mt-6 mb-8 flex justify-between gap-14 md:!gap-14">
                  <div class="flex flex-col items-center justify-center">
                  <p class="text-2xl font-bold text-navy-700 dark:text-white">
                      {{ $orderscount }}
                  </p>
                  <p class="text-sm font-normal text-gray-600">Orders</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                  <p class="text-2xl font-bold text-navy-700 dark:text-white">
                      @currency($ordersamount)
                  </p>
                  <p class="text-sm font-normal text-gray-600">Spend</p>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                  <p class="text-2xl font-bold text-navy-700 dark:text-white">
                      @formatNumber(auth()->user()->poin)
                  </p>
                  <p class="text-sm font-normal text-gray-600">Poin</p>
                  </div>
              </div>

              <a href="/my-account-edit">
                <div class="block items-center rounded-lg mx-auto my-2 p-4 w-full hover:bg-yellow-400 bg-gray-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                  Edit My Account<span class="fa fa-arrow-circle-right mt-[4px] float-right" aria-hidden="true"></span>
                </div>
              </a>
              <a href="/my-orders">
                <div class="block items-center rounded-lg mx-auto my-2 p-4 w-full hover:bg-yellow-400 bg-gray-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                  My Orders<span class="fa fa-arrow-circle-right mt-[4px] float-right" aria-hidden="true"></span>
                </div>
              </a>
              <a href="#">
                <div class="block items-center rounded-lg mx-auto my-2 p-4 w-full hover:bg-yellow-400 bg-gray-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                  Syarat dan Ketentuan<span class="fa fa-arrow-circle-right mt-[4px] float-right" aria-hidden="true"></span>
                </div>
              </a>
              <a href="https://wa.me/6287881231119">
                <div class="block items-center rounded-lg mx-auto my-2 p-4 w-full hover:bg-yellow-400 bg-gray-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                  Bantuan<span class="fa fa-arrow-circle-right mt-[4px] float-right" aria-hidden="true"></span>
                </div>
              </a>
              {{-- <a href="/logout">
                <div class="block items-center rounded-lg mx-auto my-2 p-4 w-full hover:bg-yellow-400 bg-yellow-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                  Logout<span class="fa fa-arrow-circle-right mt-[4px] float-right" aria-hidden="true"></span>
                </div>
              </a> --}}
          </div>  
          {{-- <p class="font-normal text-navy-700 mt-20 mx-auto w-max">Profile Card component from <a href="https://horizon-ui.com?ref=tailwindcomponents.com" target="_blank" class="text-brand-500 font-bold">Horizon UI Tailwind React</a></p>   --}}
      </div>
      </main>
    </div>

  </div>