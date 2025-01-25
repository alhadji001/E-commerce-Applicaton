<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\phone
 *
 * @property int $id
 * @property string $tel
 * @property int $customer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Customer|null $customer
 * @method static \Illuminate\Database\Eloquent\Builder|phone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|phone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|phone query()
 * @method static \Illuminate\Database\Eloquent\Builder|phone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|phone whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|phone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|phone whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|phone whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class phone extends Model
{
    use HasFactory;
  
         /* Get the customer that owns the phone
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function customer()
        {
            return $this->belongsTo(Customer::class);
        }
}
