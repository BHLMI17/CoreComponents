<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('product_id')
                ->relationship('product', 'name')
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set, $get) {
                    $product = \App\Models\Product::find($state);
                    if ($product) {
                        $quantity = $get('quantity') ?: 1;
                        $set('price', $product->price * $quantity);
                    }
                }),

            TextInput::make('quantity')
                ->numeric()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set, $get) {
                    $product = \App\Models\Product::find($get('product_id'));
                    if ($product) {
                        $set('price', $product->price * $state);
                    }
                }),

            TextInput::make('price')
                ->numeric()
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Product'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('price')->money('gbp'),
            ])

            ->headerActions([
                CreateAction::make(),
            ])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
