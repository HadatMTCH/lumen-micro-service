<?php

namespace App\Http\Repository\Country;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CountryRepository implements CountryRepositoryInterface {
    public function getAllCountry(object $paginate): Collection
    {
        $search = $paginate->search;
        return DB::table('countries')->select('id','name','code','continent')->when(!empty($search),function ($q) use ($search){
            return $q->where('name','like',"%$search%")->orWhere('code','like',"%$search%")->orWhere('continent','like',"%$search%");
        })->offset($paginate->offset)->limit($paginate->per_page)->get();
    }

    public function getCountryById($id): object|null
    {
        return DB::table('countries')->select('id','name','code','continent')->where('id',$id)->first();
    }

    public function createCountry(string $name, string $code, string $continent): int
    {
        return DB::table('countries')->insertGetId([
            'name' => $name,
            'code' => $code,
            'continent' => $continent,
            'created_at' => Carbon::now()
        ]);
    }

    public function updateCountry(int $id, string $name, string $code, string $continent): bool
    {
        return DB::table('countries')->updateOrInsert([
            'id' => $id
        ],[
            'name' => $name,
            'code' => $code,
            'continent' => $continent,
            'updated_at' => Carbon::now()
        ]);
    }

    public function deleteCountry(int $id): bool
    {
        return DB::table('countries')->delete($id);
    }
}
