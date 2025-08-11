<div class="w-full max-w-[85rem] pt-7 pb-10 px-4 sm:px-6 lg:px-8 mx-auto">

	<h1 class="text-center text-2xl font-bold text-gray-800 dark:text-white mb-4">
		CABANG
	</h1>

  <div class="flex items-center justify-between">
    <div class="text-lg font-semibold dark:text-white">Branches</div>
    <label class="relative block text-center">
      <span class="sr-only">Search</span>
      <span class="text-red-400 absolute inset-y-0 right-0 flex items-center pl-2">
        <i class="fa fa-search" aria-hidden="true"></i>
      </span>
      <input wire:model.live="cariBranch" class="placeholder:italic placeholder:text-red-400 block bg-transparent w-full pl-0 pr-0 shadow-sm focus:outline-none focus:border-transparent focus:ring-transparent focus:ring-1 sm:text-sm" type="text" name="search"/>
    </label>
  </div>

  <div class="mt-3 grid grid-cols-3 max-lg:grid-cols-2 max-md:grid-cols-1 gap-4 sm:gap-6">
    @foreach ($branches->where('name', 'LIKE', '%' . $cariBranch . '%')->get() as $branch)
    <a 
    wire:click.prevent='changeBranch({{ $branch->id }})' 
    wire:key="{{ $branch->id }}" class="cursor-pointer group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
      <div class="p-4 md:p-5">
        <div class="flex justify-between items-center">
          <div class="flex items-center">
            @if ($branch->image != null)
            <img class="h-[5rem] w-[5rem] object-contain" src="{{ Str::replace('%2F', '/',url('storage', $branch->image)) }}" alt="{{ $branch->name }}">
            @else
            <img class="h-[5rem] w-[5rem] object-contain" src="{{ url('storage/kios.png') }}" alt="{{ $branch->name }}">
            @endif
            <div class="ms-3">
              <h3 class="group-hover:text-yellow-400 text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                <div class="flex justify-between">
                  <div class="flex text-2xl font-semibold">{{ $branch->name }} </div>
                </div>
                <div>{{ $branch->street_address }}</div>
                <div>{{ $branch->phone }}</div>
              </h3>
            </div>
          </div>
          <div class="text-end">
            @php
                $open = ($branch->is_open == 1) ? '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">BUKA</span>' : '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">TUTUP</span>';
            @endphp
            <div class="text-base font-sm">{!! $open !!}</div>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>

  </div>
  