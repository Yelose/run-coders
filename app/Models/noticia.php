<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'noticias';

    protected $fillable = ['titular','imagen','subtitulo','noticia','fecha'];
	
}
