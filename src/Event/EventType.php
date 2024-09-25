<?php

namespace PcbKernel\Event;

class EventType
{
    /**
     * 新用户注册
     *
     * @var string
     */
    const USER_REGISTERED = 'user_registered';

    /**
     * 销售订单已创建
     *
     * @var string
     */
    const SALES_ORDER_CREATED = 'sales_order_created';

    /**
     * 销售订单已通过审核
     *
     * @var string
     */
    const SALES_ORDER_APPROVED = 'sales_order_approved';

    /**
     * 销售订单未通过审核
     *
     * @var string
     */
    const SALES_ORDER_REJECTED = 'sales_order_rejected';

    /**
     * 生产订单已开工
     *
     * @var string
     */
    const PRODUCTION_ORDER_STARTED = 'production_order_started';

    /**
     * 生产订单已完工
     *
     * @var string
     */
    const PRODUCTION_ORDER_COMPLETED = 'production_order_completed';

    /**
     * 销售订单已发货
     *
     * @var string
     */
    const SALES_ORDER_SHIPPED = 'sales_order_shipped';

    /**
     * 客供料已入库
     *
     * @var string
     */
    const CUSTOMER_MATERIAL_RECEIVED = 'customer_material_received';
}
