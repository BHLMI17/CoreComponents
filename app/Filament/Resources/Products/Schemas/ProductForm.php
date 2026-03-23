<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->required(),

            Textarea::make('description')
                ->columnSpanFull(),

            TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('£'),

            TextInput::make('image_url')
                ->label('Image URL')
                ->placeholder('e.g. /images/my-product.jpg or https://example.com/photo.jpg')
                ->helperText('Paste a direct image URL or a path like /images/filename.jpg')
                ->url()
                ->nullable(),
            
            

            TextInput::make('stock')
                ->required()
                ->numeric()
                ->default(0),

            TextInput::make('compatibility')
                ->required(),

            Select::make('type')
                ->options([
                    'mouse' => 'Mouse',
                    'keyboard' => 'Keyboard',
                    'cpu' => 'CPU',
                    'gpu' => 'GPU',
                    'monitor' => 'Monitor',
                ])
                ->required(),

            TextInput::make('benchmark_score')
                ->numeric()
                ->nullable()
                ->label('Benchmark Score')
                ->visible(fn ($get) => in_array($get('type'), ['cpu', 'gpu'])),
        ]);
    }
}