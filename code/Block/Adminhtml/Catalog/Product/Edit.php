<?php
class CosmoCommerce_ChineseLocale_Block_Adminhtml_Catalog_Product_Edit extends Mage_Adminhtml_Block_Catalog_Product_Edit
{

    protected function _prepareLayout()
    {
        if ($this->getProduct()->getId() ) {
            $this->setChild('preview_button',
                $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Preview'),
                        'onclick'   => 'popWin(\''.$this->getProduct()->getProductUrl().'\', \'_blank\')',
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
