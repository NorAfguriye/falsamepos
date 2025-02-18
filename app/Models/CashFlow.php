<?php
namespace App\Models;

use App\Casts\CurrencyCast;
use App\Casts\DateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashFlow extends NsModel
{
    use HasFactory;
    
    protected $table    =   'nexopos_' . 'cash_flow';

    public $casts    =   [
        'created_at'    =>  DateCast::class
    ];

    const STATUS_ACTIVE     =   'active';
    const STATUS_DELETING   =   'deleting';

    const OPERATION_DEBIT   =   'debit';
    const OPERATION_CREDIT  =   'credit';

    public function expense()
    {
        return $this->belongsTo( Expense::class, 'expense_id' );
    }

    public function scopeFrom( $query, $date )
    {
        return $query->where( 'created_at', '>=', $date );
    }

    public function scopeOperation( $query, $operation )
    {
        return $query->where( 'operation', $operation );
    }

    public function scopeTo( $query, $date )
    {
        return $query->where( 'created_at', '<=', $date );
    }
}