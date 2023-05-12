<?php

namespace App\Http\Repository\Country;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

interface CountryRepositoryInterface {
    public function getAllCountry(object $paginate): Collection;
    public function getCountryById($id): object|null;
    public function createCountry(string $name, string $code, string $continent): int;
    public function updateCountry(int $id, string $name, string $code, string $continent): bool;
    public function deleteCountry(int $id): bool;
}
