<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Airobjects Model
 *
 * @method \App\Model\Entity\Airobject get($primaryKey, $options = [])
 * @method \App\Model\Entity\Airobject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Airobject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Airobject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airobject saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airobject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Airobject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Airobject findOrCreate($search, callable $callback = null, $options = [])
 */
class AirobjectsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('airobjects');
        $this->setDisplayField('name');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', false);

        $validator
            ->scalar('type')
            ->maxLength('type', 7)
            ->allowEmptyString('type', false);

        $validator
            ->scalar('name')
            ->maxLength('name', 45)
            ->allowEmptyString('name', false);

        $validator
            ->scalar('code')
            ->maxLength('code', 45)
            ->allowEmptyString('code', false);

        $validator
            ->scalar('lang')
            ->maxLength('lang', 2)
            ->allowEmptyString('lang', false);

        $validator
            ->scalar('city_name')
            ->maxLength('city_name', 45)
            ->allowEmptyString('city_name', false);

        $validator
            ->scalar('airport_name')
            ->maxLength('airport_name', 45)
            ->allowEmptyString('airport_name');

        return $validator;
    }
}
