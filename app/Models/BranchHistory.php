<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function branch()
    {
        return $this->belongsTo(Branch::class)->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
