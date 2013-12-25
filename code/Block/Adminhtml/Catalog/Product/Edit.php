<?php
class CosmoCommerce_ChineseLocale_Block_Adminhtml_Catalog_Product_Edit extends Mage_Adminhtml_Block_Catalog_Product_Edit
{

    protected function _prepareLayout()
    {
        if ($this->getProduct()->getId() ) {
            $product=Mage::getModel('catalog/product')->load($this->getProduct()->getId());
            $url = Mage::getUrl($product->getUrlPath());

            $this->setChild('preview_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Preview'),
                        'onclick'   => 'popWin(\''.$url.'\', \'_blank\')',
                        'class'     => 'add-widget'
                    ))
            );
        }

        return parent::_prepareLayout();
    }
    public function getPreviewButtonHtml()
    {
        return $this->getChildHtml('preview_button');
    }
}
