<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PartyController extends Controller
{
    public function getAllParties()
    {
        try {
            Log::info("Getting all parties");
            $parties = Party::query()
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'message' => "Get all parties retrieved.",
                'data' => $parties
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting parties: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting parties"
            ], 500);
        }
    }
}
