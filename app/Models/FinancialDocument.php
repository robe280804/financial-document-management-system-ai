<?php

namespace App\Models;

use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Decimal;
use Carbon\CarbonInterface;
use App\Enums\FlowType;
use App\Enums\DocumentStatus;

/**
 * @property-read bigInteger $id
 * @property-read FlowType $flow_type
 * @property-read mixed $name
 * @property-read string|null $counterparty
 * @property-read decimal $amount
 * @property-read string $currency
 * @property-read CarbonInterface $issue_date
 * @property-read CarbonInterface|null $due_date
 * @property-read DocumentStatus $status
 * @property-read BigInteger $user_id
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
class FinancialDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'flow_type',
        'name',
        'counterparty',
        'amount',
        'currency',
        'issue_date',
        'due_date',
        'status',
        'user_id'
    ];

    protected $casts = [
        'flow_type' => FlowType::class,
        'status'    => DocumentStatus::class,
        'issue_date' => 'date',
        'due_date'  => 'date',
        'amount'    => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
