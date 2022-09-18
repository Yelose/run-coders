<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'enlaces';

    protected $fillable = ['imagen','enlace'];
	
}