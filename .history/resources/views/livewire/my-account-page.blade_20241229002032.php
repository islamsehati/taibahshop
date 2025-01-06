<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex h-full items-center">
      {{-- <main class="w-full max-w-xl mx-auto p-6"> --}}
      <main class="w-full mx-auto p-6">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
          <div class="p-4 sm:p-7">
            <div class="text-center">
              <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">My Account</h1>
              <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Jika ingin ubah alamat mulai ubah dari Provinsi
                {{-- <a wire:navigate class="text-red-500 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/">
                  Batal
                </a> --}}
              </p>
            </div>
            <hr class="my-5 border-slate-300">
            <!-- Form -->
            <form wire:submit.prevent='updateMyAccount'>
            
              <div class="grid lg:grid-cols-2 gap-y-4 gap-x-4">
                <div>
                <!-- Form Group -->

                <div class="mt-4 text-center mx-auto">
                @if ($photo) 
                    <img src="{{ $photo->temporaryUrl() }}" alt="avatar" class="text-center mx-auto size-[62px] rounded-full">
                @endif
            
                <input type="file" wire:model="photo">
            
                @error('photo') <span class="error">{{ $message }}</span> @enderror
                </div>
  
                <div class="mt-4">
                  <label for="name" class="block text-sm mb-2 dark:text-white">Name</label>
                  <div class="relative">
                    <input type="text" id="name" wire:model="name" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" aria-describedby="name-error">
                    @error('name')
                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                      <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                      </svg>
                    </div>
                    @enderror
                  </div>
                  @error('name') 
                  <p class="text-xs text-red-600 mt-2" id="name-error">{{ $message }}</p>
                  @enderror
                </div>

                <div class="mt-4">
                  <label for="phone" class="block text-sm mb-2 dark:text-white">Phone</label>
                  <div class="relative">
                    <input type="text" id="phone" wire:model="phone" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" aria-describedby="phone-error">
                    @error('phone')
                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                      <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                      </svg>
                    </div>
                    @enderror
                  </div>
                  @error('phone') 
                  <p class="text-xs text-red-600 mt-2" id="phone-error">{{ $message }}</p>
                  @enderror
                </div>
  
                <div class="mt-4">
                  <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                  <div class="relative">
                    <input type="email" id="email" wire:model="email" class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" aria-describedby="email-error">
                    @error('email')
                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                      <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                      </svg>
                    </div>
                    @enderror
                  </div>
                  @error('email') 
                  <p class="text-xs text-red-600 mt-2" id="email-error">{{ $message }}</p>
                  @enderror
                </div>
                <!-- End Form Group -->
  
                <!-- Form Group -->
                <div class="mt-4">
                  <div class="flex justify-between items-center">
                    <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
  
                  </div>
                  <div class="relative">
                    <input type="password" id="password" wire:model="password" class="py-3 border px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" aria-describedby="password-error">
                    @error('password')
                    <div class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                      <svg class="h-5 w-5 text-red-500" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                      </svg>
                    </div>
                    @enderror
                  </div>
                  @error('password') 
                  <p class="text-xs text-red-600 mt-2" id="password-error">{{ $message }}</p>
                  @enderror
                </div>
                <!-- End Form Group -->
              </div>

                <div >
                  <div class="grid md:grid-cols-2 gap-4 mt-4">
                    <div>
                      <label class="block text-gray-700 dark:text-white mb-1" for="state">
                        State
                       </label>
                      <select wire:change='changeState()' wire:model.live='state' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('state') border-red-500 @enderror" id="state" type="text"
                      >
                        <option value="{{ $users->where('id', auth()->user()->id)->value('state') }}">{{ $states->where('code', $users->where('id', auth()->user()->id)->value('state'))->value('name') }}</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->code }}">{{ $state->name }}</option>
                        @endforeach
                      </select>
                      @error('state')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div>
                      <label class="block text-gray-700 dark:text-white mb-1" for="city">
                        City
                        </label>
                      <select wire:change='changeCity()' wire:model.live='city' wire:key='{{ $state->code }}' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('city') border-red-500 @enderror" id="city" type="text"
                        >
                        <option value="{{ $users->where('id', auth()->user()->id)->value('city') }}">{{ $kab->where('code', $users->where('id', auth()->user()->id)->value('city'))->value('name') }}</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->code }}">{{ $city->name }}</option>
                        @endforeach
                      </select>
                      @error('city')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="grid md:grid-cols-3 gap-4 mt-4">
                    <div>
                      <label class="block text-gray-700 dark:text-white mb-1" for="district">
                        District
                      </label>
                      <select wire:change='changeDistrict()' wire:model.live='district' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('district') border-red-500 @enderror" id="district" type="text"
                      >
                        <option value="{{ $users->where('id', auth()->user()->id)->value('district') }}">{{ $kec->where('code', $users->where('id', auth()->user()->id)->value('district'))->value('name') }}</option>
                        @foreach ($districts as $district)
                        <option value="{{ $district->code }}">{{ $district->name }}</option>
                        @endforeach
                      </select>
                      @error('district')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div>
                      <label class="block text-gray-700 dark:text-white mb-1" for="village">
                        Village
                      </label>
                      <select wire:model.live='village' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('village') border-red-500 @enderror" id="village" type="text" 
                      >
                        <option value="{{ $users->where('id', auth()->user()->id)->value('village') }}">{{ $desa->where('code', $users->where('id', auth()->user()->id)->value('village'))->value('name') }}</option>
                        @foreach ($villages as $village)
                        <option value="{{ $village->code }}">{{ $village->name }}</option>
                        @endforeach
                      </select>
                      @error('village')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div>
                      <label class="block text-gray-700 dark:text-white mb-1" for="zip">
                        ZIP Code
                      </label>
                      <input wire:model='zip_code' placeholder="kode pos" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('zip_code') border-red-500 @enderror" id="zip" type="text">
                      </input>
                      @error('zip_code')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="mt-4">
                    <label class="block text-gray-700 dark:text-white mb-1" for="address">
                      Detail Address
                    </label>
                    <input wire:model='street_address'  placeholder="Gang, Jalan, RT, RW, Patokan" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('street_address') border-red-500 @enderror" id="address" type="text">
                    </input>
                    @error('street_address')
                      <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror 
                  </div>
                  <button wire:loading.attr="disabled" type="submit" class="w-full mt-7 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-red-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    <span wire:loading.remove>Update Data</span>
					          <span wire:loading class="text-gray-300">Please wait...</span>
                  </button>
                  <a href="/" class="w-full mt-3 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-400 text-white hover:bg-red-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    Batal
                  </a>
                </div>
  
  
              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
    </div>

  </div>