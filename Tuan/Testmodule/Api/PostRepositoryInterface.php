<?php
namespace Tuan\Testmodule\Api;

interface PostRepositoryInterface
{
    public function getPostId(int $id);
    public function getListPost();
    public function savePost(PostInterface $block);
    public function deletePost(int $id);
}
