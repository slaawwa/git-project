<?php
	
	namespace app\assets;

	use Yii;

	/**
	* 
	*/
	class Need { // extends Object {

		// public $
		
		/*function __construct(argument)
		{
			# code...
		}*/

		public static function curl($url, $posts=""){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_POST, $posts ? 0 :1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS,$posts);
			$icerik = curl_exec($ch);
			curl_close($ch);
			return $icerik;
		}

	    public static function per($value, $label='', $ret = true) {
	        $res = '<div class="_debug">'.($label? "<h1>$label</h1>": '').'<pre>'.print_r($value, true).'</pre></div>';
	        if ($ret) return $res;
	        echo $res;
	    }

	    public static function ua($point, $value) {
	        $D = ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'П\'ятниця', 'Субота'];
	        $d = ['Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
	        $m = ['', 'Січ', 'Лют', 'Бер', 'Кві', 'Тра', 'Чер', 'Лип', 'Сер', 'Вер', 'Жов', 'Лис', 'Гру'];
	        $M = ['', 'Січeнь', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'];
	        switch ($point) {
	            case 'mon3':
	                return $m[$value];
	            break;
	            case 'mon':
	                return $M[$value];
	            break;
	            case 'wday3':
	                return $d[$value];
	            break;
	            case 'wday':
	                return $D[$value];
	            break;
	            default:
	                return false;
	            break;
	        }
	    }

	    public static function day2user($day) {
	        $users = [
	            'Нд' => 4, // Міша
	            'Пн' => 2, // Слава
	            'Вт' => 5, // Бодя
	            'Ср' => 7, // Яна
	            'Чт' => 3, // Макс
	            'Пт' => 8, // Ігор
	            'Сб' => 6, // Кароліна
	        ];
	        // UPDATE `question` SET `npp`=0,`publiced`=0 WHERE `id`>16
	        return $users[$day];
	    }
	    public static function pro7gress($paramName) {
	        switch ($paramName) {
	            case 'time':
	                $res = '22:35';
	            break;
	            case 'reserv':
	                $res = 7;
	            break;
	            case 'defAva': 
	              $res = '/web/img/default_user.png';
	            break;
	            default:
	                $res = false;
	            break;
	        }
	        return $res;
	    }

	    public static function getAva($user = false) {
	      if (!$user) $user = Yii::$app->user->identity;
	      return $user->ava? $user->ava: static::pro7gress('defAva');
	    }
	}

?>