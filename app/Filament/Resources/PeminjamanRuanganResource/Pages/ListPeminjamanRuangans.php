<?php

namespace App\Filament\Resources\PeminjamanRuanganResource\Pages;

use App\Filament\Resources\PeminjamanRuanganResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListPeminjamanRuangans extends ListRecords
{
    protected static string $resource = PeminjamanRuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
