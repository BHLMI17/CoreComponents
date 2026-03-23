<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('price')
                    ->money()
                    ->sortable(),

                ImageColumn::make('image_url'),

                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('type')
                    ->badge(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('benchmark_score')
                    ->label('Benchmark')
                    ->sortable()
                    ->toggleable()
            ])

            ->filters([])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->bulkActions([]); // No bulk delete available in your install
    }
}
