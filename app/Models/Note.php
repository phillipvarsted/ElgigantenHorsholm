<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kundeopgave;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    public function kundeopgave()
    {
        return $this->belongsTo(Kundeopgave::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
