<?php

namespace Modules\Contact\app\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class ContactReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'contact_id',
        'user_id',
    ];

    protected $casts = [
        'message' => 'array'
    ];

    public function contact() : BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
    
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
