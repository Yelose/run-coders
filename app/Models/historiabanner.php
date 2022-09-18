<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historiabanner extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'historiabanners';

    protected $fillable = ['imagen','descripcion','origen'];
	
}
