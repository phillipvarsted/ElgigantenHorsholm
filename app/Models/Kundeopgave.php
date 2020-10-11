<?php

namespace App\Models;

use App\Models\Note;
use App\Models\Label;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kundeopgave extends Model
{
    use HasFactory;

    protected $table = 'kundeopgaver';

    public function label()
    {
        return $this->hasOne(Label::class, 'status', 'status');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'kundeopgave_id', 'id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
