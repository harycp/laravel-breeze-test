<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'clock_in',
        'clock_out',
        'status',
        'alasan',
        'user_id',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($attendance) {
            if ($attendance->status === 'Hadir' && is_null($attendance->alasan)) {
                $attendance->alasan = '-';
            }
        });
    }

}
