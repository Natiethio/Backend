<?php

namespace App\Http\Controllers;

use App\Models\Flagged_Plates;
use App\Models\Product;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Violation;
use Illuminate\Support\Facades\Auth;
use App\Models\Location;
use App\Models\Traffic;
use Exception;

class SmsController extends Controller
{
    public function Sendsms(Request $req, $id)
    {
        $user = Auth::user();
        $messageBody = $req->message;
        $product = Violation::find($id);
        $location = Location::where('id', $product->location_id)->first();
        $traffic = Traffic::where('location_id', $product->location_id)->get();

        if ($product && $location && $traffic->count() > 0) {
            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_TOKEN');
            $twilio_number = env('TWILIO_PHONE');

            try {
                $client = new Client($account_sid, $auth_token);

                foreach ($traffic as $officer) {
                    $phone = $officer->phone;
                    // Remove leading zero and prepend country code
                    if (substr($phone, 0, 1) === '0') {
                        $phone = '+251' . substr($phone, 1);
                    }

                    $client->messages->create(
                        $phone, // Recipient's phone number
                        [
                            'from' => $twilio_number,
                            'body' => "Sent from TMS\n" .
                                      "Case: {$product->violation_type}\n" .
                                      "License: {$product->License_plate}\n" .
                                      "Description: $messageBody\n" .
                                      "Recored The license and find it in your district!!"
                        ]
                    );
                }

                return response()->json(['status' => 200, 'messagesuccuss' => 'Messages Sent Successfully!!']);
            } catch (Exception $exception) {
                return response()->json(['status' => 500, 'error' => $exception->getMessage()]);
            }
        } else {
            return response()->json(['status' => 404, 'error' => 'Product or Location or Traffic not found.']);
        }
    }
    public function SendSmsFlagged(Request $req, $id)
    {
        $user = Auth::user();
        $messageBody = $req->message;
        $product = Flagged_Plates::find($id);
        $location = Location::where('id', $product->location_id)->first();
        $traffic = Traffic::where('location_id', $product->location_id)->get();

        if ($product && $location && $traffic->count() > 0) {
            $account_sid = env('TWILIO_SID');
            $auth_token = env('TWILIO_TOKEN');
            $twilio_number = env('TWILIO_PHONE');

            try {
                $client = new Client($account_sid, $auth_token);

                foreach ($traffic as $officer) {
                    $phone = $officer->phone;
                    // Remove leading zero and prepend country code
                    if (substr($phone, 0, 1) === '0') {
                        $phone = '+251' . substr($phone, 1);
                    }

                    $client->messages->create(
                        $phone, // Recipient's phone number
                        [
                            'from' => $twilio_number,
                            'body' => "Sent TMS\n" .
                                      "Case: Flagged vehicle\n" .
                                      "License: {$product->license_plate}\n" .
                                      "Description: $messageBody\n" .
                                      "Recored the license and find it in your district!!"
                        ]
                    );
                }

                return response()->json(['status' => 200, 'messagesuccuss' => 'Messages Sent Successfully!!']);
            } catch (Exception $exception) {
                return response()->json(['status' => 500, 'error' => $exception->getMessage()]);
            }
        } else {
            return response()->json(['status' => 404, 'error' => 'Location or Traffic not found.']);
        }
    }
}
