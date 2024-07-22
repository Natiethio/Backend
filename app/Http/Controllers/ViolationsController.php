<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Flagged_Plates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Violation;
use Illuminate\Support\Facades\Validator;
use App\Models\location;
use App\Models\Traffic;

class ViolationsController extends Controller
{
  function AddViolation(Request $request)
  {
    if(Auth::id()){
    $user = Auth::user();
    $validatedData = Validator::make($request->all(), [
      // 'name' => 'required|max:100',
      'description' => 'required|max:200',
      'License_plate' => 'required',
      // 'image' => 'required|image',
  ]);

    if ($validatedData->fails()) {

         return response()->json([
        'validate_err' => $validatedData->messages(),

      ]);
    } 

      // $product = new Product();
      $product = new Flagged_Plates();
      // $product->name = $request->name;
      $product->flagged_by = $user->firstname.' '.$user->lastname;
      $product->phone = $user->phone;
      $product->license_plate =$request->License_plate;
      $product->description =$request->description;
      // $image = $request->file('image');
      // $imageName = time() . '.' . $image->getClientOriginalExtension();
      // $image->move('products', $imageName);

      // $product->image = $imageName;
      $product->save();
      // return  $product;
      return response()->json([
        'status' => 200,
        'message' => 'Added Successfully!',
        'result' => $product
      ]);
    }
    else{
      return response()->json([
        'status' => 500,
        'message' => "Failed to add the item!",
        // 'result' => $product
      ]);
  }
}

function AddTraffic(Request $request)
{
  if(Auth::id()){
  $user = Auth::user();
  $validatedData = Validator::make($request->all(), [
    // 'name' => 'required|max:100',
    'name' => 'required|max:200',
    'phone' => 'required',
    'location' => 'required',
]);

  if ($validatedData->fails()) {

       return response()->json([
      'validate_err' => $validatedData->messages(),

    ]);
  } 
  $location = location::where('location',$request->location)->first();
    // $product = new Product();
    $product = new Traffic();
    // $product->name = $request->name;
    $product->location_id =  $location->id;
    $product->name = $request->name;
    $product->phone = $request->phone;
    // $product->description =$request->description;
    // $image = $request->file('image');
    // $imageName = time() . '.' . $image->getClientOriginalExtension();
    // $image->move('products', $imageName);

    // $product->image = $imageName;
    $product->save();
    // return  $product;
    return response()->json([
      'status' => 200,
      'message' => 'Traffic Added Successfully!',
      'result' => $product
    ]);
  }
  else{
    return response()->json([
      'status' => 500,
      'message' => "Failed to add the traffic!",
      // 'result' => $product
    ]);
}
}

  function Violationlist()
  {
    $products = Violation::all();
    return $products;
  }
  // function Delete($id){
  //   $result = Product::where('id',$id)->delete();

  //    if($result){
  //     return response()->json(["success" => "Product Deleted Successfully!"], 401);
  //    }

  //    else{
  //     return response()->json(["error" => "Error While Deleting the product!"], 401);
  //    }

  // }
  public function Delete($id){
    if(Auth::id()){
    $product = Violation::find($id);

    if (!$product) {
      return response()->json(["error" => "Violation not found!"], 401);
    }

    // Delete the associated image from the public products table
    $imagePath = public_path('products/' . $product->image);
    if (File::exists($imagePath)) {
      File::delete($imagePath);
    }

    $imagePath = public_path('test/' . $product->image);
    if (File::exists($imagePath)) {
      File::delete($imagePath);
    }

    $result = $product->delete();

    if ($result) {
      return response()->json([
        "status" => 200,
        "success" => "Violation deleted successfully!"
      ], 200);
    } else {
      return response()->json(["error" => "Error while deleting the product!"], 500);
    }
  }
  else{
    return response()->json(["error" => "Error while deleting the product!"], 401);
  }
  }

  public function DeleteFlagged($id){
    if(Auth::id()){
    $product = Flagged_Plates::find($id);

    if (!$product) {
      return response()->json(["error" => "Flagged not found!"], 401);
    }

    // // Delete the associated image from the public products table
    // $imagePath = public_path('products/' . $product->image);
    // if (File::exists($imagePath)) {
    //   File::delete($imagePath);
    // }

    $result = $product->delete();

    if ($result) {
      return response()->json([
        "status" => 200,
        "success" => "Flagged Vehicle deleted successfully!"
      ], 200);
    } else {
      return response()->json(["error" => "Error while deleting the Flagged!"], 500);
    }
  }
  else{
    return response()->json(["error" => "Error while deleting the Flagged!"], 401);
  }
  }
  public function GetViolation($id)
  {
    if(Auth::id()){
    $product = Violation::where('id', $id)->first();
    $location = location::where('id',$product->location_id)->get();
    return response()->json([
      "status" => 200,
      "product" => $product,
      "location" =>  $location,
      "success" => "Successfully!"
    ], 200);
    }
  }

  function GetFlagged($id){
    if(Auth::id()){
    $product = Flagged_Plates::where('id', $id)->first();
    // return $product;
    $location = location::where('id',$product->location_id)->get();
    return response()->json([
      "status" => 200,
      "product" => $product,
      "location" =>  $location,
      "success" => "Successfully!"
    ], 200);
    }
  }

