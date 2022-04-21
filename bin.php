<?php

require_once 'vendor/autoload.php';
require_once 'class.php';

$app = new \Symfony\Component\Console\Application();

$app->addCommands([
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase1');
            $this->setDescription('當項目清單是空的時候，新增一個清單項目「買菜」，優先權「無」，類別「工作」，項目清單應該只有一個「買菜」項目');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase2');
            $this->setDescription('當項目清單有「買菜」項目時，新增一個清單項目「看書」，優先權「低」，類別「無」，項目清單應該要有「買菜」「看書」兩個項目');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();
            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);

            return 0;
        }
    }
]);

$app->run();