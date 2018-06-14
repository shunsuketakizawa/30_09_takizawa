<?php
//合言葉を確認
session_start();
//合言葉を変える(セキュリティー)
session_regenerate_id(true);
//もしログインOKの証拠がなかったら
if(isset($_SESSION['login'])==false)
{
    //ログイン画面へ戻ってもらう。exit()で強制終了してこれ以上の画面は見せない。
    print 'ログインされていません。<br />';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();//プログラムを強制終了
}
else
{
    print $_SESSION['staff_name'];
    print 'さんログイン中<br />';
    print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>

<?php
require_once('../common/common.php');
?>

ダウンロードしたい注文日を選んでください。<br />
<form method="post" action="order_download_done.php">
<?php pulldown_year();?>
年
<?php pulldown_month();?>
月
<?php pulldown_day();?>
日<br />
<br />
<input type="submit" value="ダウンロードへ">
</form>

</body>
</html>