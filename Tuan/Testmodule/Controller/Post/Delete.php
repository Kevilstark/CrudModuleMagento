<?php
namespace Tuan\Testmodule\Controller\Post;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * @var \Tuan\Testmodule\Model\PostRepository
     */
    private $postRepository;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $_messageManager;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Tuan\Testmodule\Model\PostRepository $postRepository,
        \Magento\Framework\Message\ManagerInterface $_messageManager
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->request = $request;
        $this->postRepository = $postRepository;
        $this->_messageManager = $_messageManager;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->request->getParam('id');
        $this->postRepository->deletePost($id);
        $this->_messageManager->addSuccessMessage('Delete Success');
        $this->postRepository->flushCache();
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('tuan/post/index');
        return $resultRedirect;
    }
}
