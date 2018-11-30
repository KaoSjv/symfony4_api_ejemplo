<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setApiKey('test_api_key');
        $user->setEmail('test@test.com');
        $user->setPassword('test');
        $manager->persist($user);

        for($i=0; $i <10; $i++) {
            $article = new Article();
            $article->setBody('Este es el cuerpo del artículo '. $i);

            for($j=0; $j < $i; $j++) {
                $comment = new Comment();
                $comment->setBody('Este es el cuerpo del comentario '.$j.' del artículo '.$i);
                $comment->setArticle($article);
                $manager->persist($comment);
            }
            $manager->persist($article);
        }

        $manager->flush();
    }
}
