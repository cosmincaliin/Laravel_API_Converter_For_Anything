<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConvertWeightController extends Controller
{
    public function __invoke($value, $unit)
    {
        // Valida que el valor sea numérico
        if (!is_numeric($value)) {
            return response()->json(['error' => 'El valor debe ser numérico'], 400);
        }

        // Realiza la conversión de peso según la unidad proporcionada
        $conversionFactors = [
            'kilograms' => 2.20462, // Conversión de kilogramos a libras
            'pounds' => 1 / 2.20462, // Conversión de libras a kilogramos
        ];

        $result = $value * $conversionFactors[strtolower($unit)] ?? null;

        // Retorna el resultado en formato JSON
        return response()->json(['result' => $result ?? ['error' => 'Unidad no reconocida']], $result ? 200 : 400);
    }
}
