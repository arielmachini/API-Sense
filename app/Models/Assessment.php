<?php

namespace App\Models;

use App\Constants;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model {
    use HasUuids;
    
    protected $guarded = [];
    
    protected $table = Constants::TABLE_ASSESSMENT;
    protected $primaryKey = 'code';
}
