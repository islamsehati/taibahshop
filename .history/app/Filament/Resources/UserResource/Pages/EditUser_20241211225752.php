<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected function mount()
    {
        if (Auth::check()) {
            $this->cart_items = CartManagement::getCartItemsFromCart();
            $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        } else {
            return redirect('/login');
        }
    }

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['updated_oleh'] = auth()->user()->id;
        return $data;
    }
}
