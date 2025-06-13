<?php

namespace App\DTO;

class CodeDTO
{
    public function __construct(
        public readonly string $code,
        public readonly string $language,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?string $url = null,
    ) {}
}
