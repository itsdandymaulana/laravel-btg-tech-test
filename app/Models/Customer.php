<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nationality;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'customers';

    protected $primaryKey = 'cst_id';

    protected $fillable = [
        'nationality_id',
        'cst_name',
        'cst_dob',
        'cst_phoneNum',
        'cst_email'
    ];

    public function nationality() {
        return $this->hasOne(Nationality::class, 'nationality_id', 'nationality_id');
    }
}
