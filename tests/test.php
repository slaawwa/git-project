<?php

	/*namespace app\tests;
	
	use app\assets\Need;*/

	// require(__DIR__ . '/../assets/Per.php');
?>

	Start<hr>

<?php
	error_reporting(E_ALL);

	$link = 'https://chart.googleapis.com/chart?cht=p3&chs=250x100&chd=t:60,40&chl=Hello|World&chof=json';
	$link = 'https://api.vk.com/method/users.get?fields=photo_max&access_token=a144f5b24ffac36d8d686a9e428bfbab6202b088912e9a63679f874326168079d85c28996452d2d704124';

	switch ($_GET['r']) {
		case 'phpinfo':
			phpinfo();
			die();
		break;
		case 'need_curl':
			//Per::per('sdfsdf', 'sdf');
		break;
		case 'curl1':

			// create a new cURL resource
			$ch = curl_init();
			die('-stop-');

			// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_URL, $link);
			curl_setopt($ch, CURLOPT_HEADER, 0);

			// grab URL and pass it to the browser
			curl_exec($ch);

			// close cURL resource, and free up system resources
			curl_close($ch);

		break;
		case 'curl2':
			function curl($url,$posts=""){
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
			/*Bu fonksiyonu kullanarak kolayca curl yi kullanabilirsiniz.
			Kullanımı*/
			$tmp = curl($link);
			echo '|'.var_dump($tmp).'|';
			echo '|'.$tmp.'|';
		break;
		case 'curl3':
			//  Initiate curl
			$ch = curl_init();
			// Disable SSL verification
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			// Will return the response, if false it print the response
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Set the url
			curl_setopt($ch, CURLOPT_URL,$url);
			// Execute
			$result=curl_exec($ch);
			// Closing
			curl_close($ch);

			// Will dump a beauty json :3
			var_dump(json_decode($result, true));
		break;
		default:
			echo 'default';
		break;
	}
	
?><hr>Finish