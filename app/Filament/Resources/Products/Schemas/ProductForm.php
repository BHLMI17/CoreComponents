<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ProductForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required(),

            Textarea::make('description')
                ->columnSpanFull(),

            TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('£'),

            FileUpload::make('image_url')
                ->image(),

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
        ]);
    }
}
