<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    protected $fillable =  ['nama', 'email', 'whatsapp', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
    // mematikan created_at dan updated_at
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }
    public $timestamps = false;
}
