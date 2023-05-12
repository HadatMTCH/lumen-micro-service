<?php

namespace App\Http\Services\City;

use Illuminate\Http\Request;
use App\Http\Repository\City\CityRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CityService implements CityServiceInterface {
    private $cityRepository;
    public function __construct(CityRepositoryInterface $cityRepository) {
        $this->cityRepository = $cityRepository;
    }

    public function getAllCity(Request $request): JsonResponse
    {
        try {
            $paginate = handlePaginate($request);
            $data = $this->cityRepository->getAllCity($paginate);
            return response()->json([
                'data' => $data,
                'message' => 'Sucess fetching city data'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getCityById(Request $request, $id): JsonResponse
    {
        try {
            $data = $this->cityRepository->getCityById($id);
            if (empty($data)) return response()->json([
                'message' => 'City not found'
            ], Response::HTTP_NOT_FOUND);
            return response()->json([
                'data' => $data,
                'message' => 'Fetching city data by id success'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function createCity(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $createdCityId = $this->cityRepository->createCity($request->input('name'),$request->input('code'),$request->input('state_id'));
            DB::commit();
            $cityData = $this->cityRepository->getCityById($createdCityId);
            return response()->json([
                'data' => $cityData,
                'message' => "Success creating city data"
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateCity(Request $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->cityRepository->updateCity($id,$request->input('name'),$request->input('code'),$request->input('state_id'));
            DB::commit();
            $cityData = $this->cityRepository->getCityById($id);
            return response()->json([
                'data' => $cityData,
                'message' => 'Success updating city data'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteCity($id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $this->cityRepository->deleteCity($id);
            DB::commit();
            return response()->json([
                'message' => 'Success deleting city data'
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
