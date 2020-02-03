# laravel-calculator

`laravel-calculator-discount` 是一个简单优惠计算的包

# 安装

`composer create-project zgldh/scaffold your-project-dir`


# 开始使用

##### 执行命令

*  php artisan vendor:publish --force --provider="Eric\LaravelCalculatorDiscount\RenLaravelCalculatorServiceProvider" 

将创建一下目录和文件

##### 模型文件
* `app/Models/Discount.php`
* `app/Models/DiscountAction.php`
* `app/Models/DiscountRule.php`

这三个模型代表优惠的三个表，`Discount`代表的优惠活动表，`DiscountRule`代表优惠活动的条件表并和优惠活动表一对一关系 `DiscountAction`代表优惠活动的结果表并和优惠活动表一对一关系

`DiscountRule`表的根据 `type`字段不同分3中类型 
* contains_product 制定固定产品 
* contains_category  商品类型 
* item_total 满减或者满 打折 

`configuration` 根据类型不同存储格式不同


| 类型 | 内容（json） |  备注  |
| --- | --- | --- |
| contains_product | {"product":"1,2,3,4"}|  固定产品ID合集  |
| contains_category | {"category":1,2,3,4"} |  固定产品类型ID合集   |
| item_total | {"amount":12800} |  满多少钱 减钱  或者  满多少钱打折 |

`DiscountAction`表的根据 `type`字段不同分3中类型 
* order_total 满减的金额 
* order_ratio  打折 
* order_reduce 立减

`configuration` 根据类型不同存储格式不同


| 类型 | 内容（json） |  备注  |
| --- | --- | --- |
| order_total | {"amount": 50}|  减去固定金额  |
| order_ratio | {"ratio":80"} |  打折 比如打八折 就 80   |
| order_reduce | {"amount":800} |  立减 直接减去 |

##### 配置文件
* `config/laravel-calculator.php`
##### 数据库迁移文件
* `database/migrations/2019_01_15_081654_create_discount_table.php`
* `database/migrations/2020_01_15_081706_create_discount_action_table.php`
* `database/migrations/2019_01_15_081713_create_discount_rule_table.php`

#### 配置文件说明

`config/laravel-calculator.php`
```php
 [
    'status_verify'         => false,//是否对优惠的状态验证
    'time_verify'         => false,//是否对优惠的开始时间和结束时间验证
    /**
     * 对应的数据模型
     **/
    'discount_model'        => App\Discount::class,
    'discount_action_model' => App\DiscountAction::class,
    'discount_rule_model'   => App\DiscountRule::class,
];
```

