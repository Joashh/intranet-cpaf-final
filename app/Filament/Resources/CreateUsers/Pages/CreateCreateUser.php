<?php

namespace App\Filament\Resources\CreateUsers\Pages;

use App\Filament\Resources\CreateUsers\CreateUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCreateUser extends CreateRecord
{
    protected static string $resource = CreateUserResource::class;
}
