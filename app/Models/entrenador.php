<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenador extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'entrenadors';

    protected $fillable = ['imagen','nombre','descripcion'];
	
}
