<?php

namespace Ojstr\ManagerBundle\Tests\Controller;

class ManagerControllerTest extends \Ojstr\Common\Helper\TestHelper {

    public function testManagerDashboard() {
        $this->logIn('demo_editor', array('ROLE_EDITOR'));
        $this->client->request('GET', '/editor/dashboard');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

}