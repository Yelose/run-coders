<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cronologia extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'cronologias';

    protected $fillable = ['fecha','titulo','texto'];
	
}
