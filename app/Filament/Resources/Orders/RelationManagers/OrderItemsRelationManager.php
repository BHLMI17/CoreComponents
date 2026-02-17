<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form->schema([
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
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
