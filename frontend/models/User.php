<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $password
 * @property integer $user_type
 * @property string $email
 * @property string $phone
 *
 * @property Resume[] $resumes
 * @property UserHasJob[] $userHasJobs
 * @property Job[] $jobJobs
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type'], 'integer'],
            [['name', 'password', 'email'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'password' => 'Password',
            'user_type' => 'User Type',
            'email' => 'Email',
            'phone' => 'Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasJobs()
    {
        return $this->hasMany(UserHasJob::className(), ['user_user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobJobs()
    {
        return $this->hasMany(Job::className(), ['job_id' => 'job_job_id'])->viaTable('user_has_job', ['user_user_id' => 'user_id']);
    }
}
