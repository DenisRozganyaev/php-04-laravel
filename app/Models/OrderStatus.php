<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\OrderStatus
 *
 * @property int $id
 * @property \App\Enums\OrderStatus $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @method static Builder|OrderStatus canceled()
 * @method static Builder|OrderStatus completed()
 * @method static Builder|OrderStatus default()
 * @method static Builder|OrderStatus newModelQuery()
 * @method static Builder|OrderStatus newQuery()
 * @method static Builder|OrderStatus paid()
 * @method static Builder|OrderStatus query()
 * @method static Builder|OrderStatus whereCreatedAt($value)
 * @method static Builder|OrderStatus whereId($value)
 * @method static Builder|OrderStatus whereName($value)
 * @method static Builder|OrderStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [
        'name' => \App\Enums\OrderStatus::class
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $this->statusQuery($query, \App\Enums\OrderStatus::InProcess);
    }

    public function scopePaid(Builder $query): Builder
    {
        return $this->statusQuery($query, \App\Enums\OrderStatus::Paid);
    }

    public function scopeCanceled(Builder $query): Builder
    {
        return $this->statusQuery($query, \App\Enums\OrderStatus::Canceled);
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $this->statusQuery($query, \App\Enums\OrderStatus::Completed);
    }

    protected function statusQuery(Builder $query, \App\Enums\OrderStatus $enum): Builder
    {
        return $query->where('name', $enum->value);
    }
}
