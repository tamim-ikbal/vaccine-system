<?php

namespace App\DTO;

use App\Abstract\DTO;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class DiseaseDTO extends DTO
{
    public string $name;
    public string $displayName;

    public ?string $description;

    public static function create(Request $request): DiseaseDTO
    {
        return new self([
            'name'        => $request->input('name'),
            'displayName' => $request->input('display_name'),
            'description' => $request->input('description', '')
        ]);
    }

    public function toArray(): array
    {
        return [
            'name'         => $this->name,
            'display_name' => $this->displayName,
            'description'  => $this->description,
        ];
    }
}
