<?php

namespace Bean\Tests\Thing\Doctrine\Orm;

use Bean\Thing\Doctrine\Orm\Thing;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ThingTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function clearDatabase()
    {
        $em = $this->entityManager;
        if (!isset($metadatas)) {
            $metadatas = $em->getMetadataFactory()->getAllMetadata();
        }
        $schemaTool = new SchemaTool($em);
        $schemaTool->dropDatabase();
        if (!empty($metadatas)) {
            $schemaTool->createSchema($metadatas);
        }
    }

    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->clearDatabase();

        $thing = new Thing();
        $thing->setSlug('magenta');
        $data = ['address' => 'Trivex, 8 Burn Rd, Singapour 369977',
        ];

        $thing->setData($data);
        $this->entityManager->persist($thing);
        $this->entityManager->flush();
    }

    public function testDataProperty()
    {
        /** @var Thing $org */
        $thingImpl = $this->entityManager->getRepository(Thing::class)->findOneBySlug('magenta');
        $this->assertNotEmpty($thingImpl);
        $this->assertIsArray($data = $thingImpl->getData());
        $this->assertEquals('Trivex, 8 Burn Rd, Singapour 369977', $data['address']);
    }
}