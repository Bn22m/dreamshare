<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Test\TestCase\ORM\Association;

use Cake\Database\Expression\IdentifierExpression;
use Cake\Database\Expression\QueryExpression;
use Cake\Database\TypeMap;
use Cake\ORM\Association\BelongsTo;
use Cake\ORM\Entity;
use Cake\TestSuite\TestCase;

/**
 * Tests BelongsTo class
 */
class BelongsToTest extends TestCase
{

    /**
     * Fixtures to use.
     *
     * @var array
     */
    public $fixtures = ['core.Articles', 'core.Authors', 'core.Comments'];

    /**
     * Set up
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->company = $this->getTableLocator()->get('Companies', [
            'schema' => [
                'id' => ['type' => 'integer'],
                'company_name' => ['type' => 'string'],
                '_constraints' => [
                    'primary' => ['type' => 'primary', 'columns' => ['id']],
                ],
            ],
        ]);
        $this->client = $this->getTableLocator()->get('Clients', [
            'schema' => [
                'id' => ['type' => 'integer'],
                'client_name' => ['type' => 'string'],
                'company_id' => ['type' => 'integer'],
                '_constraints' => [
                    'primary' => ['type' => 'primary', 'columns' => ['id']],
                ],
            ],
        ]);
        $this->companiesTypeMap = new TypeMap([
            'Companies.id' => 'integer',
            'id' => 'integer',
            'Companies.company_name' => 'string',
            'company_name' => 'string',
            'Companies__id' => 'integer',
            'Companies__company_name' => 'string',
        ]);
    }

    /**
     * Tear down
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        $this->getTableLocator()->clear();
    }

    /**
     * Test that foreignKey generation
     *
     * @return void
     */
    public function testSetForeignKey()
    {
        $assoc = new BelongsTo('Companies', [
            'sourceTable' => $this->client,
            'targetTable' => $this->company,
        ]);
        $this->assertEquals('company_id', $assoc->getForeignKey());
        $this->assertSame($assoc, $assoc->setForeignKey('another_key'));
        $this->assertEquals('another_key', $assoc->getForeignKey());
    }

    /**
     * Test that foreignKey generation
     *
     * @group deprecated
     * @return void
     */
    public function testForeignKey()
    {
        $this->deprecated(function () {
            $assoc = new BelongsTo('Companies', [
                'sourceTable' => $this->client,
                'targetTable' => $this->company,
            ]);
            $this->assertEquals('company_id', $assoc->foreignKey());
            $this->assertEquals('another_key', $assoc->foreignKey('another_key'));
            $this->assertEquals('another_key', $assoc->foreignKey());
        });
    }

    /**
     * Test that foreignKey generation ignores database names in target table.
     *
     * @return void
     */
    public function testForeignKeyIgnoreDatabaseName()
    {
        $this->company->setTable('schema.companies');
        $this->client->setTable('schema.clients');
        $assoc = new BelongsTo('Companies', [
            'sourceTable' => $this->client,
            'targetTable' => $this->company,
        ]);
        $this->assertEquals('company_id', $assoc->getForeignKey());
    }

    /**
     * Tests that the association reports it can be joined
     *
     * @return void
     */
    public function testCanBeJoined()
    {
        $assoc = new BelongsTo('Test');
        $this->assertTrue($assoc->canBeJoined());
    }

    /**
     * Tests that the alias set on associations is actually on the Entity
     *
     * @return void
     */
    public function testCustomAlias()
    {
        $table = $this->getTableLocator()->get('Articles', [
            'className' => 'TestPlugin.Articles',
        ]);
        $table->addAssociations([
            'belongsTo' => [
                'FooAuthors' => ['className' => 'TestPlugin.Authors', 'foreignKey' => 'author_id'],
            ],
        ]);
        $article = $table->find()->contain(['FooAuthors'])->first();

        $this->assertTrue(isset($article->foo_author));
        $this->assertEquals($article->foo_author->name, 'mariano');
        $this->assertNull($article->Authors);
    }

