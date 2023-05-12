<?php

namespace App\Http\Services\Country;

use Illuminate\Http\Request;
use App\Http\Repository\Country\CountryRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CountryService implements CountryServiceInterface {
    private $countryRepository;
    public function __construct(CountryRepositoryInterface $countryRepository) {
        $this->countryRepository = $countryRepository;
    }

    public function getAllCountry(Request $request): JsonResponse
    {
        try {
            $paginate = handlePaginate($request);
            $data = $this->countryRepository->getAllCountry($paginate);
            return response()->json([
                'data' => $data,
                'message' => 'Success fetching country data'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_OK);
        }
    }

    public function getCountryById($id): JsonResponse
    {
        try {
            $data = $this->countryRepository->getCountryById($id);

            if (empty($data)) return response()->json([
                'message' => "Country data not found"
            ], Response::HTTP_NOT_FOUND);

            return response()->json([
                'data' => $data,
                'message' => 'Fetching country by id sucess'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createCountry(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $createdCountryId = $this->countryRepository->createCountry($request->input('name'),$request->input('code'),$request->input('continent'));
            DB::commit();
            $countryData = $this->countryRepository->getCountryById($createdCountryId);
            return response()->json([
                'data' => $countryData,
                'message' => 'Success creating country'
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateCountry(Request $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->countryRepository->updateCountry($id,$request->input('name'),$request->input('code'),$request->input('continent'));
            DB::commit();
            $countryData = $this->countryRepository->getCountryById($id);
            return response()->json([
                'data' => $countryData,
                'message' => 'Success updating country data'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteCountry($id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->countryRepository->deleteCountry($id);
            DB::commit();
            return response()->json([
                'message' => 'Success deleting country data'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
