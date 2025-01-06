<?php

namespace App\Filament\Resources\TrStkOutResource\Pages;

use App\Filament\Resources\TrStkOutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditTrStkOut extends EditRecord
{
    protected static string $resource = TrStkOutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['updated_by'] = auth()->user()->id;
        return $data;
    }
}
