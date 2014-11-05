<?php

namespace Ojs\JournalBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ojs\JournalBundle\Entity\Issue;

class LoadArticleIssueData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /* @var $article \Ojs\JournalBundle\Entity\Article */
        $article = $this->getReference('ref-article');
        $issue = $this->getReference('ref-issue');
        $article->setIssue($issue);
        $manager->persist($article);
        $manager->flush();
    }

    public function getOrder()
    {
        return 19;
    }

}