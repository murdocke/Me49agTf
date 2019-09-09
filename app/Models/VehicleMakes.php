<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class VehicleMakes extends Model {
  protected $guarded = ['id'];

  public function vehicleModels(){
    return $this->hasMany('App\Models\VehicleModels', 'vehicle_make_id');
  }

}
