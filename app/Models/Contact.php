<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'phone',
        'email',
        'birthday',
        'photo'
    ];

    public function getPhoneAttribute($value)
    {
        // Formatea el número de teléfono para mostrarlo con espacios cada 2-3 dígitos
        $cleanedPhone = $value;
        if (str_starts_with($cleanedPhone, '+')) {
            $formatedPhone = preg_replace('/^\+(\d{1,3})(\d+)$/', '(+$1)$2', $cleanedPhone);
            return $formatedPhone ?: $cleanedPhone;
        }
        return $value;
    }
}
