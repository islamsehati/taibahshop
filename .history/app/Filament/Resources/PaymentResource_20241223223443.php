<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('porder_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('order_id')
                //     ->numeric(),
                // Forms\Components\Textarea::make('mutation_type')
                //     ->columnSpanFull(),
                // Forms\Components\DateTimePicker::make('date_payment'),
                // Forms\Components\TextInput::make('currency')
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('payment_method')
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('nominal_plus')
                //     ->numeric(),
                // Forms\Components\TextInput::make('nominal_mins')
                //     ->numeric(),
                // Forms\Components\TextInput::make('created_by')
                //     ->numeric(),
                // Forms\Components\TextInput::make('updated_by')
                //     ->numeric(),
                // Forms\Components\TextInput::make('branch_id')
                //     ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                return $query->addSelect([
                    'created' => User::query()->select('name')
                        ->whereColumn('id', 'created_by'),
                    'updated' => User::query()->select('name')
                        ->whereColumn('id', 'updated_by'),
                ]);
            })
            ->columns([
                Tables\Columns\TextColumn::make('porder.code_tr')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('order.code_tr')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_payment')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal_plus')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal_mins')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('branch.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('date_payment', 'desc')
            ->groups([
                Tables\Grouping\Group::make('date_payment')
                    ->label('Date')
                    ->date()
                    ->collapsible(),
                Tables\Grouping\Group::make('payment_method')
                    ->label('Method')
                    ->collapsible(),
            ])
            ->filters([
                Filter::make('date_payment')
                    ->form([
                        DatePicker::make('date_payment_from'),
                        DatePicker::make('date_payment_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_payment_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date_payment', '>=', $date),
                            )
                            ->when(
                                $data['date_payment_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date_payment', '<=', $date),
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
            ]);
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
            'index' => Pages\ListPayments::route('/'),
            // 'create' => Pages\CreatePayment::route('/create'),
            // 'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
