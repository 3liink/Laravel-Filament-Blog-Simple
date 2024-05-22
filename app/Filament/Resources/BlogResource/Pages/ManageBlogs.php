<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;

class ManageBlogs extends ManageRecords
{
    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->mutateFormDataUsing(function (array $data): array {
                $data['user_id'] = Auth::id();
                return $data;
            })
            ->label("เพิ่มบทความ")
            ->modalHeading("เพิ่มบทความ")
            ->modalDescription(Auth::id())
            ->icon("feathericon-plus-square")
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Prevent changing the user_id when editing
        unset($data['user_id']);

        return $data;
    }

}
