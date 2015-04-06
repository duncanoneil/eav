<?php
/**
 * Licensed under The GPL-3.0 License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @since    2.0.0
 * @author   Christopher Castro <chris@quickapps.es>
 * @link     http://www.quickappscms.org
 * @license  http://opensource.org/licenses/gpl-3.0.html GPL-3.0 License
 */
namespace Eav\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Represents EAV "eav_attributes" database table.
 */
class EavAttributesTable extends Table
{

    /**
     * Initialize a table instance. Called after the constructor.
     *
     * @param array $config Configuration options passed to the constructor
     * @return void
     */
    public function initialize(array $config)
    {
        $this->addBehavior('Serializable', [
            'columns' => ['extra']
        ]);

        $this->hasMany('EavValues', [
            'className' => 'Eav.EavValues',
            'foreignKey' => 'eav_attribute_id',
            'dependent' => true,
        ]);
    }

    /**
     * Application rules.
     *
     * @param \Cake\ORM\RulesChecker $rules The rule checker
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name'], __d('eav', 'The machine name is already in use.')));
        return $rules;
    }

    /**
     * Default validation rules set.
     *
     * @param \Cake\Validation\Validator $validator The validator object
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('name', [
                'notEmpty' => [
                    'rule' => 'notEmpty',
                    'message' => __d('eav', 'You need to provide a machine name.'),
                ],
                'length' => [
                    'rule' => ['minLength', 3],
                    'message' => __d('eav', 'Machine name need to be at least 3 characters long.'),
                ],
                'regExp' => [
                    'rule' => function ($value, $context) {
                        return preg_match('/^[a-z\d\-]+$/', $value) > 0;
                    },
                    'message' => __d('eav', 'Only lowercase letters, numbers and "-" symbol are allowed.'),
                ],
            ])
            ->notEmpty('table_alias', __d('eav', 'Invalid table alias.'))
            ->requirePresence('type', 'create', __d('eav', 'Invalid data type.'))
            ->add('type', 'valid_type', [
                'rule' => function ($value, $context) {
                    return in_array($value, ['datetime', 'decimal', 'int', 'text', 'varchar']);
                },
                'message' => __d('field', 'Invalid data type, valid options are: "datetime", "decimal", "int", "text" or "varchar"')
            ]);

        return $validator;
    }
}
