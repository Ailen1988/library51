<?php

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        [
            'bookname' => 'PHP编程（第3版）',
            'publisher' => '电子工业出版社',
            'author' => 'Kevin Tatroe(凯文.塔特罗 )',
            'price' => '99',
            'content' => '      当作者第一次问我是否有兴趣写一下该书的序言，我急切回复了是——这是多么有面子的事儿。我回去读了前一个版本的序言后备受打击。我开始质疑为什么让我第一个写。我不是作者，我也没有传奇的故事，我就是个喜欢PHP的普通人！你可能已经知道用PHP写的应用是多么流行：Facebook、Wikipedia、Drupal 和 Wordpress。我能写些什么呢？
    我能说的就是我希望你不久可以读到这本书。当我读这本书的时候我会尝试第一次理解PHP编程。我得到了很多，然后有机会加入 Boston PHP（北美最大的PHP 用户组）并且领导整个小组4年。我见到了很多传奇的PHP开发者，他们很多都是自学成材的。机会像很多PHP人都知道的一样（包括我）：意外地就陷进去了。你只是希望用它来做些新东西。
　　我们的用户组举办了一次活动，邀请人们展示和交流使用PHP的新方式。一个房产经纪人向我们展示了如何用线上虚拟现实应用在自己的领域发现真实美好的愿景。一个教育玩具设计者展示了他的网站，出售他的独一无二的教育游戏。一个音乐家用PHP为著名的音乐大学创建了乐谱学习工具。还有一些人演示了他用来帮助研究癌症的一个程序。
  
    如你所见，PHP很容易做任何事情。不同背景、技能和目标的用户群体都有。你不需要很高的计算机科学学位在当下就能做一些大事。你需要这样一本书，社区可以帮你成长，多点执著和辛苦，你也可以用自己的方式打造一个全新的工具。
　　学习PHP是简单有趣的。作者已经做了很伟大的工作，将基础知识做了转换让你快速开始学习，然后带你正确地深入主题，比如面向对象编程。要更深入地练习从该书上学到的，你可以经常看PHP社区或我们的用户组，每个地方都有，可以帮你前进。有很多PHP会议开始逐渐进入世界上其他地方，具体可以看每年八月都会和其他用户组举办PHP会议，可以碰到很多不错的朋友（比如该书的联合作者 Peter MacIntrre，我也会去）并且了解他们，参与社区，你会是更好的 PHPer。
  
　　— Michael P.Bourque
  
　　VP, PTC
  
　　Boston PHP 用户组组织者
  
　　Northeast PHP 会议组织者
  
　　反向创业组织者
  
',
            'cid' => '1',
            'tags' => '1',
            'pic' => '4c0b4a3e1cc63ee2af8a41798dc4f6d8.jpg',
            'user_id' => '1',
            'price' => '82.99',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),

        ]
    ];
        DB::table('books')->insert($data);
    }
}
