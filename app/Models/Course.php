<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'teacher_id',
    ];

    public function teacher() :BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function students() :BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id');
    }
}
