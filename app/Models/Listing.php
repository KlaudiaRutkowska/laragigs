<?php

namespace App\Models;

use App\Filters\ListingFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;


class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'email',
        'website',
        'logo',
        'description',
    ];

    public function tags(): BelongsToMany {
        return $this->BelongsToMany(Tag::class, 'listing_tag');
    }

    public function user(): BelongsTo {
        return  $this->belongsTo(User::class);
    }

    public function isOwner(): bool
    {
        return $this->user->id === auth()->id();
    }

    /**
     * @param Builder $builder
     * @param $request
     * @return Builder
     */
    public function scopeFilter(Builder $builder, $request)
    {
        return (new ListingFilter($request))->filter($builder);
    }

    // public function scopeFilter($query, array $filters) {
    //     if($filters['tag'] ?? false) {
    //         $query->where('tags', 'like', '%' . request('tag') . '%');
    //     }
    // }
}
