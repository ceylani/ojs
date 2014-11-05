<?php

namespace Ojs\JournalBundle\Tests\Controller;

use \Ojs\Common\Helper\TestHelper;

class AuthorControllerTest extends TestHelper
{
    public function testStatus()
    {
        $this->logIn('admin', array('ROLE_SUPER_ADMIN'));
        $this->client->request('GET', '/admin/author/');
        $this->assertTrue($this->client->getResponse()->isSuccessful());

        $this->client->request('GET', '/admin/author/new');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

}