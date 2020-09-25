<?php
/**
 * This file is part of SocialLogin4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\SocialLogin4\Tests\Web;


use Eccube\Tests\Web\AbstractWebTestCase;
use Plugin\SocialLogin4\Entity\Config;
use Plugin\SocialLogin4\Repository\ConfigRepository;

class Auth0ControllerTest extends AbstractWebTestCase
{
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function testAuth0の設定をしていなかったらNotFound()
    {
        $this->client->request('GET', $this->generateUrl('auth0_connect'));
        self::assertTrue($this->client->getResponse()->isNotFound());
    }

    public function testAuth0の設定をしていたらリダイレクト()
    {
        $Config = new Config();
        $Config
            ->setClientId("dummy")
            ->setClientSecret("dummy")
            ->setCustomDomain("dummy");
        $this->entityManager->persist($Config);
        $this->entityManager->flush();

        $this->client->request('GET', $this->generateUrl('auth0_connect'));
        self::assertTrue($this->client->getResponse()->isRedirection());
    }
}
