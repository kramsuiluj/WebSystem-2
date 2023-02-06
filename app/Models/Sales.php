<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $casts = ['date' => 'datetime:Y-m-d H:00'];
    protected $dates = ['date'];


    public function scopeFilter($query, array $filters) {
        $query->when($filters['date'] ?? false, function ($query, $date) {
            $query->where('date', '=', $date);
        }
        );

        $query->when($filters['from'] ?? false, function ($query, $from) {
            $query->when($filters['to'] ?? false, function ($query, $to) use ($from) {
                $query->whereBetween('date', [$from, $to]);
            });
        }
        );

        $query->when($filters['year'] ?? false, function ($query, $year) {
            $query->when($filters['month'] ?? false, function ($query, $month) use ($year) {
                $query->whereYear('date', '=', $year)
                    ->whereMonth('date', '=', $month);
            });
        }
        );

        $query->when($filters['search'] ?? false, function ($query, $search) {
                $query->where(
                    function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('products', 'like', '%' . $search . '%')
                            ->orWhere('invoiceNo', 'like', '%' . $search . '%');
                    }
                );
            }
        );

    }

}
