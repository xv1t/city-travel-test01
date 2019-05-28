<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AirobjectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AirobjectsTable Test Case
 */
class AirobjectsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AirobjectsTable
     */
    public $Airobjects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Airobjects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Airobjects') ? [] : ['className' => AirobjectsTable::class];
        $this->Airobjects = TableRegistry::getTableLocator()->get('Airobjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Airobjects);

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
