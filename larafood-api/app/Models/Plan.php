<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'url', 'description', 'price'];

  public function search($filter = null)
  {
    $results = $this->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();
        
    return $results;
  }

  // relacionamento um para muitos
  public function details()
  {
    return $this->hasMany(DetailPlan::class);
  }

  // relacionamento um para muitos
  public function profiles()
  {
    return $this->belongsToMany(Profile::class);
  }

  // Profiles not linked with this plan
  public function profilesAvailable($filter = null)
  {
    $profiles = Profile::whereNotIn('profiles.id', function($query) {
                                            $query->select('plan_profile.profile_id');
                                            $query->from('plan_profile');
                                            $query->whereRaw("plan_profile.plan_id = {$this->id}");
                                          })
                                          ->where(function($queryFilter) use ($filter) {
                                            if($filter)
                                              $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
                                          })
                                          ->paginate();

    return $profiles;
  }
}
