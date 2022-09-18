<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonio extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'testimonios';

    protected $fillable = ['nombre','testimonio'];
	
}
