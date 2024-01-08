<?php

namespace Modules\Contact\app\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'completed',
        'completed_id',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_id');
    }
}
