<?php
namespace Tuan\Testmodule\Api;

interface PostInterface
{
    const CACHE_TAG = 'tuan_testmodule_post';
    const TUANID = 'tuan_id';
    const TUANCOL1 = 'test1';
    const TUANCOL2 = 'test2';
    /**
     * Undocumented function
     *
     * @param [type] $param
     * @return string
     */
    public function getTuanId();
    public function setTuanId($id);

    public function getCol1();
    public function setCol1($col1);

    public function getCol2();
    public function setCol2($col2);

    public function changeKey($arr = [], $id = '', $col1 = '', $col2 = '');
    public function changeKeyNoId($arr = [], $col1 = '', $col2 = '');

}
