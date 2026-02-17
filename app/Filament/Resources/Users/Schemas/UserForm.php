<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Form;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required(),

            TextInput::make('email')
                ->label('Email address')
                ->email()
                ->required(),

            DateTimePicker::make('email_verified_at'),

            TextInput::make('password')
                ->password()
                ->required(),

            TextInput::make('role')
                ->required()
                ->default('user'),
        ]);
    }
}
