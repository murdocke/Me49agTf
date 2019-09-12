<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequests;
use App\Models\VehicleMakes;
use App\Models\VehicleModels;

use Validator;

use Debugbar;

class ServiceRequestsController extends Controller {

  /**
   * [Display a paginated list of Service Requests in the system]
   * @return view
   */
  public function index(){

    $requests = ServiceRequests::orderBy('updated_at','desc')->paginate(20);
    return view('index',compact('requests'));
  }
  /**
   * [This is the method you should use to show the edit screen]
   * @param  ServiceRequests $serviceRequest [get the object you are planning on editing]
   * @return ...
   */
  public function edit(ServiceRequests $serviceRequest){

    //return $serviceRequest->id;
    $vehicleMakes = VehicleMakes::orderBy('title')->get();
    $currentVehicleModel = VehicleModels::find($serviceRequest->vehicle_model_id);
    $currentVehicleMake = $currentVehicleModel->vehicle_make_id;
    $currentVehicleModels = VehicleMakes::find($currentVehicleMake)->vehicleModels()->orderBy('title')->get();
    return view('edit', compact('serviceRequest', 'vehicleMakes', 'currentVehicleMake', 'currentVehicleModels'));

  }

  public function update(Request $request){

    //dd($request->request_id);
    $serviceRequest = ServiceRequests::findorfail($request->request_id);

    $serviceRequest->client_name = $request->client_name;
    $serviceRequest->client_phone = $request->client_phone;
    $serviceRequest->client_email = $request->client_email;
    $serviceRequest->vehicle_model_id = $request->vehicle_model_id;
    //dd($request->vehicle_model_id);
    $serviceRequest->description = $request->description;    


    $serviceRequest->save();

    return redirect('/');

  }

  public function create(){

    $vehicleMakes = VehicleMakes::orderBy('title')->get();
    return view('create', compact('vehicleMakes'));

  }

  public function store(Request $request){

    $input = $request->all();

    $input['status'] = 'new';

    $rules = array(
      'vehicle_make_id' => 'required',
      'vehicle_model_id' => 'required',
      'client_name' => 'required',
      'client_phone' => 'required|regex:^[0-9]$^',
      'client_email' => 'required|email',
      'description' => 'required'
    );

    $messages = [
      'vehicle_make_id.required' => 'You must provide the make of your car.',
      'vehicle_model_id.required' => 'You must provide the model of your car.',
      'client_phone.numeric' => 'You must provide a valid phone number.',
      'client_phone.regex' => 'You must provide a valid phone number.',
    ];

    $validation = Validator::make($input, $rules, $messages);

      //get the models of the chosen make in case there is an error and we must return back to the page
    
      //first check if they selected a make and otherwise keep the model array empty
      if(!empty($input['vehicle_make_id'])){
      $vehicleModels = VehicleMakes::find($input['vehicle_make_id'])->vehicleModels()->orderBy('title')->get();
      }else{
       $vehicleModels = [];
      }

    if ($validation->fails()) {       
      return redirect('/create')
        ->withErrors($validation)
        ->withInput()
        ->with('vehicleModels', $vehicleModels);
    }

    $serviceRequest = new ServiceRequests($input);

    $serviceRequest->save();

    return redirect('/');

  }

  public function destroy(Request $request){

    $serviceRequest = ServiceRequests::findorfail($request->request_id);

    $serviceRequest->delete();

    return redirect('/');       

  }

  public function getModels($id){

    $vehicleModels = VehicleMakes::find($id)->vehicleModels()->orderBy('title')->get();
    return $vehicleModels; 

  }

}
