<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kind;
use Illuminate\Http\Request;

class AnimalKindController extends Controller
{
    public function index()
    {
        return Kind::All();
    }
}