    /**
     * Tests that the correct join and fields are attached to a query depending on
     * the association config
     *
     * @return void
     */
    public function testAttachTo()
    {
        $config = [
            'foreignKey' => 'company_id',
            'sourceTable' => $this->client,
            'targetTable' => $this->company,
            'conditions' => ['Companies.is_active' => true],
        ];
        $association = new BelongsTo('Companies', $config);
        $query = $this->client->query();
        $association->attachTo($query);

        $expected = [
            'Companies__id' => 'Companies.id',
            'Companies__company_name' => 'Companies.company_name',
        ];
        $this->assertEquals($expected, $query->clause('select'));
        $expected = [
            'Companies' => [
                'alias' => 'Companies',
                'table' => 'companies',
                'type' => 'LEFT',
                'conditions' => new QueryExpression([
                    'Companies.is_active' => true,
                    ['Companies.id' => new IdentifierExpression('Clients.company_id')],
                ], $this->companiesTypeMap),
            ],
        ];
        $this->assertEquals($expected, $query->clause('join'));

        $this->assertEquals(
            'integer',
            $query->getTypeMap()->type('Companies__id'),
            'Associations should map types.'
        );
    }

    /**
     * Tests that it is possible to avoid fields inclusion for the associated table
     *
     * @return void
     */
    public function testAttachToNoFields()
    {
        $config = [
            'sourceTable' => $this->client,
            'targetTable' => $this->company,
            'conditions' => ['Companies.is_active' => true],
        ];
        $query = $this->client->query();
        $association = new BelongsTo('Companies', $config);

        $association->attachTo($query, ['includeFields' => false]);
        $this->assertEmpty($query->clause('select'), 'no fields should be added.');
    }

    /**
     * Tests that using belongsto with a table having a multi column primary
     * key will work if the foreign key is passed
     *
     * @return void
     */
    public function testAttachToMultiPrimaryKey()
    {
        $this->company->setPrimaryKey(['id', 'tenant_id']);
        $config = [
            'foreignKey' => ['company_id', 'company_tenant_id'],
            'sourceTable' => $this->client,
            'targetTable' => $this->company,
            'conditions' => ['Companies.is_active' => true],
        ];
        $association = new BelongsTo('Companies', $config);
        $query = $this->client->query();
        $association->attachTo($query);

        $expected = [
            'Companies__id' => 'Companies.id',
            'Companies__company_name' => 'Companies.company_name',
        ];
        $this->assertEquals($expected, $query->clause('select'));

        $field1 = new IdentifierExpression('Clients.company_id');
        $field2 = new IdentifierExpression('Clients.company_tenant_id');
        $expected = [
            'Companies' => [
                'conditions' => new QueryExpression([
                    'Companies.is_active' => true,
                    ['Companies.id' => $field1, 'Companies.tenant_id' => $field2],
                ], $this->companiesTypeMap),
                'table' => 'companies',
                'type' => 'LEFT',
                'alias' => 'Companies',
            ],
        ];
        $this->assertEquals($expected, $query->clause('join'));
    }

