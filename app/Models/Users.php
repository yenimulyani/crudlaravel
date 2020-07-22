<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property string $create_at
 * @property string $update_at
 * @property Karyawan $karyawan
 */
class Users extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var array
     */
    protected $fillable = ['username', 'password', 'remember_token', 'create_at', 'update_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan', 'user_id', 'karyawan_user_id');
    }
}
