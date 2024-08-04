<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'party',
        'region_id',
        'short_bio',
        'full_bio',
        'image_url',
        'election_date',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    protected $casts = [
        'election_date' => 'date',
    ];

    public function getShortDescriptionAttribute()
    {
        return substr($this->short_bio, 0, 100) . '...';
    }

    public function scopeUpcoming($query)
    {
        return $query->where('election_date', '>', now());
    }

    public function scopeByRegion($query, $region)
    {
        return $query->where('region_id', $region);
    }
}
