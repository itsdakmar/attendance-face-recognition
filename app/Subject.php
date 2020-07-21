<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $lecturer_id
 * @property string $name
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property SubjectStudent[] $subjectStudents
 */
class Subject extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['lecturer_id', 'name', 'code', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'lecturer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjectStudents()
    {
        return $this->hasMany('App\SubjectStudent');
    }
}
