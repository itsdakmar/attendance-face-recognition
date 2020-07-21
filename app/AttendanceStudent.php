<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $student_id
 * @property integer $class_id
 * @property string $created_at
 * @property string $updated_at
 * @property Subject $subject
 * @property User $user
 */
class AttendanceStudent extends Model
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
    protected $fillable = ['student_id', 'is_attend', 'class_id', 'created_at', 'updated_at'];

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function subject()
//    {
//        return $this->belongsTo('App\Subject', 'class_id');
//    }

    public function attendance()
    {
        return $this->belongsTo('App\Attendance', 'class_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'student_id');
    }

    public function getIsAttendAttribute($value){
        return ($value == 0) ? 'Not Attend' : 'Attend';
    }
}
