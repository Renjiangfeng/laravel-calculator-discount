<?php


namespace Eric\LaravelCalculatorDiscount;


class CalculatorDiscount
{
    protected $config;
    public function __construct(array  $config = [])
    {
        $this->config = array_merge(config('laravel-calculator-discount'),$config);
    }
    /**
     * 判断活动是否有效
     *  规则 // contains_product{"product":"1,2,3,4"}  固定产品
     *         contains_category {"category":1租赁    2充冷}  分类产品
     *         item_total{"amount":12800}  满多少钱 减钱  或者  满多少钱打折
     * @param  array $condition  订单现有的条件
     * @param  integer $discount_id  优惠的ID
     * @return bool
     */
    private function VerifyRule($condition,$discount_id){
        $eligible = false;
        $status_verify = $this->config['status_verify'];//优惠活动的状态验证
        $time_verify = $this->config['time_verify'];//优惠活动的时间验证
        $discountModel = $this->config['discount_model'];
        $discount = $discountModel::with(['discount_action','discount_rules'])->where('id',$discount_id)->first();
        if (!$discount){
            return  $eligible;
        }
        $discount = $discount->toArray();
        if ($status_verify === true && $discount['status'] == 2){
            return  $eligible;
        }
        if ($time_verify === true){
            $start = strtotime($discount['start_time']);
            $end = strtotime($discount['end_time']);
            $now = time();
            if ($now >= $start && $now <= $end){
                return  $eligible;
            }
        }
        if (!$discount['discount_rules']){
            return  $eligible;
        }
        $configuration = json_decode($discount['discount_rules']['configuration'], true);
        switch ($discount['discount_rules']['type']){
            case 'contains_product' : //选择固定商品
                $eligible = in_array($condition['product_id'],$configuration['product'])?true:false;
                break;
            case 'contains_category' ://选择固定分类
                $eligible = in_array($condition['category_id'],$configuration['category'])?true:false;
                break;
            case 'item_total' : //订单总金额
                $eligible = $condition['amount'] >= $configuration['amount']?true:false;
                break;
            default ;
        }
        return  $eligible;
    }
}
