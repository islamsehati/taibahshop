<?php

namespace App\Filament\Resources\TrStkInResource\Pages;

use App\Filament\Resources\TrStkInResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditTrStkIn extends EditRecord
{
    protected static string $resource = TrStkInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['updated_by'] = Auth::user()->id;
        return $data;
    }
}
