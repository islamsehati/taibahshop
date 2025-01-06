@php
    $user = filament()->auth()->user();
    $userid = filament()->auth()->user()->id;
    $email = filament()->auth()->user()->email;
    $branch = filament()->auth()->user()->branch_id;
    $branchname = \App\Models\Branch::where('id', $branch)->value('name');

    $items = filament()->getUserMenuItems();

    $profileItem = $items['profile'] ?? $items['account'] ?? null;
    $profileItemUrl = $profileItem?->getUrl();
    $profilePage = filament()->getProfilePage();
    $hasProfileItem = filament()->hasProfile() || filled($profileItemUrl);

    $logoutItem = $items['logout'] ?? null;

    $items = \Illuminate\Support\Arr::except($items, ['account', 'logout', 'profile']);
@endphp

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_BEFORE) }}

<x-filament::dropdown
    placement="bottom-end"
    teleport
    :attributes="
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->class(['fi-user-menu'])
    "
>
    <x-slot name="trigger">
        <button
            aria-label="{{ __('filament-panels::layout.actions.open_user_menu.label') }}"
            type="button"
            class="shrink-0"
        >
            <x-filament-panels::avatar.user :user="$user" />
        </button>
    </x-slot>

    @if ($profileItem?->isVisible() ?? true)
        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_BEFORE) }}

        @if ($hasProfileItem)
            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item
                    :color="$profileItem?->getColor()"
                    :icon="$profileItem?->getIcon() ?? \Filament\Support\Facades\FilamentIcon::resolve('panels::user-menu.profile-item') ?? 'heroicon-m-user-circle'"
                    :href="$profileItemUrl ?? filament()->getProfileUrl()"
                    :target="($profileItem?->shouldOpenUrlInNewTab() ?? false) ? '_blank' : null"
                    tag="a"
                >
                    {{ $profileItem?->getLabel() ?? ($profilePage ? $profilePage::getLabel() : null) ?? filament()->getUserName($user) }} | {{ $profileItem?->getLabel() ?? $branchname }}
                </x-filament::dropdown.list.item>
            </x-filament::dropdown.list>
        @else
            <x-filament::dropdown.header
                :color="$profileItem?->getColor()"
                :icon="$profileItem?->getIcon() ?? \Filament\Support\Facades\FilamentIcon::resolve('panels::user-menu.profile-item') ?? 'heroicon-m-user-circle'"
            >
                {{ $profileItem?->getLabel() ?? filament()->getUserName($user) }} | {{ $profileItem?->getLabel() ?? $branchname }}
            </x-filament::dropdown.header>
        @endif

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_PROFILE_AFTER) }}
    @endif

    <a href="/admin/users/{{ $userid }}/edit" ><x-filament::dropdown.list class="text-center text-sm scale-75">
        {{ $profileItem?->getLabel() ?? $email }} | {{ $profileItem?->getLabel() ?? $branch }}
    </x-filament::dropdown.list></a>
    
    <a href="/" ><x-filament::dropdown.list class="text-center m-1 hover:bg-yellow-500 hover:rounded-md hover:m-1">
        <button>Go to Shop</button>
    </x-filament::dropdown.list></a>

    <a onclick="toggle_full_screen()"  ><x-filament::dropdown.list class="fullscreen text-center m-1 hover:bg-yellow-500 hover:rounded-md hover:m-1">
        <button>Fullscreen</button>
    </x-filament::dropdown.list></a>

    <script language="JavaScript">
     function toggle_full_screen()
        {
            if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen))
            {
                if (document.documentElement.requestFullScreen){
                    document.documentElement.requestFullScreen();
                }
                else if (document.documentElement.mozRequestFullScreen){ /* Firefox */
                    document.documentElement.mozRequestFullScreen();
                }
                else if (document.documentElement.webkitRequestFullScreen){   /* Chrome, Safari & Opera */
                    document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                }
                else if (document.msRequestFullscreen){ /* IE/Edge */
                    document.documentElement.msRequestFullscreen();
                }
            }
            else
            {
                if (document.cancelFullScreen){
                    document.cancelFullScreen();
                }
                else if (document.mozCancelFullScreen){ /* Firefox */
                    document.mozCancelFullScreen();
                }
                else if (document.webkitCancelFullScreen){   /* Chrome, Safari and Opera */
                    document.webkitCancelFullScreen();
                }
                else if (document.msExitFullscreen){ /* IE/Edge */
                    document.msExitFullscreen();
                }
            }
        }
    </script>


    @if (filament()->hasDarkMode() && (! filament()->hasDarkModeForced()))
        <x-filament::dropdown.list>
            <x-filament-panels::theme-switcher />
        </x-filament::dropdown.list>
    @endif

    <x-filament::dropdown.list>
        @foreach ($items as $key => $item)
            @php
                $itemPostAction = $item->getPostAction();
            @endphp

            <x-filament::dropdown.list.item
                :action="$itemPostAction"
                :color="$item->getColor()"
                :href="$item->getUrl()"
                :icon="$item->getIcon()"
                :method="filled($itemPostAction) ? 'post' : null"
                :tag="filled($itemPostAction) ? 'form' : 'a'"
                :target="$item->shouldOpenUrlInNewTab() ? '_blank' : null"
            >
                {{ $item->getLabel() }}
            </x-filament::dropdown.list.item>
        @endforeach

        <x-filament::dropdown.list.item
            :action="$logoutItem?->getUrl() ?? filament()->getLogoutUrl()"
            :color="$logoutItem?->getColor()"
            :icon="$logoutItem?->getIcon() ?? \Filament\Support\Facades\FilamentIcon::resolve('panels::user-menu.logout-button') ?? 'heroicon-m-arrow-left-on-rectangle'"
            method="post"
            tag="form"
        >
            {{ $logoutItem?->getLabel() ?? __('filament-panels::layout.actions.logout.label') }}
        </x-filament::dropdown.list.item>
    </x-filament::dropdown.list>
</x-filament::dropdown>

{{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::USER_MENU_AFTER) }}
