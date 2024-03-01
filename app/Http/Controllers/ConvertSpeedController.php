<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConvertSpeedController extends Controller
{
    public function __invoke($value, $unit)
    {
        // Valida que el valor sea numérico
        if (!is_numeric($value)) {
            return response()->json(['error' => 'El valor debe ser numérico'], 400);
        }

        // Realiza la conversión de velocidad según la unidad proporcionada
        $conversionFactors = [
            'kilometers' => 0.621371, // Conversión de kilómetros por hora a millas por hora
            'miles' => 1.60934 // Conversión de millas por hora a kilómetros por hora
        ];

        $result = $value * $conversionFactors[strtolower($unit)] ?? null;

        // Retorna el resultado en formato JSON
        return response()->json(['result' => $result ?? ['error' => 'Unidad no reconocida']], $result ? 200 : 400);
    }
}
