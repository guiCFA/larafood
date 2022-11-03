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
}
