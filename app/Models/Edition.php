<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edition extends Model
{
    protected $fillable = [
        'subtitle',
        'description',
        'price',
        'edition_no',
        'users_limit',
        'users_count',
        'start_date',
        'end_date',
        'course_id',
    ];

    public static function simpleDataArray($data, $newEditionNo){
        return [
            'subtitle' => $data->subtitle,
            'description' => $data->description,
            'price' => $data->price,
            'users_limit' => $data->users_limit,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
            'edition_no' => $newEditionNo
        ];
    }

    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}