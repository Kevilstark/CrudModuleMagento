<?php
namespace Tuan\Testmodule\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'tuan_id';
    protected $_eventPrefix = 'tuan_testmodule_post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tuan\Testmodule\Model\Post', 'Tuan\Testmodule\Model\ResourceModel\Post');
    }
}
