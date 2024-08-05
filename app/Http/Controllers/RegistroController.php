<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *     path="/api/registros",
 *     @OA\Response(response="200", description="Listar todos registros")
 * )
 *
 * @OA\Get(
 *     path="/api/registros/{id}",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response="200", description="Filtrar um registro")
 * )
 */

class RegistroController extends Controller
{
    public function index()
    {
        return Registro::all();
    }

    public function show($id)
    {
        return Registro::find($id);
    }
}