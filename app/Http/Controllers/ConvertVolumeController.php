<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConvertVolumeController extends Controller
{
    public function __invoke($value, $unit)
    {
        // Valida que el valor sea numérico
        $error = !is_numeric($value) ? 'El valor debe ser numérico' : null;

        // Realiza la conversión de volumen según la unidad proporcionada
        $result = match (strtolower($unit)) {
            'liters' => $value * 0.264172, // Conversión de litros a galones americanos
            'gallons' => $value / 0.264172, // Conversión de galones americanos a litros
            default => 'Unidad no reconocida',
        };

        // Retorna el resultado en formato JSON
        return response()->json($error ? ['error' => $error] : ['result' => $result], $error ? 400 : 200);
    }
}
