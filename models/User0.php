<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\assets\Need;


class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByVK_id($id)
    {
        return static::findOne(['vk_id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }



    /**
     * VK auth
     */
    public static function authOpenAPIMember() { 
        $session = array(); 
        $member = FALSE; 
        $valid_keys = array('expire', 'mid', 'secret', 'sid', 'sig'); 
        /*echo isset($_COOKIE['vk_app_'.Yii::$app->params['VK_APP_ID']]).'<hr>';
        echo $_COOKIE['vk_app_'.Yii::$app->params['VK_APP_ID']];
        die('-end-');*/
        if (!isset($_COOKIE['vk_app_'.Yii::$app->params['VK_APP_ID']])) return FALSE;
        if (isset($_COOKIE['logout']) && $_COOKIE['logout']) return false;
        $app_cookie = $_COOKIE['vk_app_'.Yii::$app->params['VK_APP_ID']]; 
        if ($app_cookie) { 
          $session_data = explode ('&', $app_cookie, 10); 
          foreach ($session_data as $pair) { 
            list($key, $value) = explode('=', $pair, 2); 
            if (empty($key) || empty($value) || !in_array($key, $valid_keys)) { 
              continue; 
            } 
            $session[$key] = $value; 
          } 
          foreach ($valid_keys as $key) { 
            if (!isset($session[$key])) return $member; 
          } 
          ksort($session); 

          $sign = ''; 
          foreach ($session as $key => $value) { 
            if ($key != 'sig') { 
              $sign .= ($key.'='.$value); 
            } 
          } 
          $sign .= Yii::$app->params['VK_APP_SHARED_SECRET']; 
          $sign = md5($sign); 
          if ($session['sig'] == $sign && $session['expire'] > time()) { 
            $member = array( 
              'id' => intval($session['mid']), 
              'secret' => $session['secret'], 
              'sid' => $session['sid'] 
            ); 
          } 

            // $vk_ids = $member['id'];
            // $AT = $member['sid'];
            if (YII_ENV_DEV) {
              $link = 'https://api.vk.com/method/users.get?fields=photo_max&access_token='.$member['sid'];
            } else {
              $link = 'http://api.vkontakte.ru/method/users.get?uids='.$member['id'].'&fields=photo_max';
            }
            // if (Yii::$app->components->db['host'] == 'localhost') {
            if (YII_ENV_DEV) {
              $obj = json_decode(file_get_contents($link));
            } else {
              // echo Need::per($link);
              /*function curl($url,$posts=""){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                curl_setopt($ch, CURLOPT_POST, $posts ? 0 :1); 
                curl_setopt($ch, CURLOPT_POSTFIELDS,$posts);
                $icerik = curl_exec($ch);
                curl_close($ch);
                return $icerik;
              } */
              $tmp = Need::curl($link);
              // $tmp = curl($link);
              $obj = json_decode($tmp);
              // var_dump($tmp).'<hr>';
              /*Need::per($tmp, 'tmp', false);
              Need::per($obj, 'OBJ', false);
              die();*/
            }
            if (is_object($obj) && property_exists($obj, 'response')) {
                return $obj->response[0];
            } else {
                return false;
                return $obj;
            }

        } 
        return $member; 
    }

    public static function vk_valid() {
        $member = User::authOpenAPIMember();

        /*Need::per($member, 'member', false);
        die();*/

        /*if ($member == 'needExitVk') {
          return $member;
        } else */if (!$member) {
            return false;
        } else if (is_object($member) && property_exists($member, 'uid')) {
            $user = User::findByVK_id($member->uid);
            if (!$user) {
                $user = new User();
                $user->username = $member->first_name.' '.$member->last_name;
                $user->ava = $member->photo_max;
                $user->vk_id = $member->uid;
                $user->created_at = time();
                $user->updated_at = $user->created_at;
                $user->generateAuthKey();
                $user->save();
            }
            if (isset($user->id)) {
                return $user;
            }
        } else if (property_exists($member, 'error')) {
            echo "<h1>Error</h1><pre>".print_r($member, true)."</pre>";
            die ('-End-');
        } else {
            echo "<h1>Error</h1><pre>Невідома помилка(((</pre>";
            die ('-End-');
        }
        return false;
    }

    public static function checkQ() {
        $maxPub = Question::find()->max('publiced');
        $tDay = 3600 * 24;
        // $maxPubNow = time() + $tDay * 
        $maxPubNew = time() + (Need::pro7gress('reserv') * $tDay);
        // User::per($maxPub, 'test', false);
        // User::per($maxPubNew, 'test', false);
        $cday = (int)round(($maxPubNew-$maxPub)/$tDay);
        // User::per($cday, 'cday', false);
        $res = Question::find()->where('npp=0')->orderBy('rand()')->limit($cday)->all(); // ->asArray()
        $count = 0;

        foreach ($res as $a) {
            $count++;
            $tmp = $maxPub+$tDay*$count;
            $a->publiced = $tmp;
            $maxNpp = Question::find()->max('npp');
            $wday3 = Need::ua('wday3', getdate($tmp)['wday']);
            $a->user_take = Need::day2user($wday3);
            // User::per(User::day2user($wday3), 'wday3', false);
            $a->npp = $maxNpp + 1;
            $a->save();

            // User::per($a->publiced, 'item: '.$a->id, false);   
        }
        // User::per($res[0]->id, 'test', false);
        // die('--');
    }

    public static function findByRole($role) {
      return static::find()
          ->join('LEFT JOIN','auth_assignment','auth_assignment.user_id = id')
          ->where(['auth_assignment.item_name' => $role])
          ->all();
    }

    public static function getRoleUsers($role_name) {
        $connection = \Yii::$app->db;
        $connection->open();

        $command = $connection->createCommand(
            "SELECT * FROM auth_assignment INNER JOIN user ON auth_assignment.user_id = user.id " .
            "WHERE auth_assignment.item_name = '" . $role_name . "';");

        $users = $command->queryAll();
        $connection->close();

        return $users;
    }

}