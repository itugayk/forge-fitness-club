<?php

namespace App\Filament\Resources\ClassCategoryResource\Pages;

use App\Filament\Resources\ClassCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassCategories extends ListRecords
{
    protected static string $resource = ClassCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
