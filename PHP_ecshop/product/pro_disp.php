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

try
{
//選択された商品コードを受け取ってます
$pro_code=$_GET['procode'];

//データベースに接続
$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//コードで絞り込んでいる。1件のレコードに絞り込まれるのでループしない。
$sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt = $dbh-> prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name']; //商品名を変数にコピー
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];

$dbh=null;

// もし画像があれば表示のタグを準備
if($pro_gazou_name=="")
{
    $disp_gazou='';
}
else
{
    $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
}
//ここまで
}
catch(Exception $e)
{
    print'ただいま障害により大変ご迷惑をお掛けしています。';
    exit();
}

?>

商品情報参照<br />
<br />
商品コード<br />
<?php print $pro_code; ?>
<br />
商品名<br />
<?php print $pro_name; ?>
<br />
価格<br />
<?php print $pro_price; ?> 円
<br />
<!-- 画像を表示、もしなけれは何も表示されない -->
<?php print $disp_gazou; ?>
<br />
<br />
<form> 
<input type="button" onclick="history.back()" value="戻る">
</form>


</body>
</html>