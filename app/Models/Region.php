<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type', // 'Kota' or 'Kabupaten'
        'population',
        'area',
        'description',
    ];

    /**
     * Get the candidates for the region.
     */
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    /**
     * Get the upcoming elections for the region.
     */
    public function upcomingElections()
    {
        return $this->candidates()
            ->select('position', 'election_date')
            ->distinct()
            ->where('election_date', '>', now())
            ->orderBy('election_date');
    }

    /**
     * Scope a query to only include regions of a given type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the region's full name (type + name).
     */
    public function getFullNameAttribute()
    {
        return $this->type . ' ' . $this->name;
    }
}
