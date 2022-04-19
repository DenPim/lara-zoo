<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Kind;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        return response()->json(Animal::all());
    }

    public function create(Request $request)
    {
        if (!$request->input('kind')) {
            return response()->json([
                'success' => 'false'
            ]);
        }
        if (Kind::where('kind', $request->input('kind'))->count()) {

            if(!empty($request->input('name'))){
                $animalName = $request->input('name');
            } else {
                $animalName = 'Simon' . rand(1, 100);
            }
            $create_animal = Animal::create([
                'name' => $animalName,
                'kind' => $request->input('kind'),
                'age' => 1,
                'size' => 1
            ]);
            return response()->json($create_animal);
        } else {
            return response()->json([
                'success' => 'false'
            ]);
        }
    }
    public function animalInfo( $name )
    {
        if (Animal::where('name', $name)->count()){
            $response = Animal::where('name', $name)->count();
        } else {
            $response = ["error" => 'Animal with that name not found', "data" => false];
        }
        return response()->json($response);
    }
    public function age( Request $request )
    {
        $error = '';
        if(!empty($request->input('name'))){
            $animalName = $request->input('name');
        } else {
            $error = 'No name specified';
        }
        if(Animal::where('name', $request->input('name'))->count()){
            $animalName = $request->input('name');
        } else {
            $error = 'Animal with that name not found';
        }

        if ($error){
            return response()->json([
                'error' => $error,
                'data' => false,
            ]);
        } else {
            $animal = Animal::where('name', $request->input('name'))->first();
            $animalKind = Kind::where('kind', $animal->kind)->first();

            $animal->age += 1;
            $animal->size += $animalKind->growth_factor;

            if ($animal->age > $animalKind->max_age){
                $animal->age = $animalKind->max_age;
            }
            if ($animal->size > $animalKind->max_size){
                $animal->size = $animalKind->max_size;
            }

            $animal->save();
        }
        return response()->json([
            'error' => null,
            'data' => 'ok',
        ]);
    }
}
