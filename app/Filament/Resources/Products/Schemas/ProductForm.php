<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
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

                FileUpload::make('image_url')
                ->image()
                ->directory('images')
                ->disk('public_uploads')
                ->visibility('public')
                ->saveUploadedFileUsing(function ($file, $record) {
                    $filename = $file->getClientOriginalName();
            
                    $file->storeAs('images', $filename, 'public_uploads');
            
                    return '/images/' . $filename;
                }),
            
            

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