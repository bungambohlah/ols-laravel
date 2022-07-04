<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\GetResource;
use App\Models\Pajak;
use Illuminate\Support\Facades\Validator;

class PajakController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pajak = Pajak::latest()->get();

        return new GetResource($pajak);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     *
     * @return void
     */
    public function store(Request $request)
    {
        // validate rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'rate' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // insert pajak
        $pajak = Pajak::create([
            'nama' => $request->nama,
            'rate' => $request->rate,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return new GetResource($pajak);
    }

    /**
     * show
     *
     * @param  mixed $pajak
     * @return void
     */
    public function show(Pajak $pajak)
    {
        return new GetResource($pajak);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $pajak
     * @return void
     */
    public function update(Request $request, Pajak $pajak)
    {
        // validate rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'rate' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pajak->update([ 'nama' => $request->nama, 'rate' => $request->rate ]);

        return new GetResource($pajak);
    }

    /**
     * destroy
     *
     * @param  mixed $pajak
     *
     * @return void
     */
    public function destroy(Pajak $pajak)
    {
        $pajak->delete();

        return new GetResource(null);
    }
}
