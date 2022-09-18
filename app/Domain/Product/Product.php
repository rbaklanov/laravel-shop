<?php

namespace App\Domain\Product;

use App\Domain\Filter\Filter;
use App\Domain\Inventory\Projections\Inventory;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'manages_inventory' => 'boolean',
    ];

    protected ?string $morphClass = null;

    protected static function newFactory(): ProductFactory
    {
        return new ProductFactory();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getItemPrice(): Price
    {
        return new Price($this->item_price, $this->vat_percentage);
    }

    public function managesInventory(): bool
    {
        return $this->manages_inventory ?? false;
    }

    public function inventory(): HasOne
    {
        return $this->hasOne(Inventory::class);
    }

    public function hasAvailableInventory(int $requestedAmount): bool
    {
        return $this->inventory->amount >= $requestedAmount;
    }

    /**
     * @return string
     */
    public function getMorphClass()
    {
        return $this->morphClass ?: self::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function cities(): MorphMany
    {
        $this->morphClass = 'App/Domain/City';

        return $this->morphMany(Filter::class, 'filterable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function categories(): MorphMany
    {
        $this->morphClass = 'App/Domain/Category';

        return $this->morphMany(Filter::class, 'filterable');
    }
}
