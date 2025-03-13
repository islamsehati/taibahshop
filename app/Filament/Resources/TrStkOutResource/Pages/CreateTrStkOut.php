<?php

namespace App\Filament\Resources\TrStkOutResource\Pages;

use App\Filament\Resources\TrStkOutResource;
// use App\Models\OrderItem;
// use App\Models\TrStkIn;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTrStkOut extends CreateRecord
{
    protected static string $resource = TrStkOutResource::class;

    // protected function afterCreate(): void
    // {
    //     $record = $this->record;

    //     $tfIN = new TrStkIn();
    //     $tfIN->branch_id = $record->branch_id;
    //     $tfIN->created_by = $record->created_by;
    //     $tfIN->updated_by = $record->updated_by;
    //     $tfIN->code_tr = $record->code_tr;
    //     $tfIN->from_branch_id = $record->from_branch_id;
    //     $tfIN->to_branch_id = $record->to_branch_id;
    //     $tfIN->date_order = $record->date_order;
    //     $tfIN->user_id = $record->user_id;
    //     $tfIN->currency = $record->currency;
    //     $tfIN->status = $record->status;
    //     $tfIN->notes = $record->notes;
    //     $tfIN->grand_total = $record->grand_total;
    //     $tfIN->created_at = $record->created_at;
    //     $tfIN->updated_at = $record->updated_at;

    //     $ItemFrom = $record->items;
    //     $tfIN->save();

    //     foreach ($ItemFrom as $item) {
    //         $tfIN->items()->saveMany([
    //             new OrderItem([
    //                 'product_id' => $item['product_id'],
    //                 'stock_before' => $item['stock_before'],
    //                 'stock_after' => $item['stock_after'],
    //                 'branch_id' => $item['branch_id'],
    //                 'p_quantity' => $item['quantity'],
    //                 'unit_amount' => $item['p_unit_amount'],
    //                 'total_amount' => $item['p_total_amount'],
    //                 'notes' => $item['notes'],
    //                 'mutation_type' => 'Transfer In',
    //             ]),
    //         ]);
    //     }
    // }
}
