<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $table = 'discount';
    public $guarded  = [
    ];
    /**
     * 活动动作表
     */
    public function discount_action()
    {
        return $this->hasOne(config('laravel-calculator-discount.discount_action_model'), "discount_id", "id");
    }
    public function discount_rules()
    {
        return $this->hasOne(config('laravel-calculator-discount.discount_rule_model'), "discount_id", "id");
    }
}
