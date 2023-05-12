<?php

use Illuminate\Http\Request;

if(!function_exists('handlePaginate')) {
    function handlePaginate(Request $request): object {
        $result = new stdClass;
        $result->page = 1;
        $result->per_page = 10;
        $result->search = "";
        if (($request->has('page')) && !empty($request->page != 0)) {
            $result->page = (int)$request->page;
        }


        if (($request->has('per_page')) && !empty($request->per_page)) {
            $result->per_page = (int)$request->per_page;
        }

        $result->offset = ($result->page - 1) * $result->per_page;
        if ($request->has('search')) {
            $result->search = $request->search;
        }
        return $result;
    }
}
