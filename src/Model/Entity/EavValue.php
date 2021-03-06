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
namespace Eav\Model\Entity;

use Cake\ORM\Entity;

/**
 * Represents a "eav_value" within the "eav_values" database table.
 *
 * @property int $id
 * @property int $entity_id
 * @property string $attribute
 * @property string $table_alias
 * @property object $value_datetime
 * @property float $value_decimal
 * @property int $value_int
 * @property string $value_text
 * @property string $value_varchar
 * @property object|array $extra
 * @property string $public_notes
 * @property string $private_notes
 */
class EavValue extends Entity
{
}
