<?php
require_once 'Mage/Sales/controllers/OrderController.php';
class CosmoCommerce_Sales_OrderController extends Mage_Sales_OrderController
{
    public function repayAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

}
