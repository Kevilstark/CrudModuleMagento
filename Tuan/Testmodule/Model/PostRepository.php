<?php
namespace Tuan\Testmodule\Model;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Repository for post.
 *
 */
class PostRepository implements \Tuan\Testmodule\Api\PostRepositoryInterface
{

    /**
     * @var \Tuan\Testmodule\Model\PostFactory
     */
    private $postModel;

    /**
     * @var \Tuan\Testmodule\Model\ResourceModel\Post\CollectionFactory
     */
    private $collectionModel;

    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    private $cacheTypeList;

    /**
     * @var \Magento\Framework\App\Cache\Frontend\Pool
     */
    private $cacheFrontendPool;

    /**
     * @var \Tuan\Testmodule\Model\ResourceModel\Post
     */
    private $postResource;

    /**
     * @param
     */
    public function __construct(
        \Tuan\Testmodule\Model\PostFactory $postModel,
        \Tuan\Testmodule\Model\ResourceModel\Post\CollectionFactory $collectionModel,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Tuan\Testmodule\Model\ResourceModel\Post $postResource
    ) {
        $this->postModel = $postModel;
        $this->collectionModel = $collectionModel;
        $this->cacheTypeList = $cacheTypeList;
        $this->cacheFrontendPool = $cacheFrontendPool;
        $this->postResource = $postResource;
    }

    /**
     * @inheritdoc
     */
    public function getPostModel()
    {
        return $this->postModel->create();
    }

    /**
     * @inheritdoc
     */
    public function getPostId(int $id)
    {
        $post = $this->postModel->create();
        $this->postResource->load($post, $id);
        return $post;
    }

    /**
     * @inheritdoc
     */
    public function getListPost()
    {
        return $this->collectionModel->create();
    }

    /**
     * Save post data
     *
     * @param \Tuan\Testmodule\Api\PostInterface $post
     * @return Post
     * @throws CouldNotSaveException
     */
    public function savePost(\Tuan\Testmodule\Api\PostInterface $post)
    {
        try {
            $this->postResource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $post;
    }

    /**
     * Delete post
     *
     * @param \Tuan\Testmodule\Api\PostInterface $post
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(\Tuan\Testmodule\Api\PostInterface $post)
    {
        try {
            $this->postResource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function deletePost(int $id)
    {
        $result = $this->delete($this->getPostId($id));
    }

    public function flushCache()
    {
        $_types = [
                    'config',
                    'layout',
                    'block_html',
                    'collections',
                    'reflection',
                    'db_ddl',
                    'eav',
                    'config_integration',
                    'config_integration_api',
                    'full_page',
                    'translate',
                    'config_webservice'
                    ];
        
        foreach ($_types as $type) {
            $this->cacheTypeList->cleanType($type);
        }
        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }
    
}
