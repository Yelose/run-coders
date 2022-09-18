<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atleta extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'atletas';

    protected $fillable = ['nombre','apellidos','licencia'];
	
}
