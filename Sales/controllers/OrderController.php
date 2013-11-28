<?php
require_once 'Mage/Sales/controllers/OrderController.php';
class CosmoCommerce_Sales_OrderController extends Mage_Sales_OrderController
{
    public function repayAction()
    {
        
        if (!$this->_loadValidOrder()) {
            return;
        }
        $order = Mage::registry('current_order');
        
        
        if($order->getPayment()->getMethod()=="alipay_payment"){
            if( $order->getState() == "new"){
                $order->addStatusToHistory(
                $order->getStatus(),
                Mage::helper('alipay')->__('Customer try to repay the order')
                );
                $order->save();
                $this->_redirect('alipay/payment/pay',array('order_id'=>$order->getId()));
                return;
            }else{
                $this->_forward('noRoute');
                return false;
            }
        }else{
            $this->_forward('noRoute');
            return false;
        }
        
    }

}
