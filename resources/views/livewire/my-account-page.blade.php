<div class="w-full max-w-[85rem] pt-0 pb-5 px-0 sm:pt-3 sm:pb-16 sm:px-0 lg:px-2 mx-auto">
  <div class="flex w-full h-full">
    <main class="w-full mx-auto pb-5 sm:p-4">
      <div class="flex w-full justify-center mx-auto h-auto">
        <div class="block w-full md:w-1/2 items-center sm:rounded-xl mx-auto p-4 pt-6 bg-white bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
            <div class="flex h-32 w-full justify-center rounded-xl bg-cover" >
                <img src="{{ url('storage/Wallpaper-Hitam-Taibah.png') }}" class=" flex h-32 w-full justify-center rounded-xl object-cover"> 
                <div class="absolute mt-20 h-20 w-20 items-center rounded-full border-4 border-white bg-white dark:!border-navy-700" style="border-width: 3px;border-style: solid;">
                    <img class="h-full w-full rounded-full" @if (auth()->user()->image != null) src="{{ url('storage/'.auth()->user()->image) }}" @else src="{{ url('storage/users/avatar/user.png') }}" @endif alt="" />
                </div>
            </div> 
            <div class="mt-10 flex flex-col items-center">
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
              <div class="block items-center rounded-lg mx-auto my-2 pl-12 p-4 w-full hover:bg-red-300 bg-gray-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                <i class="text-red-500 fa fa-pencil-square-o relative -left-6 scale-[200%]" aria-hidden="true"></i>Edit My Account<span class="fa fa-arrow-circle-right text-gray-500" style="float:right;margin-top:4px" aria-hidden="true"></span>
              </div>
            </a>
            <a href="/my-orders">
              <div class="block items-center rounded-lg mx-auto my-2 pl-12 p-4 w-full hover:bg-red-300 bg-gray-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                <i class="text-red-500 fa fa-envelope-o relative -left-6 scale-[200%]" aria-hidden="true"></i>My Orders<span class="fa fa-arrow-circle-right text-gray-500" style="float:right;margin-top:4px" aria-hidden="true"></span>
              </div>
            </a>
            <a aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-focus-management-modal-x" data-hs-overlay="#hs-focus-management-modal-x">
              <div class="cursor-pointer block items-center rounded-lg mx-auto my-2 pl-12 p-4 w-full hover:bg-red-300 bg-gray-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                <i class="text-red-500 fa fa-file-text-o relative -left-6 scale-[200%]" aria-hidden="true"></i>Syarat dan Ketentuan<span class="fa fa-arrow-circle-right text-gray-500" style="float:right;margin-top:4px" aria-hidden="true"></span>
              </div>
            </a>
            <a href="https://wa.me/6287881231119">
              <div class="block items-center rounded-lg mx-auto my-2 pl-12 p-4 w-full hover:bg-red-300 bg-gray-100 bg-clip-border shadow-3xl shadow-shadow-500 dark:!bg-navy-800 dark:text-white dark:!shadow-none">
                <i class="text-red-500 fa fa-question-circle-o relative -left-6 scale-[200%]" aria-hidden="true"></i>Bantuan<span class="fa fa-arrow-circle-right text-gray-500" style="float:right;margin-top:4px" aria-hidden="true"></span>
              </div>
            </a>
            
            <div id="hs-focus-management-modal-x" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-focus-management-modal-label">
              <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                {{-- <form > --}}
                  <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                    <div class="flex justify-between items-center py-3 px-4 border-b">
                      <h3 id="hs-focus-management-modal-label" class="font-bold text-gray-800">
                        Syarat & Ketentuan
                      </h3>
                      <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-focus-management-modal-x">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M18 6 6 18"></path>
                          <path d="m6 6 12 12"></path>
                        </svg>
                      </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                      <span for="input-label" class="block text-sm font-medium mt-3 mb-1">TRANSAKSI PEMBELIAN</span>
                      <div>
                        Pembelian produk Taibahshop dapat dilakukan dengan cara "Dine in", “Self Pick Up” dan “Delivery”.
                      </div>
                      <div>
                      (1) Dine in :
                      </div>
                      <div>
                        Melayani sepenuh hati dengan menyediakan tempat duduk di Teras, Family Room atau VIP Room.
                      </div>
                      <div>
                        (2) Self Pick Up :
                      </div>
                      <div>
                        Setiap pelanggan wajib menginformasikan pukul berapa pesanan akan diambil sendiri. Bagian dapur dan kasir akan menyiapkan pesanan dengan sebaik-baiknya sebelum pelanggan datang mengambil. Informasikan juga orang yang mengambil adalah pemesan sendiri atau diwakilkan.
                      </div>
                      <div>
                        (3) Delivery :
                      </div>
                      <div>
                        Kami membutuhkan waktu beberapa menit yang berbeda ke setiap lokasi pengiriman. Setiap ongkos kirim ke lokasi tidak dapat ditentukan oleh pelanggan dan harga tergantung radius kilometer.
                      </div>
                      <span for="input-label" class="block text-sm font-medium mt-3 mb-1">HARGA</span>
                      <div>
                        Harga dapat berubah tanpa pemberitahuan ke semua pelanggan, mohon untuk bisa mengecek invoice di depan kasir atau kurir taibah. Ajukan pertanyaan pada saat itu juga jika harga berbeda dari informasi yang di dapat sebelumnya.
                      </div>
                      <span for="input-label" class="block text-sm font-medium mt-3 mb-1">PROMO</span>
                      <div>
                        Promo yang telah dirilis lalu di pilih oleh pelanggan, sewaktu-waktu dapat dibatalkan karena terbatas ketersediaan atau stok bahan.
                      </div>
                      </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                      <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-focus-management-modal-x">
                        Tutup
                      </button>
                      <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-400 text-white hover:bg-yellow-500 focus:outline-none focus:bg-yellow-500 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-focus-management-modal-x">
                        Setuju
                      </button>
                    </div>
                  </div>
                {{-- </form> --}}
              </div>
            </div>


        </div>  
        {{-- <p class="font-normal text-navy-700 mt-20 mx-auto w-max">Profile Card component from <a href="https://horizon-ui.com?ref=tailwindcomponents.com" target="_blank" class="text-brand-500 font-bold">Horizon UI Tailwind React</a></p>   --}}
    </div>
    </main>
  </div>

</div>