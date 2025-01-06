<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\RelationManagers\OrdersRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page as PagesPage;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Hamcrest\Type\IsBoolean;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;
use PhpParser\Node\Expr\Cast\Bool_;
use Vermaysha\Wilayah\Models\City;
use Vermaysha\Wilayah\Models\District;
use Vermaysha\Wilayah\Models\Province;
use Vermaysha\Wilayah\Models\Village;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User';
    protected static ?int $navigationSort = 19;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Hidden::make('created_oleh')
                    ->default(fn() => Auth::user()->id) ## keperluan untuk memilih user setelah ada auth
                    // ->disabledOn('edit')
                    ->required(),

                Hidden::make('updated_oleh')
                    ->default(fn() => Auth::user()->id) ## keperluan untuk memilih user setelah ada auth
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->maxlength(255)
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->default(now()),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Created At')
                    ->readOnly(),

                Select::make('branch_id')
                    ->relationship('branch', 'name')
                    ->label('Branch')
                    ->hidden(function () {
                        if (Auth::user()->id == 1 || Auth::user()->id == 2 && Auth::user()->is_admin != 0) {
                            return false;
                        } else {
                            return true;
                        }
                    })
                    ->searchable()
                    ->preload(),

                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name', modifyQueryUsing: fn(Builder $query) => $query->where('name', '!=', 'super_admin'))
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        if ($get('roles') == null) {
                            $set('is_admin', false);
                        } else {
                            $set('is_admin', true);
                        }
                        $set('level', $get('roles'));
                    })
                    // ->disableOptionWhen(fn(string $value): bool => $value == 1)
                    ->hidden(function () {
                        if (Auth::user()->id == 1 || Auth::user()->id == 2 && Auth::user()->is_admin != 0) {
                            return false;
                        } else {
                            return true;
                        }
                    })
                    ->label('Role'),

                Hidden::make('level')
                    ->disabled()
                    ->dehydrated(),

                Toggle::make('is_admin')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->hidden(function () {
                        if (Auth::user()->id == 1 || Auth::user()->id == 2 && Auth::user()->is_admin != 0) {
                            return false;
                        } else {
                            return true;
                        }
                    })
                    ->default(false),

                TextInput::make('phone')
                    ->tel()
                    ->maxLength(20),

                TextInput::make('zip_code')
                    ->numeric()
                    ->maxLength(10),

                Select::make('state')
                    ->options(Province::query()->pluck('name', 'code'))
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('city', null);
                    }),

                Select::make('city')
                    ->options(function (Get $get): SupportCollection {
                        return City::query()->orderBy('name', 'ASC')->where('province_code', $get('state'))->pluck('name', 'code');
                    })
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('district', null);
                    }),

                Select::make('district')
                    ->options(function (Get $get): SupportCollection {
                        return District::query()->orderBy('name', 'ASC')->where('city_code', $get('city'))->pluck('name', 'code');
                    })
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('village', null);
                    }),

                Select::make('village')
                    ->options(function (Get $get): SupportCollection {
                        return Village::query()->orderBy('name', 'ASC')->where('district_code', $get('district'))->pluck('name', 'code');
                    })
                    ->searchable(),

                Textarea::make('street_address')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->modifyQueryUsing(function (Builder $query) {
            //     return $query->addSelect([
            //         'created' => User::query()->select('name')
            //             ->whereColumn('id', 'created_oleh'),
            //         'updated' => User::query()->select('name')
            //             ->whereColumn('id', 'updated_oleh'),
            //     ]);
            // })
            ->columns([
                ToggleColumn::make('is_admin')
                    ->hidden(function () {
                        if (Auth::user()->email == 'mangunwirayuda@gmail.com') {
                            return false;
                        } else {
                            return true;
                        }
                    })
                    ->label('Admin?')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->iconColor('primary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_oleh')
                    ->label('Created by')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_oleh')
                    ->label('Updated by')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make(name: 'Admin?')
                        ->requiresConfirmation()
                        ->color('info')
                        ->icon('heroicon-o-shield-check')
                        ->action(function (Collection $records, array $data): void {
                            foreach ($records as $record) {
                                $record->is_admin = $data['is_admin'];
                                $record->save();
                            }
                        })
                        ->form([
                            Toggle::make('is_admin')
                                ->label('Admin?')
                                ->required(),
                        ]),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->query(function (User $query) {
                if (Auth::user()->id == 1 || Auth::user()->id == 2) {
                    return $query->where('email', '!=', 'mangunwirayuda@gmail.com')->where('id', '!=', 1);
                } else {
                    return $query->where('email', '!=', 'mangunwirayuda@gmail.com')->where('is_admin', 0);
                }
            });
    }

    public static function getRelations(): array
    {
        return [
            OrdersRelationManager::class
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
