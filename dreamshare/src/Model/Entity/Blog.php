<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Blog Entity
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $title
 * @property string|null $body
 * @property string|null $imagelink
 * @property int|null $comments
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Blog extends Entity
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
        'name' => true,
        'surname' => true,
        'email' => true,
        'title' => true,
        'body' => true,
        'imagelink' => true,
        'comments' => true,
        'created' => true,
        'modified' => true,
    ];
}
