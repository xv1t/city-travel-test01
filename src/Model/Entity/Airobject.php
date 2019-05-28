<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Airobject Entity
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $code
 * @property string $lang
 * @property string $city_name
 * @property string|null $airport_name
 */
class Airobject extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'type' => true,
        'name' => true,
        'code' => true,
        'lang' => true,
        'city_name' => true,
        'airport_name' => true
    ];
}
