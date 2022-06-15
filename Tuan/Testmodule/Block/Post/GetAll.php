<?php
namespace Tuan\Testmodule\Block\Post;

class GetAll extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */

    /**
     * @var \Tuan\Testmodule\Model\PostRepository
     */
    private $postRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Tuan\Testmodule\Model\PostRepository $postRepository,
        array $data = []
    ) {
        $this->postRepository = $postRepository;
        return parent::__construct($context, $data);
    }
    public function getTuanData(){
        return $this->postRepository->getListPost();
    }
}