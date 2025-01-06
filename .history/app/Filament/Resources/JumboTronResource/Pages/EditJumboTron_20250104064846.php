<?php

namespace App\Filament\Resources\JumboTronResource\Pages;

use App\Filament\Resources\JumboTronResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJumboTron extends EditRecord
{
    protected static string $resource = JumboTronResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
