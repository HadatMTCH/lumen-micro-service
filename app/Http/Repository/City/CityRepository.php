<?php

namespace App\Http\Repository\City;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class CityRepository implements CityRepositoryInterface {
    public function getAllCity(object $paginate): Collection
    {
        $search = $paginate->search;
        return DB::table('cities')->select('id','name','code')->when(!empty($search),function ($q) use ($search){
            return $q->where('name','like',"%$search%")->orWhere('code','like',"%$search%");
        })->offset($paginate->offset)->limit($paginate->per_page)->get();
    }

    public function getCityById($id): object|null
    {
        return DB::table('cities')->select('id','name','code')->where('id','=',$id)->first();
    }

    public function createCity(string $name, string $code, int $stateId): int
    {
        return DB::table('cities')->insertGetId([
            'name' => $name,
            'code' => $code,
            'state_id' => $stateId,
        ]);
    }

    public function updateCity(int $id, string $name, string $code, int|null $stateId): bool
    {
        return DB::table('cities')->updateOrInsert([
            'id' => $id
        ],[
            'id' =>  $id,
            'name' =>  $name,
            'code' =>  $code,
            'state_id' =>  $stateId,
        ]);
    }

    public function deleteCity(int $id): bool
    {
        return DB::table('cities')->delete($id);
    }
}
