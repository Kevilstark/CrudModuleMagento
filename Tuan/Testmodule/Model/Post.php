<?php

namespace Tuan\Testmodule\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Tuan\Testmodule\Api\PostInterface, \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * Model cache tag for clear cache in after save and after delete
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'post';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tuan\Testmodule\Model\ResourceModel\Post');
    }

    /**
     * Return a unique id for the model.
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getTuanId()
    {
        return parent::getData(self::TUANID);
    }
    public function setTuanId($id)
    {
        return parent::setData(self::TUANID, $id);
    }

    public function getCol1()
    {
        return parent::getData(self::TUANCOL1);
    }
    public function setCol1($col1)
    {
        return parent::setData(self::TUANCOL1, $col1);
    }

    public function getCol2()
    {
        return parent::getData(self::TUANCOL2);
    }
    public function setCol2($col2)
    {
        return parent::setData(self::TUANCOL2, $col2);
    }
    public function changeKey($arr = [], $id = '', $col1 = '', $col2 = '')
    {
        if(self::TUANID != $id) {
            $arr[self::TUANID] = $arr[$id];
            unset($arr[$id]);
        }
        
        if(self::TUANCOL1 != $col1) {
            $arr[self::TUANCOL1] = $arr[$col1];
            unset($arr[$col1]);
        }
        
        if(self::TUANCOL2 != $col2) {
            $arr[self::TUANCOL2] = $arr[$col2];
            unset($arr[$col2]);
        }
        return $arr;
    }
    public function changeKeyNoId($arr = [], $col1 = '', $col2 = '')
    {      
        if(self::TUANCOL1 != $col1) {
            $arr[self::TUANCOL1] = $arr[$col1];
            unset($arr[$col1]);
        }
        
        if(self::TUANCOL2 != $col2) {
            $arr[self::TUANCOL2] = $arr[$col2];
            unset($arr[$col2]);
        }
        return $arr;
    }
}
