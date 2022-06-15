<?php
namespace Tuan\Testmodule\Controller\Post;

class Edit extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @param Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->request = $request;
        $this->coreRegistry = $coreRegistry;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        //get id for block
        $id = $this->request->getParam('id');
        $this->coreRegistry->register('editRecordId', $id);
        
        // render frontend
        return $this->_pageFactory->create();
    }
}
