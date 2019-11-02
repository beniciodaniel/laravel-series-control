<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        //user_id do usuario autenticado p/ cada serie ter seu proprio usuario
      'nome', 'user_id'
    ];

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

}
