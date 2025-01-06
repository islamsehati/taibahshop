<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Filament\Resources\OrderItemResource\RelationManagers;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Porder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\Model;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;
    protected static ?string $label = 'Stock Histories';
    protected static ?string $navigationGroup = 'Product';
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('porder_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('order_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('adj_item_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('product_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('p_quantity')
                //     ->numeric(),
                // Forms\Components\TextInput::make('p_unit_amount')
                //     ->numeric(),
                // Forms\Components\TextInput::make('p_total_amount')
                //     ->numeric(),
                // Forms\Components\TextInput::make('quantity')
                //     ->numeric(),
                // Forms\Components\TextInput::make('unit_amount')
                //     ->numeric(),
                // Forms\Components\TextInput::make('total_amount')
                //     ->numeric(),
                // Forms\Components\TextInput::make('notes')
                //     ->numeric(),
                // Forms\Components\TextInput::make('stock_before')
                //     ->numeric(),
                // Forms\Components\TextInput::make('stock_after')
                //     ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('porder.status')
                    ->label('Purchase status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'gray',
                        'delivered' => 'success',
                        'canceled' => 'danger'
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'canceled' => 'heroicon-m-x-circle'
                    })
                    ->sortable()
                    ->searchable(isIndividual: true)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('order.status')
                    ->label('Sales status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'canceled'
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'gray',
                        'delivered' => 'success',
                        'canceled' => 'danger'
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'new' => 'heroicon-m-sparkles',
                        'processing' => 'heroicon-m-arrow-path',
                        'shipped' => 'heroicon-m-truck',
                        'delivered' => 'heroicon-m-check-badge',
                        'canceled' => 'heroicon-m-x-circle'
                    })
                    ->sortable()
                    ->searchable(isIndividual: true),

                TextColumn::make('product.alias')
                    ->label('Product')
                    ->sortable()
                    ->searchable(isIndividual: true),

                TextColumn::make('p_quantity')
                    ->label('Qty In')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->label('Total+')),
                TextColumn::make('quantity')
                    ->label('Qty Out')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->label('Total-')),


                TextColumn::make('unit_amount')
                    ->label('Amount In')
                    ->numeric(locale: 'nl')
                    ->sortable()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->prefix('Rp ')->label('Total+')),
                TextColumn::make('total_amount')
                    ->label('T. Amount In')
                    ->numeric(locale: 'nl')
                    ->sortable()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->prefix('Rp ')->label('Total+')),

                TextColumn::make('p_unit_amount')
                    ->label('Amount Out')
                    ->numeric(locale: 'nl')
                    ->sortable()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->prefix('Rp ')->label('Total-')),
                TextColumn::make('p_total_amount')
                    ->label('T. Amount Out')
                    ->numeric(locale: 'nl')
                    ->sortable()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->prefix('Rp ')->label('Total-')),

                TextColumn::make('mutation_type')
                    ->label('mutation')
                    ->sortable()
                    ->searchable(isIndividual: true),
                TextColumn::make('branch.name')
                    ->sortable()
                    ->searchable(isIndividual: true),
                TextColumn::make('notes')
                    ->sortable(),
                // TextColumn::make('stock_before')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('stock_after')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // ->formatStateUsing(fn(Model $record): string => "{$record->porder->id} {$record->order->id}")

                TextColumn::make('order.code_tr')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('porder.code_tr')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('adjItem.code_tr')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('trStkOut.code_tr')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('trStkIn.code_tr')
                    ->sortable()
                    ->searchable(),

            ])->defaultSort('created_at', 'desc')
            ->groups([
                Tables\Grouping\Group::make('created_at')
                    ->label('Date')
                    ->date()
                    ->collapsible(),
                Tables\Grouping\Group::make('order.status')
                    ->label('Status')
                    ->collapsible(),
                Tables\Grouping\Group::make('product.alias')
                    ->label('Product')
                    ->collapsible(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_at_from'),
                        DatePicker::make('created_at_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_at_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_at_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->query(function (OrderItem $query) {
                if (Auth::user()->id != 0) {
                    return $query
                        ->leftJoin('orders', 'order_items.id', '=', 'orders.id')
                        ->leftJoin('porders', 'order_items.id', '=', 'porders.id')
                        ->get()
                        ->where('order.status', '!=', 'canceled')
                        ->where('porder.status', '!=', 'canceled')
                        ->where('branch_id', Auth::user()->branch_id);
                } else {
                    return $query
                        ->leftJoin('orders', 'order_items.id', '=', 'orders.id')
                        ->leftJoin('porders', 'order_items.id', '=', 'porders.id')
                        ->get()
                        ->where('order.status', '!=', 'canceled')
                        ->where('porder.status', '!=', 'canceled');
                };
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderItems::route('/'),
            // 'create' => Pages\CreateOrderItem::route('/create'),
            // 'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
