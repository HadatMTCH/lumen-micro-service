<?php

namespace App\Http\Services\Country;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CountryServiceInterface {
    public function getAllCountry(Request $request): JsonResponse;
    public function getCountryById($id): JsonResponse;
    public function createCountry(Request $request): JsonResponse;
    public function updateCountry(Request $request, $id): JsonResponse;
    public function deleteCountry($id): JsonResponse;
}
