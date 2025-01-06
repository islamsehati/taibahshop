<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JumboTronResource\Pages;
use App\Filament\Resources\JumboTronResource\RelationManagers;
use App\Models\JumboTron;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JumboTronResource extends Resource
{
    protected static ?string $model = JumboTron::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make()
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                // ->readOnly(fn ($record) => !is_null($record)) membuat tidak dapat diedit
                                ->maxLength(255),

                            TextInput::make('target')
                                ->required()
                                ->maxLength(255)
                        ]),

                    TextInput::make('link')
                        ->maxLength(255),

                    FileUpload::make('image')
                        ->image()
                        ->directory('jumbotron'),

                    Toggle::make('is_active')
                        ->required()
                        ->default(true)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListJumboTrons::route('/'),
            'create' => Pages\CreateJumboTron::route('/create'),
            'edit' => Pages\EditJumboTron::route('/{record}/edit'),
        ];
    }
}
