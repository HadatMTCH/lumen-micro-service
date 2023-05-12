<?php

namespace App\Http\Controllers;

use App\Http\Services\City\CityServiceInterface;
use App\Http\Services\Country\CountryServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;
use Symfony\Component\HttpFoundation\Response;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $countryServiceInterface,$cityServiceInterface;
    public function __construct(CountryServiceInterface $countryServiceInterface, CityServiceInterface $cityServiceInterface)
    {
        $this->countryServiceInterface = $countryServiceInterface;
        $this->cityServiceInterface = $cityServiceInterface;
    }

    public function index(Request $request) {
        $countryData = $this->countryServiceInterface->getAllCountry($request);
        return response()->json([
            'data' => $countryData,
            'message' => "Success fetching country data"
        ], Response::HTTP_OK);
    }

    public function getCountryById(Request $request, $id) {
        $countryData = $this->countryServiceInterface->getCountryById($request,$id);
        return response()->json([
            'data' => $countryData,
            'message' => "Success fetching country data by id"
        ], Response::HTTP_OK);
    }

    public function getAllCities(Request $request): JsonResponse {
        return $this->cityServiceInterface->getAllCity($request);
    }

    public function getCityById(Request $request, $id): JsonResponse {
        return $this->cityServiceInterface->getCityById($request,$id);
    }

    public function createCountry(Request $request): JsonResponse {
        return $this->countryServiceInterface->createCountry($request);
    }

    public function updateCountry(Request $request, $id): JsonResponse {
        return $this->countryServiceInterface->updateCountry($request,$id);
    }

    public function deleteCountry($id): JsonResponse {
        return $this->countryServiceInterface->deleteCountry($id);
    }

    public function createCity(Request $request): JsonResponse {
        return $this->cityServiceInterface->createCity($request);
    }

    public function updateCity(Request $request, $id): JsonResponse {
        return $this->cityServiceInterface->updateCity($request,$id);
    }

    public function deleteCity($id): JsonResponse {
        return $this->cityServiceInterface->deleteCity($id);
    }
}
