<?php

namespace App\Filament\Resources\ClassCategoryResource\Pages;

use App\Filament\Resources\ClassCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassCategory extends EditRecord
{
    protected static string $resource = ClassCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
