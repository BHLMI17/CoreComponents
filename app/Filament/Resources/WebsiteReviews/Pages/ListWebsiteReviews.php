<?php

namespace App\Filament\Resources\WebsiteReviews\Pages;

use App\Filament\Resources\WebsiteReviews\WebsiteReviewResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteReviews extends ListRecords
{
    protected static string $resource = WebsiteReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
