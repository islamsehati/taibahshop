<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {

        return $this->previousUrl;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['updated_oleh'] = auth()->user()->id;
        return $data;
    }
}