  function UpdateViolation(Request $req, $id)
  {
  if(Auth::id()){

  
    $validatedData = Validator::make($req->all(), [
      'violation_type' => 'required|max:100',
      'description' => 'required|max:200',
      // 'License_plate' => 'required|size:6',
      'License_plate' => 'required',
  ]);

    if ($validatedData->fails()) {
         return response()->json([
        'validate_err' => $validatedData->messages(),
      ]);
    } 

    $product = Violation::where('id', $id)->first();
    $product->violation_type = $req->violation_type;
    $product->description = $req->description;
    $product->License_plate = $req->License_plate;

    if ($req->image) {
      $image = $req->image;
      $imagename = time() . '.' . $image->getClientOriginalExtension();
      $image->move('products', $imagename);
      $product->image = $imagename;
    } else {
      $product->image = $product->image;
    }

    $product->update();

    // return  $product;
    return response()->json([
      'status' => 200,
      'message' => 'Violation Added Successfully!',
      'product' => $product
    ]);
  }
  else{
    return response()->json([
      'message' => 'Failed!',
    ],401);
  }
}
function UpdateFlagged(Request $req, $id)
{
if(Auth::id()){


  $validatedData = Validator::make($req->all(), [
    'flagged_by' => 'required|max:100',
    'description' => 'required|max:200',
    'license_plate' => 'required',
]);

  if ($validatedData->fails()) {
       return response()->json([
      'validate_err' => $validatedData->messages(),
    ]);
  } 

  $product = Flagged_Plates::where('id', $id)->first();
  $product->flagged_by = $req->flagged_by;
  $product->license_plate = $req->license_plate;
    $product->description = $req->description;

  // if ($req->image) {
  //   $image = $req->image;
  //   $imagename = time() . '.' . $image->getClientOriginalExtension();
  //   $image->move('products', $imagename);
  //   $product->image = $imagename;
  // } else {
  //   $product->image = $product->image;
  // }

  $product->update();

  // return  $product;
  return response()->json([
    'status' => 200,
    'message' => 'Violation Added Successfully!',
    'product' => $product
  ]);
}
else{
  return response()->json([
    'message' => 'Failed!',
  ],401);
 }
}

  public function Search($key)
  {
    if(Auth::id()){
      $products = Violation::where('violation_type', 'Like', "%$key%")
      ->orWhere('description', 'Like', "%$key%")
      ->orWhere('License_plate', 'Like', "%$key%")->get();
      if ($products) {
        return response()->json([
          "status" => 200,
          // "success" => "Product deleted successfully!",
          "result" => $products
        ], 200);
      } else {
        return response()->json(["error" => "Error while searching the product!"], 500);
      }
    // return  $products;
    }
    else{
      return response()->json([
        'message' => 'Failed!',
      ],401);
    }
}
public function SearchFlagged($key)
{
  if(Auth::id()){
    $products = Flagged_Plates::where('flagged_by', 'Like', "%$key%")
    ->orWhere('license_plate', 'Like', "%$key%")
    ->orWhere('description', 'Like', "%$key%")->get();
    if ($products) {
      return response()->json([
        "status" => 200,
        // "success" => "Product deleted successfully!",
        "result" => $products
      ], 200);
    } else {
      return response()->json(["error" => "Error while searching the flagged!"], 500);
    }
  // return  $products;
  }
  else{
    return response()->json([
      'message' => 'Failed!',
    ],401);
  }
}
// public function Flagged(){
  
//     $product = Flagged_Plates::orderBy('id','dec')->all();
   
//     return $product;
//    }
public function Flagged() {
    $products = Flagged_Plates::orderBy('id', 'desc')->get();
    
    return $products;
}

   public function FindLocation(){
  
    $product = location::all();
    return $product;
   }
   public function upload(Request $request)
   {
       // Validate incoming request
      
       $request->validate([
           'violation_type' => 'required|string',
           'description' => 'required|string',
           'image' => 'required|image',
           'License_plate' => 'required|string',
       ]);
     
       // Retrieve the files and other text data
       $violation = $request->input('violation_type');
       $description = $request->input('description');
       $License_plate = $request->input('License_plate');
       $imageFile = $request->file('image');

    $$imageFile->store('uploads/text_files');
    $imagename = time() . '.' . $imageFile->getClientOriginalExtension(); //time() give image a unique name
    $request['image']->move('products', $imagename); //we will store image on 'custemersell folder of the public directory
    // $imageFile->store('uploads/image_files');
    // $violation = new Violation();
    // $violation->violation_type = $violation;
    // $violation->description = $description;
    // $violation->License_plate = $License_plate;
    // $violation->image = $imagename;
    // $violation->save();
       // Prepare the response data
     //   $response = [
     //       'status' => 200,
     //       'message' => 'Successfull',
     //       'string' =>  $reqback,
     //   ];

       return response()->json([
         'status' => 200,
         'message' =>  'Success',
       ]);
   }


   public function test(Request $request)
   {
       // Validate incoming request
       $request->validate([
           'violation_type' => 'required|string',
           'image_file' => 'required|image',
           'description' => 'required|string',
           'License_plate' => 'required|string',
       ]);

       $imageFile = $request->file('image_file');
       $originalName = $imageFile->getClientOriginalName();
       $imagename = $originalName; //time() give image a unique name
    //    $fileInfo = pathinfo($imagename);

    $request['image_file']->move('test', $imagename); //we will store image on 'custemersell folder of the public directory
    $violation = new Violation();

    $violation->violation_type =  $request->violation_type;
    $violation->description = $request->description;
    $violation->License_plate = $request->License_plate;
    $violation->image = $imagename;
    $violation->save();

       return response()->json([
         'status' => 200,
         'message' =>  'Success',
       ]);
   }
}

