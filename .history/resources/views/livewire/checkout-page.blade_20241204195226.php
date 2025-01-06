<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto mb-10">
	<h1 class="text-center text-2xl font-bold text-gray-800 dark:text-white mb-4">
		Checkout
	</h1>
	<form wire:submit.prevent='placeOrder'>
		<div class="grid grid-cols-12 gap-4">
			
			<div class="md:col-span-12 lg:col-span-4 col-span-12">
				<div class="grid max-lg:grid-cols-2 max-md:grid-cols-1 gap-4">
					<div >
					<div class="bg-white mb-2 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
						<div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
							BRANCH
						</div>
						<div wire:ignore class="gap-4" >
							<div >
								<select wire:model.live='branch_id' data-hs-select='{
									"hasSearch": true,
									"searchPlaceholder": "Search...",
									"searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
									"searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
									"placeholder": "Pilih Cabang",
									"toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
									"toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-[0.65rem] ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
									"dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
									"optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
									"optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 \" data-title></div></div></div>",
									"extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
								}' id="branch_id" class="@error('branch_id') border-red-500 @enderror hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-[0.65rem] ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600">
								{{-- <select wire:model.live='branch_id' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('branch_id') border-red-500 @enderror" id="branch_id" type="text"> --}}
									<option value="">Pilih Cabang</option>
									@foreach ($branches as $branch)
									<option value="{{ $branch->id }}">{{ $branch->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						@error('branch_id')
							<div class="text-red-500 text-sm">{{ $message }}</div>
						@enderror

						<div class="text-xl font-bold underline text-gray-700 dark:text-white mt-4 mb-2">
							BAG SUMMARY
						</div>
						<ul  class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
		
							@foreach ($cart_items as $ci)
							<li wire:key='{{ $ci['product_id'] }}' class="py-3 sm:py-4">
								<div class="flex items-center">
									<div class="flex-shrink-0">
										@if ($ci['image'] != null)
											<img alt="{{ $ci['name'] }}" class="w-12 h-12 rounded-full" src="{{ url('storage', $ci['image'] ) }}">
										@else
											<img alt="{{ $ci['name'] }}" class="w-12 h-12 rounded-full" src="{{ url('storage/food-packaging.png') }}">
										@endif
										</img>
									</div>
									<div class="flex-1 min-w-0 ms-4">
										<p class="text-sm font-medium text-gray-900 truncate dark:text-white">
											{{ $ci['name'] }} {{ $ci['variant'] }}
										</p>
										<p class="text-sm text-gray-500 truncate dark:text-gray-400">
											x{{ $ci['quantity'] }} <span><span style=" margin-left:0.5rem;margin-right:0.2rem;" class="fa fa-map-marker text-green-600"></span>{{ $branches->where('id',$ci['branch_id'])->value('name') }}</span>
										</p>
										@if ($this->branch_id != $ci['branch_id'] && $this->branch_id != null)
										<div><p class="text-sm text-gray-500 dark:text-gray-400">
											<span style="margin-right:0.2rem;" class="fa fa-times-circle text-red-600"> Tidak tersedia di {{ $branches->where('id',$this->branch_id)->value('name') }}</span>
											
										</p></div>										
										@endif
										{{-- @if ($this->branch_id != $ci['branch_id'] && $this->branch_id != null)
										<a href="/cart"><p class="text-sm text-gray-500 dark:text-gray-400">
											<span style="margin-right:0.2rem;" class="fa fa-times-circle text-red-600"> Tidak tersedia di {{ $branches->where('id',$this->branch_id)->value('name') }}, hapus</span>
										</p></a>										
										@endif --}}
										
									</div>
									<div class="block items-center text-base font-semibold text-gray-900 dark:text-white">
										<div>@currency($ci['total_amount'])</div>
										<div class="-mt-5 text-right">@if ($this->branch_id != $ci['branch_id'] && $this->branch_id != null)
											<br><button wire:click.prevent='removeItem({{ $ci['product_id'] }});' wire:click='$refresh'>
												<span wire:loading.remove wire:target='removeItem({{ $ci['product_id'] }});' class="bg-red-400 text-sm text-white py-1 px-1 rounded cursor-pointer">Hapus</span>
												<span wire:loading wire:target='removeItem({{ $ci['product_id'] }});' class="bg-red-100 text-sm text-white py-1 px-1 rounded cursor-pointer">...</span>
												</button>
											@endif</div>
									</div>
								</div>
							</li>
							@endforeach

						</ul>
					</div>
					</div>
				
					<div >
					<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
						<div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
							ORDER SUMMARY
						</div>
						<div class="flex justify-between mb-2 font-bold">
							<span>
								Subtotal
							</span>
							<span>
								@currency($subtotal)
							</span>
						</div>
						<div class="flex justify-between mb-2 font-bold text-gray-400">
							<span>
								Discount*
							</span>
							<span>
								@currency($discount*1000)
							</span>
						</div>
						<div class="flex justify-between mb-2 font-bold text-gray-400">
							<span>
								Shipping Cost*
							</span>
							<span>
								@currency($shipping_amount*1000)
							</span>
						</div>
						<hr class="bg-slate-400 my-4 h-1 rounded">
						<div class="flex justify-between mb-2 font-bold">
							<span>
								Grand Total
							</span>
							<span>
								@currency($grand_total)
							</span>
						</div>
						</hr>
					</div>
					

					<button type='submit' wire:loading.attr="disabled" class="max-lg:hidden bg-green-500 mt-4 w-full p-3 rounded-lg text-xl text-white hover:bg-green-600">
						<span wire:loading.remove>Place Order</span>
						<span wire:loading class="text-green-300">Processing...</span>
					</button>
					<div class="mt-2">*Akan disesuaikan oleh kasir</div>
				</div>
				</div>
			</div>

			<div class="md:col-span-12 lg:col-span-8 col-span-12">
				<!-- Card -->
				<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
					
					<div class="mb-6">
						<div>
							<div class="text-lg font-semibold mt-4 {{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}}">
								Shipment & Other Cost
							</div>
							<div  class="grid sm:grid-cols-2 gap-4 {{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}}">
								<div  wire:ignore>
									<label class="block text-gray-700 dark:text-white mb-1" for="user_id">
										Member
									</label>
									<select wire:model.live='user_id' data-hs-select='{
										"hasSearch": true,
										"searchPlaceholder": "Search...",
										"searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
										"searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
										"placeholder": "Select Member",
										"toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
										"toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-[0.65rem] ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
										"dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
										"optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
										"optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 \" data-title></div></div></div>",
										"extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
									}' id="user_id" class="@error('user_id') border-red-500 @enderror hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-[0.65rem] ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600">
									{{-- <select wire:model.live='user_id' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('user_id') border-red-500 @enderror" id="user_id" type="text"> --}}
										<option value="">Pilih Member</option>
										@foreach ($users as $user)
										<option value="{{ $user->id }}">{{ $user->name }}</option>
										@endforeach
									</select>
								</div> 
        						@error('user_id')
        							<div class="text-red-500 text-sm">{{ $message }}</div>
        						@enderror
								
								<div  wire:ignore>
									<label class="block text-gray-700 dark:text-white mb-1" for="discount">
										Discount
									</label>
									<input wire:model.blur='discount' placeholder="diskon" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('discount') border-red-500 @enderror" id="discount" type="alfanumeric"
									x-mask:dynamic="$money($input, ',', '.')">
									</input>
								</div>
        						@error('discount')
        							<div class="text-red-500 text-sm">{{ $message }}</div>
        						@enderror
								
							</div>
							<div   class="grid sm:grid-cols-2 mt-2 gap-4 {{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}}">
								<div  wire:ignore>
									<label class="block text-gray-700 dark:text-white mb-1" for="shipping_method">
										Courier
									</label>
									<select wire:model='shipping_method' data-hs-select='{
										"hasSearch": true,
										"searchPlaceholder": "Search...",
										"searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 before:absolute before:inset-0 before:z-[1] dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
										"searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
										"placeholder": "Select Courier",
										"toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 \" data-title></span></button>",
										"toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-[0.65rem] ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
										"dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
										"optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
										"optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-2\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 \" data-title></div></div></div>",
										"extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
									}' id="shipping_method" class="@error('shipping_method') border-red-500 @enderror hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-[0.65rem] ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600">
									{{-- <select wire:model.live='shipping_method' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('shipping_method') border-red-500 @enderror" id="shipping_method" type="text"> --}}
										<option value="">Pilih Kurir</option>
										<option value="kurir_taibah">Kurir Taibah</option>
										<option value="grabfood">GrabFood</option>
										<option value="gofood">GoFood</option>
									</select>
								</div>
        						@error('shipping_method')
        							<div class="text-red-500 text-sm">{{ $message }}</div>
        						@enderror
								
								<div  wire:ignore>
									<label class="block text-gray-700 dark:text-white mb-1" for="shipping_amount">
										Shipping Cost
									</label>
									<input wire:model.blur='shipping_amount' placeholder="Ongkir" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('shipping_amount') border-red-500 @enderror" id="shipping_amount" type="alfanumeric"
									x-mask:dynamic="$money($input, ',', '.')">
									</input>
								</div>
        						@error('shipping_amount')
        							<div class="text-red-500 text-sm">{{ $message }}</div>
        						@enderror
							</div>

							<div  class="grid sm:grid-cols-2 mt-2 gap-4 {{ auth()->user()->is_admin == 1 ?'block' : 'hidden'}}">
								<div>
									<label class="block font-bold text-blue-500 dark:text-white mb-1" for="total_payment">
										Bayar
									</label>
									<input wire:model.blur='total_payment' class="text-blue-500 font-bold w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('total_payment') border-red-500 @enderror" id="total_payment" type="alfanumeric"
									x-mask:dynamic="$money($input, ',', '.')">
									</input>
								</div>
        						@error('total_payment')
        							<div class="text-red-500 text-sm">{{ $message }}</div>
        						@enderror
								
								<div class="w-full">
									<label class="block text-gray-700 dark:text-white mb-1" for="total_cashback">
										Kembali
									</label>
									<div class="w-full rounded-lg border py-2 px-6 dark:bg-gray-700 dark:text-white dark:border-none">@currency($total_cashback)</div> 
								</div>
								
							</div>

						</div>
						
						
						
					<div class="text-lg font-semibold mt-4 mb-4">
						Select Payment Method
					</div>
					<ul class="grid w-full gap-6 grid-cols-2 max-md:grid-cols-2"">
						<li>
							<input  wire:model='payment_method' class="hidden peer" id="paymentmtd001" required="" type="radio" value="cash" />
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="paymentmtd001">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										Cash
									</div>
								</div>
								<span style="scale: 2; margin-right:0.5rem;" class="fa fa-money"></span>
							</label>
							</input>
						</li>
						<li>
							<input wire:model='payment_method' class="hidden peer" id="paymentmtd002" type="radio" value="transfer">
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="paymentmtd002">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										Transfer
									</div>
								</div>
								<span style="scale: 2; margin-right:0.5rem;" class="fa fa-credit-card-alt"></span>
							</label>
							</input>
						</li>
						{{-- <li>
							<input wire:model='payment_method' class="hidden peer" id="paymentmtd003" type="radio" value="stripe">
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="paymentmtd003">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										Stripe
									</div>
								</div>
								<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
									</path>
								</svg>
							</label>
							</input>
						</li> --}}
					</ul>
					@error('payment_method')
						<div class="text-red-500 text-sm">{{ $message }}</div>
					@enderror

						<div class="text-lg font-semibold mt-4 mb-2">
							Select Service
						</div>
						<ul class="grid w-full gap-6 grid-cols-3 max-md:grid-cols-2">
							<li>
								<input wire:click="$refresh" wire:model='sales_type' class="hidden peer" id="salestp001" required="" type="radio" value="dine_in" />
								<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="salestp001">
									<div class="block">
										<div class="w-full text-lg font-semibold">
											Dine In
										</div>
									</div>
									<span style="scale: 2; margin-right:0.5rem;" class="fa fa-cutlery"></span>
								</label>
							</li>
							<li>
								<input wire:click="$refresh" wire:model='sales_type' class="hidden peer" id="salestp002" type="radio" value="self_pickup">
								<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="salestp002">
									<div class="block">
										<div class="w-full text-lg font-semibold">
											Self Pickup
										</div>
									</div>
									<span style="scale: 2; margin-right:0.5rem;" class="fa fa-shopping-basket"></span>
								</label>
								</input>
							</li>
							<li>
								<input wire:click="$refresh" wire:model='sales_type' class="hidden peer" id="salestp003" type="radio" value="delivery">
								<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="salestp003">
									<div class="block">
										<div class="w-full text-lg font-semibold">
											Delivery
										</div>
									</div>
									<span style="scale: 2; margin-right:0.5rem;" class="fa fa-truck"></span>
								</label>
								</input>
							</li>
						</ul>
						@error('sales_type')
							<div class="text-red-500 text-sm">{{ $message }}</div>
						@enderror

						

						<!-- Shipping Address -->

						<h2 class="text-xl font-bold underline text-gray-700 dark:text-white mt-4 mb-2">
							Order as...
						</h2>
						<div class="grid sm:grid-cols-2 gap-4">
							<div>
								<label class="block text-gray-700 dark:text-white mb-1" for="first_name">
									First Name
								</label>
								<select wire:model='first_name' placeholder="Sapaan" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('first_name') border-red-500 @enderror" id="first_name" type="text">
									<option value="">Sapaan</option>
									<option value="Pak">Pak</option>
									<option value="Bu">Bu</option>
									<option value="Mas">Mas</option>
									<option value="Mbak">Mbak</option>
								</select> 
								@error('first_name')
									<div class="text-red-500 text-sm">{{ $message }}</div>
								@enderror
							</div>
							<div>
								<label class="block text-gray-700 dark:text-white mb-1" for="last_name">
									Last Name
								</label>
								<input wire:model='last_name' placeholder="nama" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('last_name') border-red-500 @enderror" id="last_name" type="text">
								</input>
								@error('last_name')
									<div class="text-red-500 text-sm">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="grid sm:grid-cols-2 gap-4 mt-4">
							<div>
								<label class="block text-gray-700 dark:text-white mb-1" for="phone">
									Phone
								</label>
								<input wire:model='phone' placeholder="nomor WA" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('phone') border-red-500 @enderror" id="phone" type="text">
								</input>
								@error('phone')
									<div class="text-red-500 text-sm">{{ $message }}</div>
								@enderror
							</div>
						</div>

						@if($sales_type == 'delivery')
						<h2 class="text-xl font-bold underline text-gray-700 dark:text-white mt-4 mb-2">
							Shipping Address
						</h2>
						<div class="grid md:grid-cols-2 gap-4 mt-4">
							<div>
								<label class="block text-gray-700 dark:text-white mb-1" for="state">
									State
								</label>
								<select wire:model.live='state' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('state') border-red-500 @enderror" id="state" type="text">
									<option value="">Pilih dari Provinsi</option>
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
								<select wire:model.live='city' wire:key='{{ $state->code }}' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('city') border-red-500 @enderror" id="city" type="text">
									<option value="">Lalu pilih Kab/Kota</option>
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
								<select wire:model.live='district' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('district') border-red-500 @enderror" id="district" type="text">
									<option value="">Lalu pilih Kecamatan</option>
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
								<select wire:model.live='village' class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('village') border-red-500 @enderror" id="village" type="text">
									<option value="">Lalu pilih Desa</option>
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
						@else
						<span></span>
						@endif
					</div>

				
			
					<div class="text-lg font-semibold mt-4 mb-4">
						Notes
					</div>
					<div class="grid grid-cols gap-4 mt-4">
						<div>
							<textarea wire:model='notes' placeholder='Tambahkan catatan. Misal : "Sudah Transfer no Ref: 587-666-1234" / "masak setengah matang" / "order saya ambil sendiri pukul 14.00" / "Pesanan untuk dine in di Room VIP"' class="w-full h-32 rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('notes') border-red-500 @enderror" id="notes">
							</textarea>
							@error('notes')
								<div class="text-red-500 text-sm">{{ $message }}</div>
							@enderror
							
						</div>
					</div>

				</div>
				<!-- End Card -->
				<button type='submit' wire:loading.attr="disabled" class="lg:hidden mt-4 w-full p-3 rounded-lg text-xl text-white bg-green-500 hover:bg-green-600">
					<span wire:loading.remove>Place Order</span>
					<span wire:loading class="text-green-300">Processing...</span>
				</button>

			</div>


		</div>
	</form>

	<script>
		window.addEventListener('checkout-page', event => {
		   window.location.reload(false); 
		})
	</script>
	
</div>