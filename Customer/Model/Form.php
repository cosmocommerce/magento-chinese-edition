<?php
class CosmoCommerce_Customer_Model_Form extends Mage_Customer_Model_Form
{
    
    public function extractData(Zend_Controller_Request_Http $request, $scope = null, $scopeOnly = true)
    {
        if($postdata=$request->getPost()){
        print_r($postdata);exit();
            if(isset($postdata['fullname'])){
                $fullname=$postdata['fullname'];
                if($fullname){
                    $lastname=mb_substr($fullname,0,1,"UTF-8");
                    $firstname=mb_substr($fullname,1,mb_strlen($fullname)-1,"UTF-8");
                    $request->setParam('firstname',$firstname);
                    $request->setParam('lastname',$lastname);
                }
            }else{
            
            }
        }
        $data = array();
        foreach ($this->getAttributes() as $attribute) { 
            if ($this->_isAttributeOmitted($attribute)) {
                continue;
            }
            $dataModel = $this->_getAttributeDataModel($attribute);
            $dataModel->setRequestScope($scope);
            $dataModel->setRequestScopeOnly($scopeOnly);
            $data[$attribute->getAttributeCode()] = $dataModel->extractValue($request);
        }
        return $data;
    }
}
