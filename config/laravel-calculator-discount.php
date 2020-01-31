<?php
return [
    'status_verify'         => false,//是否对优惠的状态验证
    'time_verify'         => false,//是否对优惠的开始时间和结束时间验证
    /**
     * 对应的数据模型类
     **/
    'discount_model'        => App\Discount::class,
    'discount_action_model' => App\DiscountAction::class,
    'discount_rule_model'   => App\DiscountRule::class,
];
