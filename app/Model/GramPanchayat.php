<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GramPanchayat extends Model
{
      protected $table='gram_panchayat';
      protected $fillable=['id'];
      public $timestamps=false;

      public function states()
      {
             return $this->hasOne('App\Model\State','id','states_id');
      }
      public function district()
      {
             return $this->hasOne('App\Model\District','id','district_id');
      }
      public function blockMCS()
      {
             return $this->hasOne('App\Model\BlocksMc','id','block_id');
      }
}
