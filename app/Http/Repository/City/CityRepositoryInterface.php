<?php

namespace App\Http\Repository\City;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

interface CityRepositoryInterface {
    public function getAllCity(object $paginate): Collection;
    public function getCityById($id): object|null;
    public function createCity(string $name, string $code, int $stateId): int;
    public function updateCity(int $id, string $name, string $code, int|null $stateId): bool;
    public function deleteCity(int $id): bool;
}
