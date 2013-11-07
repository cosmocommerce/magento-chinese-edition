Magento Chinese Edition 中文解决方案
=======================

Magento Integrated with Payment Gateways,Shipping Carriers,Language Package and Shopping Experience in Chinese way

1 支付接口：
Alipay, 99Bill, Union Pay

2 Shiping Carriers:
顺丰，宅急送

3 语言包：
暂时使用官方语言包（如果需要授权，请联系我们去除语言包）


本项目开源协议为 OSL3.0 可以放心的用于企业自主项目，如果开发商和集成商需要请保留项目版权信息。


安装方法：

1 bash < <(wget -O - https://raw.github.com/colinmollenhour/modman/master/modman-installer)

2 source ~/.profile

3 进入项目根目录（包含index.php的这一层），运行 modman init

4  modman clone https://github.com/cosmocommerce/magento-chinese-edition

完成安装


注意事项：

安装本模块会对清空原有中文翻译文件，我们希望把所有中文翻译都统一在本模块内，如果您有原来的翻译文件。请备份locale\zh_CN文件夹，安装或更新本模块以后再放回。