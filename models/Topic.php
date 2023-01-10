<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property int $id
 * @property string|null $name
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    public function getArticles($id){
        $articles = Article::find()->where(['topic_id'=>$id])->all();
        return count($articles);
    }

}
