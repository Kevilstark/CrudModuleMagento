<?php
use Magento\Framework\App\PageCache\Version;

namespace Tuan\Testmodule\Controller\Post;

class Save extends \Magento\Framework\App\Action\Action implements \Magento\Framework\App\Action\HttpGetActionInterface, \Magento\Framework\App\Action\HttpPostActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\Controller\ResultInterface
     */
    protected $resultFactory;

    /**
     * @var \Tuan\Testmodule\Model\PostRepository
     */
    private $postRepository;

    /**
     * @var \Tuan\Testmodule\Model\PostFactory
     */
    private $postModel;

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
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Tuan\Testmodule\Model\PostRepository $postRepository,
        \Tuan\Testmodule\Model\PostFactory $postModel,
        \Magento\Framework\Message\ManagerInterface $_messageManager
    ) {
        $this->_pageFactory = $pageFactory;
        $this->resultFactory = $resultFactory;
        $this->postRepository = $postRepository;
        $this->postModel = $postModel;
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
        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();
            $model = $this->postModel->create();

            // edit
            if ($input['Id']) {
                $post = $this->postRepository->getPostId($input['Id']);
                $input = $model->changeKey($input,'Id','test1','test2' );
                $post->addData($input);
                $this->_messageManager->addSuccessMessage('Edit Success');
            }
            // add new 
            else {
                $post = $model;     
                $input = $model->changeKeyNoId($input,'test1','test2' );
                $post->setData($input);
                $this->_messageManager->addSuccessMessage('Add Success');
            }
            $this->postRepository->savePost($post);
            $this->postRepository->flushCache();   
            $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('tuan/post/index');
            return $resultRedirect;
        }else {
            $this->_messageManager->addErrorMessage('Input not found');
            $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('tuan/post/index');
            return $resultRedirect;
        }
    }
}
