<?php

namespace App\Models;

use App\Models\Ticket;
use App\Models\Kundeopgave;
use App\Models\ExternalService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Label extends Model
{
    use HasFactory;

    protected $table = 'labels';

    public function kundeopgaver()
    {
        return $this->belongsToMany(Kundeopgave::class, 'status', 'status');
    }

    public function externalServices()
    {
        return $this->belongsToMany(ExternalService::class, 'status', 'status');
    }

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'status', 'status');
    }
}
