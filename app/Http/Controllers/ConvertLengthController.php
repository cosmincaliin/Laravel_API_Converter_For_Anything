<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConvertLengthController extends Controller
{
    public function __invoke($value, $unit)
    {
        // Validate that the value is numeric
        if (!is_numeric($value)) {
            return response()->json(['error' => 'The value must be numeric'], 400);
        }

        // Define the conversion factors
        $conversionFactors = [
            'meters' => 3.28084, // Convert meters to feet
            'feet' => 1 / 3.28084, // Convert feet to meters
        ];

        // Check if the provided unit is recognized
        if (!isset($conversionFactors[strtolower($unit)])) {
            return response()->json(['error' => 'Unrecognized unit'], 400);
        }

        // Convert the length based on the provided unit
        $result = $value * $conversionFactors[strtolower($unit)];

        // Return the result in JSON format
        return response()->json(['result' => $result]);
    }
}
