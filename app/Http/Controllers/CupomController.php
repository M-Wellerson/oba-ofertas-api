<?php

namespace App\Http\Controllers;

use App\Services\CupomService;
use App\Models\Cupom;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cupom::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return CupomService::create($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cupom  $cupom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return CupomService::show($id);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cupom  $cupom
     * @return \Illuminate\Http\Response
     */
    public function edit(Cupom $cupom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cupom  $cupom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cupom $cupom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cupom  $cupom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cupom $cupom)
    {
        //
    }
}
