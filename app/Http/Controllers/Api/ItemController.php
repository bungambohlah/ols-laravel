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
        $item = Item::latest()
        ->select('item.*',
            Item::raw('CONCAT(\'[\', GROUP_CONCAT(JSON_OBJECT("id", pajak.id, "nama", pajak.nama, "rate", pajak.rate)),\']\') AS pajak'))
        ->leftJoin('pajakitem', 'pajakitem.item_id', '=', 'item.id')
        ->leftJoin('pajak', 'pajak.id', '=', 'pajakitem.pajak_id')
        ->groupBy('item.id')
        ->get();
        $item->each(function ($item) {
            $item->pajak = json_decode($item->pajak);
        });

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

        $returnItem = Item::select('item.*',
            Item::raw('CONCAT(\'[\', GROUP_CONCAT(JSON_OBJECT("id", pajak.id, "nama", pajak.nama, "rate", pajak.rate)),\']\') AS pajak'))
        ->leftJoin('pajakitem', 'pajakitem.item_id', '=', 'item.id')
        ->leftJoin('pajak', 'pajak.id', '=', 'pajakitem.pajak_id')
        ->where('item.id', $item->id)
        ->groupBy('item.id')
        ->first();

        $returnItem->pajak = json_decode($returnItem->pajak);

        return new GetResource($returnItem);
    }

    /**
     * show
     *
     * @param  mixed $item
     * @return void
     */
    public function show(Item $item)
    {
        $returnItem = Item::select('item.*',
            Item::raw('CONCAT(\'[\', GROUP_CONCAT(JSON_OBJECT("id", pajak.id, "nama", pajak.nama, "rate", pajak.rate)),\']\') AS pajak'))
        ->leftJoin('pajakitem', 'pajakitem.item_id', '=', 'item.id')
        ->leftJoin('pajak', 'pajak.id', '=', 'pajakitem.pajak_id')
        ->where('item.id', $item->id)
        ->groupBy('item.id')
        ->first();

        $returnItem->pajak = json_decode($returnItem->pajak);

        return new GetResource($returnItem);
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

        $returnItem = Item::select('item.*',
            Item::raw('CONCAT(\'[\', GROUP_CONCAT(JSON_OBJECT("id", pajak.id, "nama", pajak.nama, "rate", pajak.rate)),\']\') AS pajak'))
        ->leftJoin('pajakitem', 'pajakitem.item_id', '=', 'item.id')
        ->leftJoin('pajak', 'pajak.id', '=', 'pajakitem.pajak_id')
        ->where('item.id', $item->id)
        ->groupBy('item.id')
        ->first();

        $returnItem->pajak = json_decode($returnItem->pajak);

        return new GetResource($returnItem);
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
