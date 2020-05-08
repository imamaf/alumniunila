<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_Attribut extends Model
{
    //
    protected $table = 'users_attributs';
    protected $fillable = ['nama', 'tempat_lahir', 'status' ,'no_hp' ,'tgl_lahir', 'alamat' , 'jurusan_prodi' , 'th_masuk' , 'th_lulus' , 'tempat_bekerja' , 'waktu_lulus_bekerja' , 'path_foto'];
<<<<<<< HEAD

=======
    public $incrementing = false;
>>>>>>> 80a134672e5cff95b5e9e65f1b34af8596066dfe
}
