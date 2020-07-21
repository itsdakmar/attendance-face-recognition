<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $subject_id
 * @property integer $status
 * @property string $class_date
 * @property string $created_at
 * @property string $updated_at
 * @property Subject $subject
 */
class Attendance extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    protected $dates = ['class_date'];
    /**
     * @var array
     */
    protected $fillable = ['subject_id', 'status', 'class_date', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\AttendanceStudent', 'class_id');
    }
}
