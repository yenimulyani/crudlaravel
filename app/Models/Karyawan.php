<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $karyawan_id
 * @property int $karyawan_jab_id
 * @property int $karyawan_user_id
 * @property string $karyawan_nama
 * @property string $karyawan_alamat
 * @property string $karyawan_image
 * @property string $karyawan_gender
 * @property string $create_at
 * @property string $update_at
 * @property int $status
 * @property Jabatan $jabatan
 * @property User $user
 */
class Karyawan extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'karyawan';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'karyawan_id';

    /**
     * @var array
     */
    protected $fillable = ['karyawan_jab_id', 'karyawan_user_id', 'karyawan_nama', 'karyawan_alamat', 'karyawan_image', 'karyawan_gender', 'create_at', 'update_at', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan', 'karyawan_jab_id', 'jabatan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', null, 'karyawan_user_id');
    }
}
