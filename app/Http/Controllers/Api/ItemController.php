<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\GetResource;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $item = Item::latest()->with('pajak')->get();

        return new GetResource($item);
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
            'pajak_id' => 'required|array|min:2',
            'pajak_id.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // insert item
        $item = Item::create([
            'nama' => $request->nama,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $item->pajak()->attach($request->pajak_id);
        $item->load('pajak');

        return new GetResource($item);
    }

    /**
     * show
     *
     * @param  mixed $item
     * @return void
     */
    public function show(Item $item)
    {
        $item->load('pajak');
        return new GetResource($item);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $item
     * @return void
     */
    public function update(Request $request, Item $item)
    {
        // validate rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'pajak_id' => 'required|array|min:2',
            'pajak_id.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $item->update([ 'nama' => $request->nama ]);
        $item->pajak()->detach();
        $item->pajak()->attach($request->pajak_id);
        $item->load('pajak');

        return new GetResource($item);
    }

    /**
     * destroy
     *
     * @param  mixed $item
     *
     * @return void
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return new GetResource(null);
    }
}
