<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    protected $fillable = ['nama_kategori_klinis'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function hewan()
    {
        return $this->hasMany(Hewan::class, 'idkategori_klinis');
    }
    // mematikan created_at dan updated_at
    public $timestamps = false;
}
