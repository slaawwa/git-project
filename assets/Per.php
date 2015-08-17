<?php
	echo 'test';
	namespace app\assets;

	
	class Per {

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
	}

?>