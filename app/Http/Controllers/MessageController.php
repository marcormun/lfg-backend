<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Party;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    public function createMessage(Request $request)
    {
        try {
            Log::info("Creating message");
            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:255',
                'from' => 'required|integer',
                'party_id' => 'required|integer',
                'date' => 'required|date'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Error creating message",
                    'data' => $validator->errors()
                ], 400);
            }
            
            $user = User::find(auth()->user()->id);
            if (!$user->parties->contains($request->input('party_id'))) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, you arent in this party'
                ], 400);
            } else {
                $newMessage = new Message();
                $newMessage->message = $request->input("message");
                $newMessage->from = $request->input("from");
                $newMessage->party_id = $request->input("party_id");
                $newMessage->date = $request->input("date");
                $newMessage->save();

                return response()->json([
                    'success' => true,
                    'message' => "Message created.",
                    'data' => $newMessage
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("Error creating message: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error creating message"
            ], 500);
        }
    }
    public function updateMessage($id, Request $request)
    {
        try {
            Log::info("Updating message with id " . $id);

            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:255',
                'from' => 'required|integer',
                'party_id' => 'required|integer',
                'date' => 'required|date'
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
            $message = $request->input("message");
            $from = $request->input("from");
            $party_id = $request->input("party_id");
            $date = $request->input("date");
            if (auth()->user()->id == $message->user_id) {
                $messageUpdate = Message::query()->find($id);
                if (!$messageUpdate) {
                    return response()->json([
                        'success' => true,
                        'message' => "Message not found",
                        'data' => $messageUpdate
                    ], 404);
                }
                if(isset($message)){
                    $messageUpdate->message = $request->input("message");
                }
                if(isset($from)){
                    $messageUpdate->from = $request->input("from");
                }
                if(isset($party_id)){
                    $messageUpdate->party_id = $request->input("party_id");
                }
                if(isset($date)){
                    $messageUpdate->date = $request->input("date");
                }
                $messageUpdate->save();
                return response()->json([
                    'success' => true,
                    'message' => "message updated succesfully",
                    'data ' => $messageUpdate
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => "You are not authoritzed to update a message from another user",
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("Error updating message: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error updating message"
            ], 500);
        }
    }

    public function deleteMessage($id)
    {
        try{
            Log::info("Deleting message with id " . $id);

            $message = Message::query()->find($id);

            if (auth()->user()->id == $message->user_id) {
                $message->delete();
                return response()->json([
                    'success' => true,
                    'message' => "Message deleted succesfully",
                    'data' => $message
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => "You cant delete messages from another user",
                ]);
            }
        }catch(\Exception $exception) {
            Log::error("Error deleting Exception message: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting message"
            ], 500);
        }catch(\Throwable $exception){
            Log::error("Error deleting Throwable message: " . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Error deleting message"
            ], 500);
        }
    }
    public function getMessagesByPartyId ($id)
    {
        try {
            Log::info('Getting messages from a party');

            $messages = Party::find($id)->message;
            
            $sorted = $messages->sortByDesc('created_at');
            $sorted->values()->all();

            if(!$messages){
                return response()->json(
                    [
                        'success' => true,
                        'message' => 'Messages not found'
                    ]
                );
            }

            return response()->json(
                [
                    "success"=> true,
                    "message"=> 'All messages retrieved succesfully',
                    "data"=> $sorted
                ],200
                );


        } catch (\Exception $exception) {
            Log::error('Error getting messages: ' .$exception->getMessage());

            return response()->json(
                [
                    "success"=> false,
                    "message"=> 'Error getting messages'
                ],500
                );
        }
    }
}
