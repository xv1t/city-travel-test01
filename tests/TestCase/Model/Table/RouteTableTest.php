<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RouteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RouteTable Test Case
 */
class RouteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RouteTable
     */
    public $Route;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Route'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Route') ? [] : ['className' => RouteTable::class];
        $this->Route = TableRegistry::getTableLocator()->get('Route', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Route);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
