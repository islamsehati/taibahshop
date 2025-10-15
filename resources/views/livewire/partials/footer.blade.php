<footer
    class="bg-gray-900 w-full md:pb-0 pb-4
{{ request()->is('cart') ? ' hidden' : '' }} 
 {{ request()->is('checkout') ? ' hidden' : '' }}
 {{ request()->is('my-account') ? ' hidden' : '' }}
 {{ request()->is('pos') ? ' hidden' : '' }}
 {{ request()->is('mypos') ? ' hidden' : '' }}
   ">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-20 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            <div class="col-span-full lg:col-span-1">
                <a class="flex-none text-xl font-semibold text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#" aria-label="Brand">TaibahShop</a>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-gray-100">Product</h4>

                <div class="mt-3 grid space-y-3">
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/categories">Kategori & Merk</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/products">Semua Produk</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/products?promo[0]=1">Promo</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/products?featured[0]=1">Unggulan</a></p>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-gray-100">Company</h4>

                <div class="mt-3 grid space-y-3">
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="https://wa.me/6281370100057">Kritik & Saran</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="https://wa.me/6282134780459">Kemitraan</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/my-account">Syarat & Ketentuan</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="https://maps.app.goo.gl/PTGybivvA7khCNHE9">Tentang kami</a></p>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-span-2">
                <h4 class="font-semibold text-gray-100">Stay up to date</h4>

                <form>
                    <div
                        class="mt-4 flex flex-col items-center gap-2 sm:flex-row sm:gap-3 bg-white rounded-lg p-2 dark:bg-gray-800">
                        <div class="w-full">
                            <input id="pesanWA" type="text" name="pesanWA"
                                class="py-3 px-4 block w-full border-transparent rounded-lg text-sm focus:border-red-500 focus:ring-red-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-transparent dark:text-gray-400 dark:focus:ring-gray-600"
                                placeholder="Kirim pesan...">
                        </div>
                        <a onclick="sendWA()"
                            class="cursor-pointer w-full sm:w-auto whitespace-nowrap p-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                            Kirim
                        </a>
                    </div>

                </form>
                <script>
                    function sendWA() {
                        let typedText = document.querySelector('#pesanWA').value;
                        window.open('https://wa.me/6281370100057?text=' + typedText);
                        // window.location.href = 'https://wa.me/6281370100057?text='+typedText;
                    }
                </script>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->

        <div class="mt-5 sm:mt-12 grid gap-y-2 sm:gap-y-0 sm:flex sm:justify-between sm:items-center">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-400">© 2023 - <?php echo date('Y'); ?> TaibahShop. All rights reserved.</p>
            </div>
            <!-- End Col -->

            <!-- Social Brands -->
            <div>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
                    href="https://wa.me/6281370100057">
                    <i class="fa fa-whatsapp scale-125" aria-hidden="true"></i>
                </a>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
                    href="https://web.facebook.com/profile.php?id=100089189809064">
                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                </a>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
                    href="https://www.instagram.com/taibah.fc/">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
                    href="https://maps.app.goo.gl/PTGybivvA7khCNHE9">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                </a>

            </div>
            <!-- End Social Brands -->
        </div>
    </div>





</footer>
