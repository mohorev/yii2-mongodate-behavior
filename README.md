MongoDate behavior for Yii 2
===========================

MongoDateBehavior automatically fills the specified attributes with the current ISODate.

By default, MongoDateBehavior will fill the `created` and `updated` attributes with the current ISODate
when the associated AR object is being inserted; it will fill the `updated` attribute
with the ISODate when the AR object is being updated.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist mongosoft/yii2-mongodate-behavior "*"
```

or add

```json
"mongosoft/yii2-mongodate-behavior": "*"
```

to the `require` section of your composer.json.

Usage
-----

### Upload file

Attach the behavior in your model:

```php
class User extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id', 'name', 'created', 'updated',
        ];
    }

    /**
     * @inheritdoc
     */
    function behaviors()
    {
        return [
            MongoDateBehavior::className(),
        ];
    }
}
```