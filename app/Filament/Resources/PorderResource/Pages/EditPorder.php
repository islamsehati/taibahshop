<?php

namespace App\Filament\Resources\PorderResource\Pages;

use App\Filament\Resources\PorderResource;
use App\Models\Payment;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class EditPorder extends EditRecord
{
    protected static string $resource = PorderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['updated_by'] = auth()->user()->id;
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($record->is_paid == 1) {
            $data['paid_at'] = Payment::where('porder_id', $record->id)->orderBy('date_payment', 'desc')->value('date_payment');
        } else {
            $data['paid_at'] = null;
        }
        $record->update($data);
        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl;
    }
}
