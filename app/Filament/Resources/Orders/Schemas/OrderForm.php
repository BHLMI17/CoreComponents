<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;


class OrderForm
{
    public static function configure(Form $form): Form
{
    return $form->schema([
        TextInput::make('user_id')->numeric()->required(),
        TextInput::make('total')->numeric()->required(),
        Select::make('status')->options([
            'pending' => 'Pending',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ])->required(),
        TextInput::make('shipping_address')->required(),
        TextInput::make('city')->required(),
        TextInput::make('postcode')->required(),
        TextInput::make('email')->email()->required(),
        TextInput::make('first_name')->required(),
        TextInput::make('last_name')->required(),
        TextInput::make('payment_method')->required(),
    ]);
}

}
