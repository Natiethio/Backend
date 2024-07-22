<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Violation;
use Illuminate\Support\Facades\Auth;
use App\Models\location;
use App\Models\Traffic;
use Exception;

class SmsController extends Controller
{
    public function Sendsms(Request $req, $id)
    {
        $user = Auth::user();
        $messageBody = $req->message;
        $product = Violation::find($id);
        $location = location::where('id',$product->location_id)->get();
        $traffic = Traffic::where('location_id',$product->location_id)->get();
        if ($product) {
            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_TOKEN');
            $twilio_number = env('TWILIO_PHONE');

            try {
                $client = new Client($account_sid, $auth_token);
                $message = $client->messages->create(
                    "+251 71 291 1008", // Recipient's phone number
                    [
                        'from' => $twilio_number,
                        'body' => "Sent TMS\n" .
                                  "Case: {$product->violation_type}\n" .
                                  "License: {$product->License_plate}\n" .
                                  "Description: $messageBody\n" .
                                  "Recored The license and find it in your district!!"
                    ]
                );

                return response()->json(['status' => 200, 'messagesuccuss' => 'Message Sent Successfully!!']);
            } catch (Exception $exception) {
                return response()->json(['status' => 500, 'error' =>  $exception]);
            }
        } else {
            return response()->json(['status' => 404, 'error' => 'Product not found.']);
        }
    }
}
