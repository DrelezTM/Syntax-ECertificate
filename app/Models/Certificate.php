<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_id',
        'student_nis',
        'title',
        'description',
        'organizer',
        'filename',
        'date',
    ];

    public $timestamps = false;

    public function student() {
        return $this->belongsTo(Student::class, 'student_nis', 'nis');
    }


}
