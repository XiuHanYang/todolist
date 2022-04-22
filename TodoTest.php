<?php

require_once 'class.php';

class TodoTest extends \PHPUnit\Framework\TestCase {

    /**
     * @test
     * @testdox 當項目清單是空的時候，新增一個清單項目「買菜」，優先權「無」，類別「工作」，項目清單應該只有一個「買菜」項目
     */
    public function shouldShowOneItemWhenAddItemIntoEmptyList() {
        $target = new todoList();
        $target->addItem('買菜');

        $actual = $target->showList();

        $this->assertSame(['買菜'], $actual);
    }
}
