<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $jabatan_id
 * @property string $jabatan_nama
 * @property string $create_at
 * @property string $update_at
 * @property Karyawan[] $karyawans
 */
class Jabatan extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'jabatan';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'jabatan_id';

    /**
     * @var array
     */
    protected $fillable = ['jabatan_nama', 'create_at', 'update_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function karyawans()
    {
        return $this->hasMany('App\Models\Karyawan', 'karyawan_jab_id', 'jabatan_id');
    }
}
