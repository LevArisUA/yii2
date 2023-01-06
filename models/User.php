<?php

namespace app\models;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $login
 * @property string|null $password
 * @property string|null $image
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name','login','password'], 'required'],
            ['login','email'],
            [['name','login','password'], 'string'],
            [['name', 'login', 'password', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'login' => 'Login',
            'password' => 'Password',
            'image' => 'Image',
        ];
    }
    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }

    public function getImage()
    {
        if($this->image)
        {
            return '/uploads/' . $this->image;
        }
        return '/no-image.png';
    }

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }
    public static function findByUsername($username)
    {
        return User::find()->where(['login'=>$username])->one();
    }

   public function validatePassword($password) {
        return ($this->password == $password) ? true : false;
    }

    public function getUsername()
    {
        return $this->name;
    }

    /**

     * @inheritDoc

     */

    public static function findIdentity($id)

    {

        return User::findOne($id);

    }

    /**

     * @inheritDoc

     */

    public static function findIdentityByAccessToken($token, $type = null)

    {

// TODO: Implement findIdentityByAccessToken() method.

    }

    /**

     * @inheritDoc

     */

    public function getId()

    {

        return $this->id;

    }

    /**

     * @inheritDoc

     */

    public function getAuthKey()

    {

// TODO: Implement getAuthKey() method.

    }

    /**

     * @inheritDoc

     */

    public function validateAuthKey($authKey)

    {

// TODO: Implement validateAuthKey() method.

    }

    public function create()
    {
        return $this->save(false);
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

}