    /**
     * Tests that using belongsto with a table having a multi column primary
     * key will work if the foreign key is passed
     *
     * @return void
     */
    public function testAttachToMultiPrimaryKeyMismatch()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Cannot match provided foreignKey for "Companies", got "(company_id)" but expected foreign key for "(id, tenant_id)"');
        $this->company->setPrimaryKey(['id', 'tenant_id']);
        $query = $this->client->query();
        $config = [
            'foreignKey' => 'company_id',
            'sourceTable' => $this->client,
            'targetTable' => $this->company,
            'conditions' => ['Companies.is_active' => true],
        ];
        $association = new BelongsTo('Companies', $config);
        $association->attachTo($query);
    }

    /**
     * Test the cascading delete of BelongsTo.
     *
     * @return void
     */
    public function testCascadeDelete()
    {
        $mock = $this->getMockBuilder('Cake\ORM\Table')
            ->disableOriginalConstructor()
            ->getMock();
        $config = [
            'sourceTable' => $this->client,
            'targetTable' => $mock,
        ];
        $mock->expects($this->never())
            ->method('find');
        $mock->expects($this->never())
            ->method('delete');

        $association = new BelongsTo('Companies', $config);
        $entity = new Entity(['company_name' => 'CakePHP', 'id' => 1]);
        $this->assertTrue($association->cascadeDelete($entity));
    }

    /**
     * Test that saveAssociated() ignores non entity values.
     *
     * @return void
     */
    public function testSaveAssociatedOnlyEntities()
    {
        $mock = $this->getMockBuilder('Cake\ORM\Table')
            ->setMethods(['saveAssociated'])
            ->disableOriginalConstructor()
            ->getMock();
        $config = [
            'sourceTable' => $this->client,
            'targetTable' => $mock,
        ];
        $mock->expects($this->never())
            ->method('saveAssociated');

        $entity = new Entity([
            'title' => 'A Title',
            'body' => 'A body',
            'author' => ['name' => 'Jose'],
        ]);

        $association = new BelongsTo('Authors', $config);
        $result = $association->saveAssociated($entity);
        $this->assertSame($result, $entity);
        $this->assertNull($entity->author_id);
    }

    /**
     * Tests that property is being set using the constructor options.
     *
     * @return void
     */
    public function testPropertyOption()
    {
        $config = ['propertyName' => 'thing_placeholder'];
        $association = new BelongsTo('Thing', $config);
        $this->assertEquals('thing_placeholder', $association->getProperty());
    }

    /**
     * Test that plugin names are omitted from property()
     *
     * @return void
     */
    public function testPropertyNoPlugin()
    {
        $mock = $this->getMockBuilder('Cake\ORM\Table')
            ->disableOriginalConstructor()
            ->getMock();
        $config = [
            'sourceTable' => $this->client,
            'targetTable' => $mock,
        ];
        $association = new BelongsTo('Contacts.Companies', $config);
        $this->assertEquals('company', $association->getProperty());
    }

    /**
     * Tests that attaching an association to a query will trigger beforeFind
     * for the target table
     *
     * @return void
     */
    public function testAttachToBeforeFind()
    {
        $config = [
            'foreignKey' => 'company_id',
            'sourceTable' => $this->client,
            'targetTable' => $this->company,
        ];
        $listener = $this->getMockBuilder('stdClass')
            ->setMethods(['__invoke'])
            ->getMock();
        $this->company->getEventManager()->on('Model.beforeFind', $listener);
        $association = new BelongsTo('Companies', $config);
        $listener->expects($this->once())->method('__invoke')
            ->with(
                $this->isInstanceOf('\Cake\Event\Event'),
                $this->isInstanceOf('\Cake\ORM\Query'),
                $this->isInstanceOf('\ArrayObject'),
                false
            );
        $association->attachTo($this->client->query());
    }

    /**
     * Tests that attaching an association to a query will trigger beforeFind
     * for the target table
     *
     * @return void
     */
    public function testAttachToBeforeFindExtraOptions()
    {
        $config = [
            'foreignKey' => 'company_id',
            'sourceTable' => $this->client,
            'targetTable' => $this->company,
        ];
        $listener = $this->getMockBuilder('stdClass')
            ->setMethods(['__invoke'])
            ->getMock();
        $this->company->getEventManager()->on('Model.beforeFind', $listener);
        $association = new BelongsTo('Companies', $config);
        $options = new \ArrayObject(['something' => 'more']);
        $listener->expects($this->once())->method('__invoke')
            ->with(
                $this->isInstanceOf('\Cake\Event\Event'),
                $this->isInstanceOf('\Cake\ORM\Query'),
                $options,
                false
            );
        $query = $this->client->query();
        $association->attachTo($query, ['queryBuilder' => function ($q) {
            return $q->applyOptions(['something' => 'more']);
        }]);
    }

    /**
     * Test that failing to add the foreignKey to the list of fields will throw an
     * exception
     *
     * @return void
     */
    public function testAttachToNoFieldsSelected()
    {
        $articles = $this->getTableLocator()->get('Articles');
        $association = $articles->belongsTo('Authors');

        $query = $articles->find()
            ->select(['Authors.name'])
            ->where(['Articles.id' => 1])
            ->contain('Authors');
        $result = $query->firstOrFail();

        $this->assertNotEmpty($result->author);
        $this->assertSame('mariano', $result->author->name);
        $this->assertSame(['author'], array_keys($result->toArray()), 'No other properties included.');
    }
}
