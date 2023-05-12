<?php

namespace App\Http\Services\City;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface CityServiceInterface {
    public function getAllCity(Request $request): JsonResponse;
    public function getCityById(Request $request,$id): JsonResponse;
    public function createCity(Request $request): JsonResponse;
    public function updateCity(Request $request, $id): JsonResponse;
    public function deleteCity($id): JsonResponse;
}
