<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
    public function getPartyById($id)
    {
        try {
            Log::info("Getting party with id " . $id);
            $party = Party::query()->find($id);
            if (!$party) {
                return response()->json([
                    'success' => true,
                    'message' => "Party not found",
                    'data' => $party
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => "Get party by id.",
                'data' => $party
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting parties: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting party"
            ], 500);
        }
    }
    public function createParty(Request $request)
    {
        try {
            Log::info("Creating party");

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'game_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        'message' => "Error creating party",
                        "message" => $validator->errors()
                    ],
                    400
                );
            };
            $newParty = new Party();

            $newParty->name = $request->input("name");
            $newParty->game_id = $request->input("game_id");
            $newParty->save();

            return response()->json([
                'success' => true,
                'message' => "Party created succesfully",
                'data ' => $newParty
            ], 200);
        } catch (\Exception $exception) {
            Log::error("Error posting party: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error posting party"
            ], 500);
        }
    }
    public function updateParty($id, Request $request)
    {
        try {
            Log::info("Updating party with id " . $id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'game_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };
            $name = $request->input("name");
            $game_id = $request->input("game_id");

            $party = Party::query()->find($id);
            if (!$party) {
                return response()->json([
                    'success' => true,
                    'message' => "Party not found",
                    'data' => $party
                ], 404);
            }
            
            if(isset($name)){
                $party->name = $request->input("name");
            }
            if(isset($game_id)){
                $party->game_id = $request->input("game_id");
            }
            $party->save();

            return response()->json([
                'success' => true,
                'message' => "Party updated succesfully",
                'data ' => $party
            ], 200);
        } catch (\Exception $exception) {
            Log::error("Error updating party: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error updating party"
            ], 500);
        }
    }

    public function deleteParty($id)
    {
        try{
            Log::info("Deleting party with id " . $id);

            $party = Party::query()
                ->find($id)
                ->delete();
                
            return response()->json([
                'success' => true,
                'message' => "Party deleted succesfully",
                'data' => $party
            ], 200);

        }catch(\Exception $exception) {
            Log::error("Error deleting Exception party: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting party"
            ], 500);
        }catch(\Throwable $exception){
            Log::error("Error deleting Throwable party: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting party"
            ], 500);
        }
    }

    public function getPartyByGameId($id)
    {
        try {
            Log::info("Getting party with game id " . $id);
            $party = Party::query()
                ->where('game_id', $id)
                ->get()
                ->toArray();
                if (!$party) {
                    return response()->json([
                        'success' => true,
                        'message' => "Game not found",
                        'data' => $party
                    ], 404);
                }
            return response()->json([
                'success' => true,
                'message' => "Get party by game id.",
                'data' => $party
            ]);
        } catch (\Exception $exception) {
            Log::error("Error getting parties: " . $exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Error getting party"
            ], 500);
        }
    }

    //TODO ADD USER TO PARTY
    public function joinParty($id){
    
        try {
         Log::info('Add user to party');
 
         $user = User::query()->find($id);

         $user->parties()->attach($id);  

         return response()->json([
             'success' => true,
             'message' => 'User joined succesfully',
             'data' => $user
         ], 200);
        } catch (\Exception $exception) {

         Log::error('Error joining user to party: ' . $exception->getMessage());

         return response()->json([
             'success' => false,
             'message' => 'Error joining user to party',
             'data' => $user
         ], 500);
        }
     }
    //TODO REMOVE USER FROM PARTY

    public function leaveParty($id){
        try {
         Log::info('Remove user from party');
 
         $user = User::query()->find($id);

         $user->parties()->detach($id);
         
         return response()->json([
             'success' => true,
             'message' => 'User left succesfully',
             'data' => $user
         ], 200);
 
        } catch (\Exception $exception) {
         Log::error('Error leaving from party: ' . $exception->getMessage());
         
         return response()->json([
             'success' => false,
             'message' => 'Error leaving from party',
             'data' => $user
         ], 500);
        }
     }
}