<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlushCreate;
use App\Http\Requests\PlushUpdate;
use App\Models\Plush;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plushes = Plush::all();
        return response()->json($plushes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), (new PlushCreate())->rules());
        if ($validator->fails()) {
            $errormsg = "";
            foreach ($validator->errors()->all() as $error) {
                $errormsg .= $error . " ";
            }
            $errormsg = trim($errormsg);
            return response()->json($errormsg, 400);
        }
        $plush = new Plush();
        $plush->fill($request->all());
        $plush->save();
        return response()->json($plush, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plush  $plush
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $plush = Plush::find($id);
        if (is_null($plush)) {
            return response()->json(["message" => "A megadott azonosítóval nem található plush."], 404);
        }
        return response()->json($plush);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plush  $plush
     * @return \Illuminate\Http\Response
     */
    public function update(PlushUpdate $request, int $id)
    {
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), (new PlushUpdate())->rules());
            if ($validator->fails()) {
                $errormsg = "";
                foreach ($validator->errors()->all() as $error) {
                    $errormsg .= $error . " ";
                }
                $errormsg = trim($errormsg);
                return response()->json($errormsg, 400);
            }
        }
        $plush = Plush::find($id);
        if (is_null($plush)) {
            return response()->json(["message" => "A megadott azonosítóval nem található plush."], 404);
        }
        $plush->fill($request->all());
        $plush->save();
        return response()->json($plush, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plush  $plush
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $adoptionType = Plush::find($id);
        if (is_null($adoptionType)) {
            return response()->json(["message" => "A megadott azonosítóval nem található adoptionType."], 404);
        }
        Plush::destroy($id);
        return response()->noContent();
    }
}
