@extends('layouts.main')
@section('content')
  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Edit a New Service Request</h1>
        </div>
      </div>
    </div>
  </header>

  @if (count($errors) > 0)
<div class="container">
  <div class="alert alert-danger alert-important">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
</div>
@endif

  <!-- New Ticket Form -->
  <section class="bg-light mt-5">
    <div class="container">
      <form method="post" action="{{route('doEdit') }}">
        @csrf

        <div class="row">

          <div class="col-md-6">

            <div class="card h-100">
              <div class="card-body">

                <div class="form-group {{ $errors->has('vehicle_make_id') ? 'has-error' :'' }}">
                  <label for="vehicle-makes">Select Make</label>
                  <select name="vehicle_make_id" class="form-control" id="vehicle-makes">
                    @foreach($vehicleMakes AS $vehicleMake)
                      <option value="{{ $vehicleMake->id}}"
                      @if ($currentVehicleMake == $vehicleMake->id)
                        selected = "selected";
                      @endif
                       >{{ $vehicleMake->title }}</option>
                    @endforeach
                  </select> 
                </div>

                <div class="form-group">
                  <label for="vehicle-models">Select Model</label>
                  <select name="vehicle_model_id" class="form-control" id="vehicle-models">
                    @foreach($currentVehicleModels AS $currentVehicleModel)
                    <option value="{{$currentVehicleModel->id}}"
                      @if ($serviceRequest->vehicle_model_id == $currentVehicleModel->id)
                        selected = "selected";
                      @endif
                       >{{$currentVehicleModel->title}}</option>
                    @endforeach
                  </select>
                </div>

              </div>
            </div>

          </div>

          <div class="col-md-6">

            <div class="card">
              <div class="card-body">

                <div class="form-group {{ $errors->has('client_name') ? 'has-error' :'' }}">
                  <label for="name">Name</label>
                  <input type="text" name="client_name" class="form-control" id="name" placeholder="Enter name" value="{{ $serviceRequest->client_name }}">
                </div>

                <div class="form-group {{ $errors->has('client_phone') ? 'has-error' :'' }}">
                  <label for="phone">Phone</label>
                  <input type="tel" name="client_phone" class="form-control" id="phone" placeholder="Enter phone" value="{{ $serviceRequest->client_phone }}">
                </div>

                <div class="form-group {{ $errors->has('client_email') ? 'has-error' :'' }}">
                  <label for="email">Email address</label>
                  <input type="email" name="client_email" class="form-control" id="email" placeholder="Enter email" value="{{ $serviceRequest->client_email }}">
                </div>

              </div>
            </div>

          </div>

          <div class="col-12">
            <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
             <label for="description">Description</label>
             <textarea name="description" class="form-control" id="description" rows="3">{{ $serviceRequest->description }}</textarea>
            </div> 
          </div>           

          <div class="col-12 text-center mt-5">
            <input type="hidden" name="request_id" value="{{ $serviceRequest->id }}" />
            <button type="submit" class="btn btn-primary btn-block" />Update</button>
          </div>

        </div>

      </form>

      <form method="POST" action="{{route('doDelete') }}">
        {{ method_field('DELETE')}}
        @csrf
        <div class="row">
          <div class="col-12 text-center mt-5">
            <input type="hidden" name="request_id" value="{{ $serviceRequest->id }}" />
            <button type="submit" class="btn btn-danger btn-block" />Delete</button>
          </div>
        </div>
      </form>

    </div>
  </section>

@endsection