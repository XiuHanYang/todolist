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
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase3');
            $this->setDescription('當項目清單有「買菜」「看書」項目時，新增一個清單項目「寫扣」，優先權「中」，類別「私人」，項目清單應該要有「買菜」「看書」「寫扣」三個項目');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase4');
            $this->setDescription('當項目清單有「買菜」「看書」「寫扣」項目時，新增一個清單項目「澆花」，優先權「低」，類別「無」，項目清單應該要有「買菜」「看書」「寫扣」「澆花」四個項目');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase5');
            $this->setDescription('當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「看書」更新為「看電視」，項目清單應該要有「買菜」「看電視」「寫扣」「澆花」四個項目');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase6');
            $this->setDescription('當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「看書」更新為「」，應該要有「新item不得為空」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('', '看書');

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase7');
            $this->setDescription('當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「」更新為「看電視」，應該要有「原item不得為空」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '');

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase8');
            $this->setDescription('當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「」更新為「」，應該要有「新item不得為空」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('', '');

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase9');
            $this->setDescription('當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「書」更新為「看電視」，應該要有「找不到名為書的代辦事項」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '書');

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase10');
            $this->setDescription('當項目清單有「買菜」「看電視」「寫扣」「澆花」項目時，刪除「買菜」項目，項目清單應該只會出現「看電視」「寫扣」「澆花」三個項目');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('買菜');

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase11');
            $this->setDescription('當項目清單有「買菜」「看電視」「寫扣」「澆花」項目時，刪除「」項目，應該會出現「刪除的item不得為空」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('');

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase12');
            $this->setDescription('當項目清單有「買菜」「看電視」「寫扣」「澆花」項目時，刪除「菜」項目，應該會出現「找不到名為菜的待辦事項」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('菜');

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase13');
            $this->setDescription('當項目清單有「看電視」「寫扣」「澆花」項目時，顯示所有待辦事項清單，項目清單應該只會出現「看電視」「寫扣」「澆花」三個項目');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('買菜');
            $todoList->showList();

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase14');
            $this->setDescription('當項目清單有「看電視」「寫扣」「澆花」項目時，更新「看電視」狀態「已完成」，「看電視」狀態應該會是「已完成」');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('買菜');
            $todoList->showList();
            $todoList->updateItemStat(0, 1);

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase15');
            $this->setDescription('當項目清單有「看電視」「寫扣」「澆花」項目時，更新「看電視」狀態「未定義」，應該會出現「狀態錯誤」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('買菜');
            $todoList->showList();
            $todoList->updateItemStat(0, 2);

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase16');
            $this->setDescription('當項目清單有「看電視」「寫扣」「澆花」項目時，更新「看電視」優先權「中」，「看電視」優先權應該會是「中」');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('買菜');
            $todoList->showList();
            $todoList->updateItemPriority(0, 2);

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase17');
            $this->setDescription('當項目清單有「看電視」「寫扣」「澆花」項目時，更新「看電視」優先權「未定義」，應該會出現「優先權錯誤」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('買菜');
            $todoList->showList();
            $todoList->updateItemPriority(0, 4);

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase18');
            $this->setDescription('當項目清單有「看電視」「寫扣」「澆花」項目時，更新「澆花」類別「家庭」，「澆花」類別應該會是「家庭」');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('買菜');
            $todoList->showList();
            $todoList->updateItemClass(2, 2);

            return 0;
        }
    },
    new class extends Symfony\Component\Console\Command\Command {
        protected function configure()
        {
            $this->setName('testcase19');
            $this->setDescription('當項目清單有「看電視」「寫扣」「澆花」項目時，更新「澆花」類別「不存在」，應該會出現「類別錯誤」的錯誤訊息');
        }

        protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
        {
            $todoList = new todoList();

            $todoList->addItem('買菜', 0, 2);
            $todoList->addItem('看書', 1, 0);
            $todoList->addItem('寫扣', 2, 1);
            $todoList->addItem('澆花', 1, 0);
            $todoList->updateItem('看電視', '看書');
            $todoList->delItem('買菜');
            $todoList->showList();
            $todoList->updateItemClass(2, 4);

            return 0;
        }
    },
]);

$app->run();
