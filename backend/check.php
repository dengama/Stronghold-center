<?php
	include_once 'conf.php';

  $auth = new auth(); //~ Создаем новый объект класса

  if ($post = mso_check_post('field'))
  {

  //~ Авторизация
  if (isset($_POST['send'])) {
    if (!$auth->authorization()) {
    $error = $_SESSION['error'];
    unset ($_SESSION['error']);
    }
  }

  /*
  рекапчу можно обойти с правильным паролем
  */

  //~ Проверка reCaptcha
  if (isset($_POST['g-recaptcha-response'])) {
    $url_to_google_api = "https://www.google.com/recaptcha/api/siteverify";
    $secret_key = '6LddgD8UAAAAAEtZPDnL-TG6i6Mn7vJtccBs8btL';
    $query = $url_to_google_api . '?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response'] . '&remoteip=' . $_SERVER['REMOTE_ADDR'];
    $response = json_decode(file_get_contents($query));
  }

  //~ Проверка авторизации
  if ($auth->check() && $response != null && $response->success) echo 'granted';
   else {
    //~ если есть ошибки выводим их
    if (isset($error)) echo 'denied';
  }
}
?>
