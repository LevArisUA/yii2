<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $date
 * @property string|null $image
 * @property string|null $tag
 * @property int|null $viewed
 * @property int|null $topic_id
 * @property int|null $user_id
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','description','tag','topic_id','user_id'], 'required'],
            [['title','description'], 'string'],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['date'], 'default', 'value'=>date('Y-m-d')],
            [['viewed'], 'default', 'value'=>0],
            [['viewed', 'topic_id', 'user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Topic::class, 'targetAttribute' => ['topic_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'image' => 'Image',
            'tag' => 'Tag',
            'viewed' => 'Viewed',
            'topic_id' => 'Topic ID',
            'user_id' => 'User ID',
        ];
    }

    public function saveImage($filename){
        $this->image = $filename;
        return $this->save(false);
    }

    public function deleteImage(){
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }
    public function getImage(){
        if($this->image){
            return '/uploads/'.$this->image;
        }
        return '/uploads/no-image.jpg';
    }
}