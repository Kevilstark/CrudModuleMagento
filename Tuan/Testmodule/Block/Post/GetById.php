<?php
namespace Tuan\Testmodule\Block\Post;

class GetById extends \Magento\Framework\View\Element\Template
{
    /**
     * @param Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var \Tuan\Testmodule\Model\PostRepository
     */
    private $postRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Tuan\Testmodule\Model\PostRepository $postRepository,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->postRepository = $postRepository;
        parent::__construct($context, $data);
    }
    public function getTuanDataId(){
        $id = $this->coreRegistry->registry('editRecordId');
        if($id) return $this->postRepository->getPostId($id);
        else return $this->postRepository->getPostModel();    
    }
}
