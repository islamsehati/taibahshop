<div>

    {{-- Hero Section Start --}}
    <div class="w-full md:h-screen h-800 bg-gradient-to-r from-yellow-300 to-red-400 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Grid -->
          <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
            <div>
              <h1 class="block text-4xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">Cicipi menu lezat bersama <span class="text-red-500">Taibah</span></h1>
              <p class="mt-3 text-lg text-gray-800 dark:text-gray-400">Cita rasa ayam goreng gurih bikin nagih. Balutan tepung yang premium dan spicy. "Rasakan nikmatnya penuh berkah".</p>
      
              <!-- Buttons -->
              <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                <a 
                @guest
                  href="/products" 
                @endguest
                @auth
                  href="/products"     
                @endauth
                class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-yellow-500 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                  Get started
                  <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </a>
                <a href="https://wa.me/6281370100057" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                  Contact sales team
                </a>
              </div>
              <!-- End Buttons -->
      
              <!-- Review -->
              <div class="mt-6 lg:mt-10 grid grid-cols-2 gap-x-5">
                <!-- Review -->
                <div class="py-5">
                  <div class="flex space-x-1">
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                  </div>
      
                  <p class="mt-3 text-sm text-gray-800 dark:text-gray-200">
                    <span class="font-bold">4.8</span> /5 - from 26 reviews
                  </p>
      
                  <div class="mt-5">
                    <!-- Star -->
                    <svg class="h-auto w-16 text-gray-800 dark:text-white" width="80" height="27" viewBox="0 0 80 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M20.558 9.74046H11.576V12.3752H17.9632C17.6438 16.0878 14.5301 17.7245 11.6159 17.7245C7.86341 17.7245 4.58995 14.7704 4.58995 10.6586C4.58995 6.62669 7.70373 3.51291 11.6159 3.51291C14.6498 3.51291 16.4063 5.42908 16.4063 5.42908L18.2426 3.51291C18.2426 3.51291 15.8474 0.878184 11.4961 0.878184C5.94724 0.838264 1.67578 5.50892 1.67578 10.5788C1.67578 15.5289 5.70772 20.3592 11.6558 20.3592C16.8854 20.3592 20.7177 16.8063 20.7177 11.4969C20.7177 10.3792 20.558 9.74046 20.558 9.74046Z" fill="currentColor" />
                      <path d="M27.8621 7.78442C24.1894 7.78442 21.5547 10.6587 21.5547 14.012C21.5547 17.4451 24.1096 20.3593 27.9419 20.3593C31.415 20.3593 34.2094 17.7645 34.2094 14.0918C34.1695 9.94011 30.896 7.78442 27.8621 7.78442ZM27.902 10.2994C29.6984 10.2994 31.415 11.7764 31.415 14.0918C31.415 16.4072 29.7383 17.8842 27.902 17.8842C25.906 17.8842 24.3491 16.2874 24.3491 14.0519C24.3092 11.8962 25.8661 10.2994 27.902 10.2994Z" fill="currentColor" />
                      <path d="M41.5964 7.78442C37.9238 7.78442 35.2891 10.6587 35.2891 14.012C35.2891 17.4451 37.844 20.3593 41.6763 20.3593C45.1493 20.3593 47.9438 17.7645 47.9438 14.0918C47.9038 9.94011 44.6304 7.78442 41.5964 7.78442ZM41.6364 10.2994C43.4328 10.2994 45.1493 11.7764 45.1493 14.0918C45.1493 16.4072 43.4727 17.8842 41.6364 17.8842C39.6404 17.8842 38.0835 16.2874 38.0835 14.0519C38.0436 11.8962 39.6004 10.2994 41.6364 10.2994Z" fill="currentColor" />
                      <path d="M55.0475 7.82434C51.6543 7.82434 49.0195 10.7784 49.0195 14.0918C49.0195 17.8443 52.0934 20.3992 54.9676 20.3992C56.764 20.3992 57.6822 19.7205 58.4407 18.8822V20.1198C58.4407 22.2754 57.1233 23.5928 55.1273 23.5928C53.2111 23.5928 52.2531 22.1557 51.8938 21.3573L49.4587 22.3553C50.297 24.1517 52.0135 26.0279 55.0874 26.0279C58.4407 26.0279 60.9956 23.9122 60.9956 19.481V8.18362H58.3608V9.26147C57.6423 8.38322 56.5245 7.82434 55.0475 7.82434ZM55.287 10.2994C56.9237 10.2994 58.6403 11.7365 58.6403 14.1317C58.6403 16.6068 56.9636 17.9241 55.2471 17.9241C53.4507 17.9241 51.774 16.4471 51.774 14.1716C51.8139 11.6966 53.5305 10.2994 55.287 10.2994Z" fill="currentColor" />
                      <path d="M72.8136 7.78442C69.62 7.78442 66.9453 10.2994 66.9453 14.0519C66.9453 18.004 69.9393 20.3593 73.093 20.3593C75.7278 20.3593 77.4044 18.8822 78.3625 17.6048L76.1669 16.1277C75.608 17.006 74.6499 17.8443 73.093 17.8443C71.3365 17.8443 70.5381 16.8862 70.0192 15.9281L78.4423 12.4152L78.0032 11.3772C77.1649 9.46107 75.2886 7.78442 72.8136 7.78442ZM72.8934 10.2196C74.0511 10.2196 74.8495 10.8184 75.2487 11.5768L69.6599 13.9321C69.3405 12.0958 71.097 10.2196 72.8934 10.2196Z" fill="currentColor" />
                      <path d="M62.9531 19.9999H65.7076V1.47693H62.9531V19.9999Z" fill="currentColor" />
                    </svg>
                    <!-- End Star -->
                  </div>
                </div>
                <!-- End Review -->
      
                <!-- Review -->
                <div class="py-5">
                  <div class="flex space-x-1">
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M27.0352 1.6307L33.9181 16.3633C34.2173 16.6768 34.5166 16.9903 34.8158 16.9903L50.0779 19.1845C50.9757 19.1845 51.275 20.4383 50.6764 21.0652L39.604 32.3498C39.3047 32.6632 39.3047 32.9767 39.3047 33.2901L41.998 49.2766C42.2973 50.217 41.1002 50.8439 40.5017 50.5304L26.4367 43.3208C26.1375 43.3208 25.8382 43.3208 25.539 43.3208L11.7732 50.8439C10.8754 51.1573 9.97763 50.5304 10.2769 49.59L12.9702 33.6036C12.9702 33.2901 12.9702 32.9767 12.671 32.6632L1.29923 21.0652C0.700724 20.4383 0.999979 19.4979 1.89775 19.4979L17.1598 17.3037C17.459 17.3037 17.7583 16.9903 18.0575 16.6768L24.9404 1.6307C25.539 0.69032 26.736 0.69032 27.0352 1.6307Z" fill="currentColor" />
                    </svg>
                    <svg class="h-4 w-4 text-gray-800 dark:text-gray-200" width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M49.6867 20.0305C50.2889 19.3946 49.9878 18.1228 49.0846 18.1228L33.7306 15.8972C33.4296 15.8972 33.1285 15.8972 32.8275 15.2613L25.9032 0.317944C25.6021 0 25.3011 0 25 0V42.6046C25 42.6046 25.3011 42.6046 25.6021 42.6046L39.7518 49.9173C40.3539 50.2352 41.5581 49.5994 41.2571 48.6455L38.5476 32.4303C38.5476 32.1124 38.5476 31.7944 38.8486 31.4765L49.6867 20.0305Z" fill="transparent" />
                      <path d="M0.313299 20.0305C-0.288914 19.3946 0.0122427 18.1228 0.915411 18.1228L16.2694 15.8972C16.5704 15.8972 16.8715 15.8972 17.1725 15.2613L24.0968 0.317944C24.3979 0 24.6989 0 25 0V42.6046C25 42.6046 24.6989 42.6046 24.3979 42.6046L10.2482 49.9173C9.64609 50.2352 8.44187 49.5994 8.74292 48.6455L11.4524 32.4303C11.4524 32.1124 11.4524 31.7944 11.1514 31.4765L0.313299 20.0305Z" fill="currentColor" />
                    </svg>
                  </div>
      
                  <p class="mt-3 text-sm text-gray-800 dark:text-gray-200">
                    <span class="font-bold">4.5</span> /5 - from 200 reviews
                  </p>
      
                  <div class="mt-1">
                    <!-- Star -->
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="245" height="56" class="scale-50 -ml-[3.6rem]">
                      <path d="M0 0 C4.95 0 9.9 0 15 0 C15 1.32 15 2.64 15 4 C13.68 4 12.36 4 11 4 C11.33 7.96 11.66 11.92 12 16 C14.97 12.37 17.94 8.74 21 5 C20.34 4.67 19.68 4.34 19 4 C19 2.68 19 1.36 19 0 C23.62 0 28.24 0 33 0 C33 1.32 33 2.64 33 4 C31.35 4 29.7 4 28 4 C27.773125 4.556875 27.54625 5.11375 27.3125 5.6875 C25.64103234 8.63246684 23.44723648 10.68156544 21 13 C22.82722403 16.94243445 25.16071603 20.53657279 27.5 24.1875 C28.10521484 25.14946289 28.10521484 25.14946289 28.72265625 26.13085938 C30.81084725 29.62992797 30.81084725 29.62992797 34 32 C34 32.99 34 33.98 34 35 C30.5522524 35.4820152 27.42801093 35.6887568 24 35 C21.58601828 32.68190073 20.37726509 30.01766618 19 27 C18.1028125 25.576875 18.1028125 25.576875 17.1875 24.125 C16 22 16 22 16 20 C13.87856267 20.8955794 13.87856267 20.8955794 12 23 C11.33825175 25.9858081 11.12794052 28.94861869 11 32 C12.32 32 13.64 32 15 32 C15 32.99 15 33.98 15 35 C9.72 35 4.44 35 -1 35 C-1 34.01 -1 33.02 -1 32 C0.32 32 1.64 32 3 32 C3 22.76 3 13.52 3 4 C2.01 4 1.02 4 0 4 C0 2.68 0 1.36 0 0 Z " fill="#000000" transform="translate(2,7)"/>
                      <path d="M0 0 C2.61420491 0 4.86883616 -0.28465727 7.4375 -0.6875 C10.53607145 -1.04522126 11.65348636 -1.17325682 14.5 0.25 C16.92857386 3.08333617 17.12304767 5.6502786 17.09765625 9.23046875 C17.09443359 10.03291016 17.09121094 10.83535156 17.08789062 11.66210938 C17.07951172 12.49548828 17.07113281 13.32886719 17.0625 14.1875 C17.05798828 15.03248047 17.05347656 15.87746094 17.04882812 16.74804688 C17.03705403 18.83206155 17.0191189 20.91603977 17 23 C17.99 23 18.98 23 20 23 C20 23.99 20 24.98 20 26 C15.71 26 11.42 26 7 26 C7 25.01 7 24.02 7 23 C7.66 23 8.32 23 9 23 C8.67 17.06 8.34 11.12 8 5 C5.69 5.33 3.38 5.66 1 6 C0.67 11.61 0.34 17.22 0 23 C0.99 23 1.98 23 3 23 C3 23.99 3 24.98 3 26 C-1.29 26 -5.58 26 -10 26 C-10 25.01 -10 24.02 -10 23 C-9.34 23 -8.68 23 -8 23 C-8.33 17.06 -8.66 11.12 -9 5 C-9.66 4.67 -10.32 4.34 -11 4 C-11 2.68 -11 1.36 -11 0 C-6.94787741 -0.84811868 -4.01336646 -0.97622427 0 0 Z " fill="#000000" transform="translate(220,16)"/>
                      <path d="M0 0 C2.61420491 0 4.86883616 -0.28465727 7.4375 -0.6875 C10.53607145 -1.04522126 11.65348636 -1.17325682 14.5 0.25 C16.92857386 3.08333617 17.12304767 5.6502786 17.09765625 9.23046875 C17.09443359 10.03291016 17.09121094 10.83535156 17.08789062 11.66210938 C17.07951172 12.49548828 17.07113281 13.32886719 17.0625 14.1875 C17.05798828 15.03248047 17.05347656 15.87746094 17.04882812 16.74804688 C17.03705403 18.83206155 17.0191189 20.91603977 17 23 C17.99 23 18.98 23 20 23 C20 23.99 20 24.98 20 26 C15.71 26 11.42 26 7 26 C7 25.01 7 24.02 7 23 C7.66 23 8.32 23 9 23 C8.67 17.06 8.34 11.12 8 5 C5.69 5.33 3.38 5.66 1 6 C0.67 11.61 0.34 17.22 0 23 C0.99 23 1.98 23 3 23 C3 23.99 3 24.98 3 26 C-1.29 26 -5.58 26 -10 26 C-10 25.01 -10 24.02 -10 23 C-9.34 23 -8.68 23 -8 23 C-8.33 17.06 -8.66 11.12 -9 5 C-9.66 4.67 -10.32 4.34 -11 4 C-11 2.68 -11 1.36 -11 0 C-6.94787741 -0.84811868 -4.01336646 -0.97622427 0 0 Z " fill="#000000" transform="translate(112,16)"/>
                      <path d="M0 0 C3.3 0 6.6 0 10 0 C10.33 6.93 10.66 13.86 11 21 C15.60532389 22.45314664 15.60532389 22.45314664 18 21 C18.33 15.39 18.66 9.78 19 4 C17.68 4 16.36 4 15 4 C15 2.68 15 1.36 15 0 C18.63 0 22.26 0 26 0 C26 7.92 26 15.84 26 24 C26.99 24 27.98 24 29 24 C29 24.99 29 25.98 29 27 C21.375 28.25 21.375 28.25 18 26 C17.46375 26.33 16.9275 26.66 16.375 27 C13.31258861 28.28943638 11.30060561 28.40415579 8 28 C5.08762779 26.25257668 3.34160591 25.16399052 2.3671875 21.84375 C1.9073842 18.28272018 1.89293548 14.76980191 1.9375 11.1875 C1.94201172 10.49462891 1.94652344 9.80175781 1.95117188 9.08789062 C1.96286844 7.39188932 1.98080076 5.69593297 2 4 C1.34 4 0.68 4 0 4 C0 2.68 0 1.36 0 0 Z " fill="#000000" transform="translate(37,15)"/>
                      <path d="M0 0 C2.125 1.625 2.125 1.625 3.125 3.625 C3.20842159 5.07348582 3.23232861 6.52570869 3.22265625 7.9765625 C3.21943359 8.82734375 3.21621094 9.678125 3.21289062 10.5546875 C3.20451172 11.44414062 3.19613281 12.33359375 3.1875 13.25 C3.18298828 14.1471875 3.17847656 15.044375 3.17382812 15.96875 C3.16202591 18.18756648 3.14556155 20.40625018 3.125 22.625 C4.115 22.625 5.105 22.625 6.125 22.625 C6.125 23.615 6.125 24.605 6.125 25.625 C4.68859829 25.82073608 3.25080496 26.00627816 1.8125 26.1875 C1.01199219 26.29191406 0.21148437 26.39632812 -0.61328125 26.50390625 C-2.875 26.625 -2.875 26.625 -5.875 25.625 C-7.174375 25.810625 -8.47375 25.99625 -9.8125 26.1875 C-12.37237538 26.54447345 -13.73407434 26.66579427 -16.25 25.9375 C-18.35215593 24.23960482 -19.09842029 23.23713176 -19.875 20.625 C-19.65681818 14.40681818 -19.65681818 14.40681818 -17 11.75 C-13.78784788 10.04944888 -11.26704358 9.50381896 -7.6875 9.5625 C-5.8003125 9.5934375 -5.8003125 9.5934375 -3.875 9.625 C-4.205 7.975 -4.535 6.325 -4.875 4.625 C-8.835 5.285 -12.795 5.945 -16.875 6.625 C-17.535 5.305 -18.195 3.985 -18.875 2.625 C-12.89180674 -1.19759569 -6.83436662 -3.26861012 0 0 Z M-10.875 14.625 C-11.94772562 17.07039786 -11.94772562 17.07039786 -11.875 19.625 C-11.215 20.285 -10.555 20.945 -9.875 21.625 C-6.77573181 21.30301034 -6.77573181 21.30301034 -3.875 20.625 C-3.875 17.985 -3.875 15.345 -3.875 12.625 C-6.66902354 12.625 -8.41736535 13.30165827 -10.875 14.625 Z " fill="#000000" transform="translate(201.875,16.375)"/>
                      <path d="M0 0 C2.1875 1.6875 2.1875 1.6875 4.1875 4.6875 C4.1875 7.3275 4.1875 9.9675 4.1875 12.6875 C-1.0925 12.6875 -6.3725 12.6875 -11.8125 12.6875 C-10.27937233 17.00358796 -10.27937233 17.00358796 -7.8125 20.6875 C-3.9763778 20.83225933 -0.48942213 20.86411508 3.1875 19.6875 C3.5175 21.0075 3.8475 22.3275 4.1875 23.6875 C-1.60449802 26.52439699 -6.03294778 27.6543622 -12.5 26 C-15.62908007 24.22403563 -16.98369276 22.82259812 -18.8125 19.6875 C-20.41465679 13.25707477 -20.19162916 8.39706307 -16.8125 2.6875 C-12.0470294 -1.78012869 -5.96846084 -2.78528173 0 0 Z M-8.8125 2.6875 C-11.40027208 5.74330974 -11.40027208 5.74330974 -11.8125 9.6875 C-8.8425 9.6875 -5.8725 9.6875 -2.8125 9.6875 C-3.1425 7.7075 -3.4725 5.7275 -3.8125 3.6875 C-5.4625 3.3575 -7.1125 3.0275 -8.8125 2.6875 Z " fill="#000000" transform="translate(152.8125,16.3125)"/>
                      <path d="M0 0 C0 11.88 0 23.76 0 36 C1.32 36 2.64 36 4 36 C4 36.99 4 37.98 4 39 C-0.95 39 -5.9 39 -11 39 C-11 38.01 -11 37.02 -11 36 C-10.01 36 -9.02 36 -8 36 C-8 25.44 -8 14.88 -8 4 C-8.99 4 -9.98 4 -11 4 C-11 3.01 -11 2.02 -11 1 C-7.05979642 -0.26086514 -4.52419701 0 0 0 Z " fill="#000000" transform="translate(79,3)"/>
                      <path d="M0 0 C0.33 0.66 0.66 1.32 1 2 C2.0828125 1.2575 2.0828125 1.2575 3.1875 0.5 C6.14848659 -1.07919285 7.71253029 -1.28178312 11 -1 C11 1.64 11 4.28 11 7 C8.03 7 5.06 7 2 7 C2 12.28 2 17.56 2 23 C3.65 23 5.3 23 7 23 C7 23.99 7 24.98 7 26 C1.72 26 -3.56 26 -9 26 C-9 25.01 -9 24.02 -9 23 C-8.01 23 -7.02 23 -6 23 C-6.33 17.06 -6.66 11.12 -7 5 C-7.66 4.67 -8.32 4.34 -9 4 C-9 2.68 -9 1.36 -9 0 C-3.375 -1.125 -3.375 -1.125 0 0 Z " fill="#000000" transform="translate(170,16)"/>
                      <path d="M0 0 C1 1 1 1 1.11352539 3.22485352 C1.10828857 4.18319092 1.10305176 5.14152832 1.09765625 6.12890625 C1.09443359 7.16337891 1.09121094 8.19785156 1.08789062 9.26367188 C1.07951172 10.35228516 1.07113281 11.44089844 1.0625 12.5625 C1.05798828 13.65498047 1.05347656 14.74746094 1.04882812 15.87304688 C1.03699826 18.58208495 1.02051543 21.29101599 1 24 C1.99 24 2.98 24 4 24 C4 24.99 4 25.98 4 27 C-0.62 27 -5.24 27 -10 27 C-10 26.01 -10 25.02 -10 24 C-9.01 24 -8.02 24 -7 24 C-7 17.73 -7 11.46 -7 5 C-8.32 5 -9.64 5 -11 5 C-11 3.68 -11 2.36 -11 1 C-7.11651516 -0.29449495 -4.09302664 -0.13203312 0 0 Z " fill="#000000" transform="translate(95,15)"/>
                      <path d="M0 0 C3.0625 0.1875 3.0625 0.1875 5.0625 2.1875 C4.50694444 6.74305556 4.50694444 6.74305556 3.0625 8.1875 C0.0625 8.3125 0.0625 8.3125 -2.9375 8.1875 C-3.9375 7.1875 -3.9375 7.1875 -4.0625 4.1875 C-3.89838889 0.24883333 -3.89838889 0.24883333 0 0 Z " fill="#000000" transform="translate(90.9375,2.8125)"/>
                    </svg>
                    <!-- End Star -->
                  </div>
                </div>
                <!-- End Review -->
              </div>
              <!-- End Review -->
            </div>
            <!-- End Col -->
      
            <div class="relative ms-4 mt-20">
              <img class="w-full rounded-md animate-bounceslow" src="{{ url('storage/vecteezy_fried-chicken-with_25066832.png') }}" alt="Image Description">
              <div class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0"></div>
      
              <!-- SVG-->
              <div class="absolute bottom-0 start-0">
                <svg class="w-2/3 ms-auto h-auto text-white dark:text-slate-900" width="630" height="451" viewBox="0 0 630 451" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="531" y="352" width="99" height="99" fill="currentColor" />
                  <rect x="140" y="352" width="106" height="99" fill="currentColor" />
                  <rect x="482" y="402" width="64" height="49" fill="currentColor" />
                  <rect x="433" y="402" width="63" height="49" fill="currentColor" />
                  <rect x="384" y="352" width="49" height="50" fill="currentColor" />
                  <rect x="531" y="328" width="50" height="50" fill="currentColor" />
                  <rect x="99" y="303" width="49" height="58" fill="currentColor" />
                  <rect x="99" y="352" width="49" height="50" fill="currentColor" />
                  <rect x="99" y="392" width="49" height="59" fill="currentColor" />
                  <rect x="44" y="402" width="66" height="49" fill="currentColor" />
                  <rect x="234" y="402" width="62" height="49" fill="currentColor" />
                  <rect x="334" y="303" width="50" height="49" fill="currentColor" />
                  <rect x="581" width="49" height="49" fill="currentColor" />
                  <rect x="581" width="49" height="64" fill="currentColor" />
                  <rect x="482" y="123" width="49" height="49" fill="currentColor" />
                  <rect x="507" y="124" width="49" height="24" fill="currentColor" />
                  <rect x="531" y="49" width="99" height="99" fill="currentColor" />
                </svg>
              </div>
              <!-- End SVG-->
            </div>
            <!-- End Col -->
          </div>
          <!-- End Grid -->
        </div>
      </div>
      {{-- Hero Section End --}}

      {{-- Brand Section Start --}}
      <section class="py-20">
        <div class="max-w-xl mx-auto">
          <div class="text-center ">
            <div class="relative flex flex-col items-center">
              <h1 class="text-4xl font-bold dark:text-gray-200"> Popular<span class="text-red-500"> Brands
                </span> </h1>
              <div class="flex w-40 mt-4 mb-6 overflow-hidden rounded">
                <div class="flex-1 h-2 bg-yellow-200">
                </div>
                <div class="flex-1 h-2 bg-yellow-400">
                </div>
                <div class="flex-1 h-2 bg-yellow-600">
                </div>
              </div>
            </div>
            <p class="mb-12 text-base text-center text-gray-500 mx-4">
              Beberapa Brand unggulan tersedia. <a href="/categories">Selengkapnya...</a>
            </p>
          </div>
        </div>
        <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
          <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 max-lg:grid-cols-2">
      
            @foreach ($brands as $brand)
            <div wire:key="{{ $brand->id }}" class="group bg-white rounded-lg shadow-sm hover:shadow-lg dark:bg-gray-800">
              <a href="/products?selected_brands[0]={{ $brand->id }}" class="">
                <img src="{{ url('storage', $brand->image) }}" alt="{{ $brand->name }}" class="object-cover w-auto h-64 mx-auto rounded-t-lg scale-90">
              </a>
              <div class="px-2 pt-0 pb-3 text-center">
                <a href="" class="tracking-tight text-2xl font-bold group-hover:text-yellow-400  text-gray-900 dark:text-gray-300">
                  {{ $brand->name }}
                </a>
              </div>
            </div>
            @endforeach

            
          </div>
        </div>
      </section>
      {{-- Brand Section End --}}

      {{-- Category Section Start --}}
      <div class="bg-orange-200 py-20">
        <div class="max-w-xl mx-auto">
          <div class="text-center ">
            <div class="relative flex flex-col items-center">
              <h1 class="text-4xl font-bold dark:text-gray-200"> Browse <span class="text-red-500"> Categories
                </span> </h1>
              <div class="flex w-40 mt-4 mb-6 overflow-hidden rounded">
                <div class="flex-1 h-2 bg-yellow-200">
                </div>
                <div class="flex-1 h-2 bg-yellow-400">
                </div>
                <div class="flex-1 h-2 bg-yellow-600">
                </div>
              </div>
            </div>
            <p class="mb-12 text-base text-center text-gray-500 mx-4">
              Pilih kategori yang kamu mau. <a href="/categories" class="text-red-300">Selengkapnya...</a>
            </p>
          </div>
        </div>
      
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
          <div class="grid grid-cols-4 max-lg:grid-cols-3 max-md:grid-cols-2 gap-3 sm:gap-6">
            
            @foreach ($categories as $category)               
            <a wire:key="{{ $category->id }}" class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-lg transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products?selected_categories[0]={{ $category->id }}">
              <div class="p-4 md:p-5">
                <div class="flex justify-between items-center">
                  <div class="flex items-center">
                    <img src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}" class="h-[2.375rem] w-[2.375rem] rounded-full">
                    <div class="ms-3">
                      <h3 class="group-hover:text-yellow-400 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                        {{ $category->name }}
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
      
      </div>
      {{-- Category Section End --}}

      {{-- Customers Review Section Start --}}
      <section class="py-14 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-6 mx-auto lg:py-4 md:px-6">
          <div class="max-w-xl mx-auto">
            <div class="text-center ">
              <div class="relative flex flex-col items-center">
                <h1 class="text-4xl font-bold dark:text-gray-200"> Customer <span class="text-red-500"> Reviews
                  </span> </h1>
                <div class="flex w-40 mt-4 mb-6 overflow-hidden rounded">
                  <div class="flex-1 h-2 bg-yellow-200">
                  </div>
                  <div class="flex-1 h-2 bg-yellow-400">
                  </div>
                  <div class="flex-1 h-2 bg-yellow-600">
                  </div>
                </div>
              </div>
              <p class="mb-12 text-base text-center text-gray-500 mx-4">
                Ayam kriuk dengan rasa khas dan sedikit spicy.
                Apa kata mereka?
              </p>
            </div>
          </div>
      
          <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 ">
            <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
              <div class="flex flex-nowrap items-center justify-between px-6 pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                <div class="flex items-center mb-2 md:mb-0 ">
                  <div class="flex mr-2 rounded-full">
                    <img src="{{ url('storage/portrait-professional-businessman-with-hard-hat.jpg') }}" alt="" class="object-cover w-12 h-12 rounded-full">
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                      Abdullah Umar</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Web Designer</p>
                  </div>
                </div>
                <p class="lg:text-base font-medium text-xs text-gray-600 dark:text-gray-400 text-right"> Joined<br> 10, MAR , 2023
                </p>
              </div>
              <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                Ayam gorengnya juara banget! Renyah di luar, lembut di dalam, bumbunya pas banget.
              </p>
              <div class="flex flex-wrap justify-between px-6 pt-4 border-t dark:border-gray-700">
                <div class="flex md:mb-0">
                  <ul class="flex items-center justify-start mr-3">
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                  </ul>
                  <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating:<span class="font-semibold text-gray-600 dark:text-gray-300">
                      4.3</span>
                  </h2>
                </div>
                <div class="flex items-center space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                  <div class="flex items-center">
                    <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                          <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z">
                          </path>
                        </svg>
                      </a>
                      <span>35</span>
                    </div>
                    <div class="flex text-sm text-gray-700 dark:text-gray-400">
                      <a href="#" class="inline-flex hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat" viewBox="0 0 16 16">
                          <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z">
                          </path>
                        </svg>Reply</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
              <div class="flex flex-nowrap items-center justify-between px-6 pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                <div class="flex items-center mb-2 md:mb-0 ">
                  <div class="flex mr-2 rounded-full">
                    <img src="{{ url('storage/medium-shot-islamic-woman-lifestyle.jpg') }}" alt="" class="object-cover w-12 h-12 rounded-full">
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                      Yasmina Mecca</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Manager</p>
                  </div>
                </div>
                <p class="lg:text-base font-medium text-xs text-gray-600 dark:text-gray-400 text-right"> Joined<br> 19, JAN , 2024
                </p>
              </div>
              <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                Harganya agak mahal, tapi worth it sih karena rasanya enak banget.
                Suasananya nyaman buat nongkrong bareng teman, pelayanannya juga ramah.
              </p>
              <div class="flex flex-wrap justify-between px-6 pt-4 border-t dark:border-gray-700">
                <div class="flex md:mb-0">
                  <ul class="flex items-center justify-start mr-3">
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                  </ul>
                  <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating:<span class="font-semibold text-gray-600 dark:text-gray-300">
                      4.5</span>
                  </h2>
                </div>
                <div class="flex items-center space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                  <div class="flex items-center">
                    <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                      <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                          <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z">
                          </path>
                        </svg></a>
                      <span>50</span>
                    </div>
                    <div class="flex text-sm text-gray-700 dark:text-gray-400">
                      <a href="#" class="inline-flex hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat" viewBox="0 0 16 16">
                          <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z">
                          </path>
                        </svg>Reply</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
              <div class="flex flex-nowrap items-center justify-between px-6 pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                <div class="flex items-center mb-2 md:mb-0 ">
                  <div class="flex mr-2 rounded-full">
                    <img src="{{ url('storage/stylish-young-businessman-driving-car.jpg') }}" alt="" class="object-cover w-12 h-12 rounded-full">
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                      Iskandar</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Marketing Officer</p>
                  </div>
                </div>
                <p class="lg:text-base font-medium text-xs text-gray-600 dark:text-gray-400 text-right"> Joined<br> 30, SEP , 2023
                </p>
              </div>
              <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                Kombinasi menciptakan perpaduan rasa yang sempurna dan membuat hidangan semakin nikmat.
                Kamu bisa temukan disini.
              </p>
              <div class="flex flex-wrap justify-between px-6 pt-4 border-t dark:border-gray-700">
                <div class="flex md:mb-0">
                  <ul class="flex items-center justify-start mr-3">
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                  </ul>
                  <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating:<span class="font-semibold text-gray-600 dark:text-gray-300">
                      4.7</span>
                  </h2>
                </div>
                <div class="flex items-center space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                  <div class="flex items-center">
                    <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                      <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                          <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z">
                          </path>
                        </svg></a>
                      <span>30</span>
                    </div>
                    <div class="flex text-sm text-gray-700 dark:text-gray-400">
                      <a href="#" class="inline-flex hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat" viewBox="0 0 16 16">
                          <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z">
                          </path>
                        </svg>Reply</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
              <div class="flex flex-nowrap items-center justify-between px-6 pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                <div class="flex items-center mb-2 md:mb-0 ">
                  <div class="flex mr-2 rounded-full">
                    <img src="{{ url('storage/muslim-woman-hijab-working-office-room.jpg') }}" alt="" class="object-cover w-12 h-12 rounded-full">
                  </div>
                  <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                      Nusaibah</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Senior Marketing</p>
                  </div>
                </div>
                <p class="lg:text-base font-medium text-xs text-gray-600 dark:text-gray-400 text-right"> Joined<br> 28, FEB , 2024
                </p>
              </div>
              <p class="px-6 mb-6 text-base text-gray-500 dark:text-gray-400">
                Beli makan di sini selalu fresh from the kitchen, harus nunggu di goreng dulu.
                Btw, temen temen yang mau beli disini bisa pesan online dlu ya biar gak nunggu lama.
              </p>
              <div class="flex flex-wrap justify-between px-6 pt-4 border-t dark:border-gray-700">
                <div class="flex md:mb-0">
                  <ul class="flex items-center justify-start mr-3">
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 mr-1 text-yellow-500 dark:text-blue-400 bi bi-star-fill" viewBox="0 0 16 16">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                          </path>
                        </svg>
                      </a>
                    </li>
                  </ul>
                  <h2 class="text-sm text-gray-500 dark:text-gray-400">Rating:<span class="font-semibold text-gray-600 dark:text-gray-300">
                      3.9</span>
                  </h2>
                </div>
                <div class="flex items-center space-x-1 text-sm font-medium text-gray-500 dark:text-gray-400">
                  <div class="flex items-center">
                    <div class="flex mr-3 text-sm text-gray-700 dark:text-gray-400">
                      <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                          <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z">
                          </path>
                        </svg></a>
                      <span>18</span>
                    </div>
                    <div class="flex text-sm text-gray-700 dark:text-gray-400">
                      <a href="#" class="inline-flex hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 mr-1 text-blue-400 bi bi-chat" viewBox="0 0 16 16">
                          <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z">
                          </path>
                        </svg>Reply</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      {{-- Customers Review Section End --}}
      
</div>
