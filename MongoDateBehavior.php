<?php

namespace mongosoft\mongodb;

use yii\behaviors\TimestampBehavior;
use MongoDB\BSON\UTCDateTime;

/**
 * MongoDateBehavior automatically fills the specified attributes with the current ISODate.
 *
 * To use MongoDateBehavior, insert the following code to your ActiveRecord class:
 *
 * ```php
 * use mongosoft\mongodb\MongoDateBehavior;
 *
 * public function behaviors()
 * {
 *     return [
 *         MongoDateBehavior::className(),
 *     ];
 * }
 * ```
 *
 * By default, MongoDateBehavior will fill the `created` and `updated` attributes with the current ISODate
 * when the associated AR object is being inserted; it will fill the `updated` attribute
 * with the ISODate when the AR object is being updated.
 *
 * MongoDateBehavior also provides a method named [[touch()]] that allows you to assign the current
 * ISODate to the specified attribute(s) and save them to the database. For example,
 *
 * ```php
 * $this->identity->touch('login');
 * ```
 *
 * @author Alexander Mohorev <dev.mohorev@gmail.com>
 */
class MongoDateBehavior extends TimestampBehavior
{
    /**
     * @var string the attribute that will receive ISODate value.
     * Set this property to false if you do not want to record the creation date.
     */
    public $createdAtAttribute = 'created';
    /**
     * @var string the attribute that will receive ISODate value.
     * Set this property to false if you do not want to record the update date.
     */
    public $updatedAtAttribute = 'updated';
    /**
     * @var callable the value that will be used for generating the MongoDate.
     * This can be either an anonymous function that returns the ISODate value.
     * If not set, it will use the value of `new \MongoDate()` to set the attributes.
     */
    public $value;

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        return $this->value !== null ? call_user_func($this->value, $event) : new UTCDateTime(round(microtime(true) * 1000));
    }
}
