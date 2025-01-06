<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Models\Address;
use App\Models\Branch;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Filament\Actions\Action as ActionsAction;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Actions;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Vermaysha\Wilayah\Models\District;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isTrue;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $label = 'Sale Order';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';


    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([

                        Hidden::make('branch_id')
                            ->default(fn() => Auth::user()->branch_id)
                            ->required(),

                        Hidden::make('created_by')
                            ->default(fn() => Auth::user()->id) ## keperluan untuk memilih user setelah ada auth
                            // ->disabledOn('edit')
                            ->required(),

                        Hidden::make('updated_by')
                            ->default(fn() => Auth::user()->id) ## keperluan untuk memilih user setelah ada auth
                            ->required(),

                        TextInput::make('code_tr')
                            ->label('No. Transsaction')
                            ->default('ORD' . date('YmdHis') . '-' . Auth::user()->id) ## Jika ingin menggunakan OrderID otomatis
                            ->readOnly()
                            ->columnSpan(6),

                        DateTimePicker::make('date_order')
                            ->default(now())
                            ->required()
                            ->columnSpan(6),

                        Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpan(4),

                        ToggleButtons::make('sales_type')
                            ->required()
                            ->grouped()
                            ->options([
                                'dine_in' => 'Dine In',
                                'self_pickup' => 'Self Pickup',
                                'delivery' => 'Delivery'
                            ])
                            ->live()
                            ->columnSpan(4),

                        Select::make('shipping_method')
                            ->options([
                                'kurir_taibah' => 'Kurir Taibah',
                                'grabfood' => 'GrabFood',
                                'gofood' => 'GoFood'
                            ])
                            ->required(function (Get $get) {
                                if ($get('sales_type') == 'delivery') {
                                    return true;
                                } else {
                                    return false;
                                }
                            })
                            ->columnSpan(4),

                        ToggleButtons::make('status')
                            ->inline()
                            ->default('new')
                            ->required()
                            // ->columnSpanFull()
                            ->columnSpan(12)
                            ->options([
                                'new' => 'New',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'canceled' => 'Canceled'
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'gray',
                                'delivered' => 'success',
                                'canceled' => 'danger'
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-badge',
                                'canceled' => 'heroicon-m-x-circle'
                            ]),

                        Textarea::make('notes')
                            ->autosize()
                            ->columnSpan(12)
                    ])->columns(['sm' => 12, 'md' => 12, 'lg' => 12, 'xl' => 12]),

                    Section::make('Order Items')->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->reorderable()
                            ->schema([

                                Select::make('product_id')
                                    ->relationship(
                                        name: 'product',
                                        modifyQueryUsing: fn(Builder $query) => $query->orderBy('name')->orderBy('variant')->where('is_active', 1)->where('branch_id', Auth::user()->branch_id),
                                    )
                                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name} {$record->variant} Rp" . Number::format($record->price, locale: 'de'))
                                    ->searchable(['name', 'variant'])
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', Product::find($state)?->price * $get('quantity') ?? 0))
                                    ->columnSpan(['sm' => 4, 'md' => 4, 'lg' => 4, 'xl' => 4]),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->required()
                                    // ->maxValue(function (Get $get) {
                                    //     $boughtqty = OrderItem::query()->where('product_id', $get('product_id'))->sum('p_quantity');
                                    //     $soldqty = OrderItem::query()->where('product_id', $get('product_id'))->sum('quantity');
                                    //     return $boughtqty - $soldqty;
                                    // }) #ini untuk membatasi quantity sesuai stok yang ada
                                    ->minValue(1)
                                    ->live(onBlur: true) ## ini untuk klik di luar field lalu ada perubahan
                                    // ->live(debounce: 2000) ## ini untuk delay 2000 milidetik lalu ada perubahan
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('unit_amount')))
                                    ->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2]),

                                TextInput::make('unit_amount')
                                    ->label('Amount')
                                    ->required()
                                    ->dehydrated()
                                    ->numeric()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('quantity')))
                                    ->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2]),

                                TextInput::make('total_amount')
                                    ->label('Total')
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->numeric()
                                    ->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2]),

                                Select::make('branch_id')
                                    ->default(fn() => Auth::user()->branch_id)
                                    ->relationship(
                                        name: 'branch',
                                        modifyQueryUsing: fn(Builder $query) => $query->orderBy('name')->where('is_active', 1),
                                    )
                                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name}")
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2]),

                                Hidden::make('mutation_type')
                                    ->default('Sales'),

                            ])
                            ->columns(['sm' => 12, 'md' => 12, 'lg' => 12, 'xl' => 12])
                            ->extraItemActions([
                                Action::make('openProduct')
                                    ->tooltip('Open product')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(function (array $arguments, Repeater $component): ?string {
                                        $itemData = $component->getRawItemState($arguments['item']);

                                        $product = Product::find($itemData['product_id']);

                                        if (! $product) {
                                            return null;
                                        }

                                        return ProductResource::getUrl('edit', ['record' => $product]);
                                    }, shouldOpenInNewTab: true)
                                    ->hidden(fn(array $arguments, Repeater $component): bool => blank($component->getRawItemState($arguments['item'])['product_id'])),
                            ]),

                        Group::make()->schema([

                            TextInput::make(name: 'discount')
                                ->default(0)
                                ->required()
                                ->numeric()
                                ->live(onBlur: true),
                            TextInput::make(name: 'shipping_amount')
                                ->default(0)
                                ->required()
                                ->numeric()
                                ->live(onBlur: true),

                            Placeholder::make('grand_total_placeholder')
                                ->label('Grand Total')
                                ->content(function (Get $get, Set $set) {

                                    $total = 0;
                                    if (!$repeaters = $get('items')) {
                                        return $total;
                                    }
                                    foreach ($repeaters as $key => $repeater) {
                                        $total += $get("items.{$key}.total_amount");
                                    }

                                    $discount = $get('discount');
                                    if ($discount != null) {
                                        $discount = $get('discount');
                                    } else {
                                        $discount = 0;
                                    }
                                    $shipping_amount = $get('shipping_amount');
                                    if ($shipping_amount != null) {
                                        $shipping_amount = $get('shipping_amount');
                                    } else {
                                        $shipping_amount = 0;
                                    }
                                    $bytambahan = $shipping_amount - $discount;
                                    $grandTotal = $total + $bytambahan;
                                    $set('grand_total', $grandTotal);
                                    return Number::currency($grandTotal, 'IDR');
                                }),

                            Hidden::make('grand_total')
                                ->default(0)

                        ])->columns(['sm' => 3, 'md' => 3, 'lg' => 3, 'xl' => 3])
                    ]),
                    Section::make('Payments')->schema([
                        Repeater::make('payments')
                            ->relationship()
                            ->reorderable()
                            ->schema([

                                Hidden::make('created_by')
                                    ->default(fn() => Auth::user()->id)
                                    ->required(),

                                Hidden::make('updated_by')
                                    ->default(fn() => Auth::user()->id)
                                    ->formatStateUsing(fn(string $state): string => Auth::user()->id)
                                    ->required(),

                                Hidden::make('mutation_type')
                                    ->default('Sales'),

                                DateTimePicker::make('date_payment')
                                    ->default(now())
                                    ->required()
                                    ->columnSpan(['sm' => 4, 'md' => 4, 'lg' => 4, 'xl' => 4]),

                                Select::make('currency')
                                    ->default('idr')
                                    ->required()
                                    ->options([
                                        'idr' => 'IDR',
                                        'usd' => 'USD',
                                        'eur' => 'EUR'
                                    ])
                                    ->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2]),

                                ToggleButtons::make('payment_method')
                                    ->options([
                                        'cash' => 'Cash',
                                        'transfer' => 'Transfer',
                                    ])
                                    ->required()
                                    ->grouped()
                                    ->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2]),

                                TextInput::make('nominal_plus')
                                    ->label('Nominal')
                                    ->required()
                                    ->numeric()
                                    ->live(onBlur: true)
                                    ->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2]),

                                Select::make('branch_id')
                                    ->default(fn() => Auth::user()->branch_id)
                                    ->relationship(
                                        name: 'branch',
                                        modifyQueryUsing: fn(Builder $query) => $query->orderBy('name')->where('is_active', 1),
                                    )
                                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->name}")
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(['sm' => 2, 'md' => 2, 'lg' => 2, 'xl' => 2]),

                            ])
                            ->columns(['sm' => 12, 'md' => 12, 'lg' => 12, 'xl' => 12]),

                        Group::make()->schema([

                            Placeholder::make('total_cashback_placeholder')
                                ->label('Total Cashback')
                                ->content(function (Get $get, Set $set) {

                                    $subtotal_payment = 0;
                                    if (!$repeaters = $get('payments')) {
                                        return $subtotal_payment;
                                    }
                                    foreach ($repeaters as $key => $repeater) {
                                        $subtotal_payment += $get("payments.{$key}.nominal_plus");
                                    }

                                    $grand_total = $get('grand_total');
                                    if ($grand_total != null) {
                                        $grand_total = $get('grand_total');
                                    } else {
                                        $grand_total = 0;
                                    }

                                    $total_cashback = $subtotal_payment - $grand_total;
                                    if ($total_cashback >= 0) {
                                        $set('is_paid', true);
                                    } else {
                                        $set('is_paid', false);
                                    }
                                    $set('total_cashback', $total_cashback);
                                    return Number::currency($total_cashback, 'IDR');
                                }),

                            Placeholder::make('total_payment_placeholder')
                                ->label('Total Payment')
                                ->content(function (Get $get, Set $set) {

                                    $subtotal_payment = 0;
                                    if (!$repeaters = $get('payments')) {
                                        return $subtotal_payment;
                                    }
                                    foreach ($repeaters as $key => $repeater) {
                                        $subtotal_payment += $get("payments.{$key}.nominal_plus");
                                    }

                                    $grand_total = $get('grand_total');
                                    if ($grand_total != null) {
                                        $grand_total = $get('grand_total');
                                    } else {
                                        $grand_total = 0;
                                    }

                                    $set('total_payment', $subtotal_payment);
                                    return Number::currency($subtotal_payment, 'IDR');
                                }),

                            Toggle::make('is_paid')
                                ->required()
                                ->label('Paid?')
                                ->disabled()
                                ->dehydrated(),

                            Hidden::make('total_cashback')
                                ->default(0),

                            Hidden::make('total_payment')
                                ->default(0)

                        ])->columns(['sm' => 3, 'md' => 3, 'lg' => 3, 'xl' => 3])
                    ])
                ])->columnSpanFull()
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

                IconColumn::make('is_paid')
                    ->label('Paid')
                    ->boolean()
                    ->trueColor('info')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark')
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),
                // ->searchable(isIndividual:true),

                TextColumn::make('grand_total')
                    ->numeric(locale: 'nl')->prefix('Rp ')
                    ->sortable()
                    ->alignRight()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->prefix('Rp ')->label('Total')),
                TextColumn::make('total_payment')
                    ->numeric(locale: 'nl')->prefix('Rp ')
                    ->sortable()
                    ->alignRight()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->prefix('Rp ')->label('Total')),
                TextColumn::make('total_cashback')
                    ->numeric(locale: 'nl')->prefix('Rp ')
                    ->sortable()
                    ->alignRight()
                    ->summarize(Sum::make()->numeric(locale: 'nl')->prefix('Rp ')->label('Total')),

                SelectColumn::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Canceled'
                    ])
                    ->searchable()
                    ->sortable()
                    ->selectablePlaceholder(false),

                TextColumn::make('shipping_method')
                    ->searchable()
                    ->sortable(),

                // TextColumn::make('address.fullname')
                //     ->label('for')
                //     ->sortable(),
                TextColumn::make('address.first_name')
                    ->label('FName')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address.last_name')
                    ->label('LName')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address.phone')
                    ->label('phone')
                    ->copyable()
                    ->copyMessage('Number phone copied')
                    ->copyMessageDuration(1500)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code_tr')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('date_order')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created')
                    ->label('Created by')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated')
                    ->label('Updated by')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('date_order', 'desc')

            ->filters([

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('date_order_from'),
                        DatePicker::make('date_order_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_order_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date_order', '>=', $date),
                            )
                            ->when(
                                $data['date_order_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('date_order', '<=', $date),
                            );
                    }),

                Filter::make('is_paid')
                    ->label('Paid')
                    ->query(fn(Builder $query): Builder => $query->where('is_paid', true)),

                Filter::make('Unpaid')
                    ->label('Unpaid')
                    ->query(fn(Builder $query): Builder => $query->where('is_paid', false)->where('status', '!=', 'canceled')),
            ])

            ->actions([
                ActionGroup::make([
                    Actions\ButtonAction::make('print')
                        ->url(fn(Order $record) => route('printid', $record))
                        ->openUrlInNewTab()
                        ->icon('heroicon-o-printer'),
                    Actions\ButtonAction::make('phone')
                        ->openUrlInNewTab()
                        // ->hidden(fn(Order $record): bool => ! $record->exists())
                        ->url(function (Order $record) {
                            if (!$record->exists()) {
                                return url("https://wa.me/+62{$record->address->phone}");
                            }
                        })
                        ->icon('heroicon-o-phone'),
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    // Tables\Actions\BulkAction::make(name: 'Paid?')
                    //     ->requiresConfirmation()
                    //     ->color('info')
                    //     ->icon('heroicon-o-credit-card')
                    //     ->action(function (Collection $records, array $data): void {
                    //         foreach ($records as $record) {
                    //             $record->is_paid = $data['is_paid'];
                    //             $record->save();
                    //         }
                    //     })
                    //     ->form([
                    //         Toggle::make('is_paid')
                    //             ->label('Paid ?')
                    //             ->required(),
                    //     ]),

                    Tables\Actions\BulkAction::make(name: 'Status')
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->color('warning')
                        ->icon('heroicon-o-flag')
                        ->action(function (Collection $records, array $data): void {
                            foreach ($records as $record) {
                                $record->status = $data['status'];
                                $record->save();
                            }
                        })
                        ->form([
                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'new' => 'New',
                                    'processing' => 'Processing',
                                    'shipped' => 'Shipped',
                                    'delivered' => 'Delivered',
                                    'canceled' => 'Canceled'
                                ])
                                ->required(),
                        ]),

                    Tables\Actions\DeleteBulkAction::make(),

                ]),
            ])
            ->groups([
                Tables\Grouping\Group::make('date_order')
                    ->label('Order Date')
                    ->date()
                    ->collapsible(),
                Tables\Grouping\Group::make('user.name')
                    ->label('Customer')
                    ->collapsible(),
            ])
            ->selectCurrentPageOnly()
            ->recordUrl(fn(Model $record): string => OrderResource::getUrl('edit', ['record' => $record]))
            ->query(function (Order $query) {
                if (Auth::user()->id != 1) {
                    return $query->where('branch_id', Auth::user()->branch_id);
                } else {
                    return $query;
                };
            });
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        // return static::getModel()::count(); ## jika ingin hitung semua
        if (Auth::user()->id != 1) {
            return static::getModel()::query()->where('branch_id', Auth::user()->branch_id)->where('is_paid', 0)->count();
        } else {
            return static::getModel()::query()->where('is_paid', 0)->count();
        };
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'danger' : 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
