<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendar_id',
        'document_path',
        'created_by',
    ];

    public function calendar()
    {
        return $this->belongsTo(PublicationCalendar::class, 'calendar_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}