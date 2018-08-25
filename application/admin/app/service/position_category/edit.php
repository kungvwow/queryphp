<?php

declare(strict_types=1);

/*
 * This file is part of the forcodepoem package.
 *
 * The PHP Application Created By Code Poem. <Query Yet Simple>
 * (c) 2018-2099 http://forcodepoem.com All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace admin\app\service\structure;

use admin\is\repository\admin_structure as repository;
use common\is\tree\tree;

/**
 * 后台部门编辑.
 *
 * @author Name Your <your@mail.com>
 *
 * @since 2017.10.23
 *
 * @version 1.0
 */
class edit
{
    /**
     * 后台部门仓储.
     *
     * @var \admin\is\repository\admin_structure
     */
    protected $oRepository;

    /**
     * 父级部门.
     *
     * @var int
     */
    protected $intParentId;

    /**
     * 构造函数.
     *
     * @param \admin\is\repository\admin_structure $oRepository
     */
    public function __construct(repository $oRepository)
    {
        $this->oRepository = $oRepository;
    }

    /**
     * 响应方法.
     *
     * @param int $intId
     *
     * @return array
     */
    public function run($intId)
    {
        $arrStructure = $this->oRepository->find($intId)->toArray();
        $arrSelect = $this->getSelectTree($arrStructure['pid']);
        $arrStructure['pid'] = $arrSelect['selected'] ?: [
            -1,
        ];

        return [
            'one'  => $arrStructure,
            'list' => $arrSelect['list'],
        ];
    }

    /**
     * 分析树结构数据.
     *
     * @param int $intParentId
     *
     * @return array
     */
    protected function getSelectTree($intParentId)
    {
        $this->intParentId = $intParentId;

        return $this->parseStructureList($this->oRepository->all());
    }

    /**
     * 将节点载入节点树并返回树结构.
     *
     * @param \queryyetsimple\support\collection $objStructure
     *
     * @return array
     */
    protected function parseStructureList($objStructure)
    {
        return $this->createTree($objStructure)->forSelect($this->intParentId);
    }

    /**
     * 生成节点树.
     *
     * @param \queryyetsimple\support\collection $objStructure
     *
     * @return \common\is\tree\tree
     */
    protected function createTree($objStructure)
    {
        $oTree = new tree($this->parseToNode($objStructure));
        $arrTopStructure = $this->oRepository->topNode();
        $oTree->setNode($arrTopStructure['id'], $arrTopStructure['pid'], $arrTopStructure['lable'], true);

        return $oTree;
    }

    /**
     * 转换为节点数组.
     *
     * @param \queryyetsimple\support\collection $objStructure
     *
     * @return array
     */
    protected function parseToNode($objStructure)
    {
        $arrNode = [];
        foreach ($objStructure as $oStructure) {
            $arrNode[] = [
                $oStructure->id,
                $oStructure->pid,
                $oStructure->name,
            ];
        }

        return $arrNode;
    }
}
