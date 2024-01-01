<?php
    $telegrambot = 'bot6424345808:AAHnMSaAjAoPTm2hVY1Jwq2mwiptUn08TU0';
    $user = '1441844858';

    function kirim($pesan, $bot, $chat)
    {
        $url = 'https://api.telegram.org/'.$bot.'/sendMessage?chat_id='.$chat.'&text='.$pesan;
        $result = file_get_contents($url, true);
        return $result;
    }

    kirim('selamat datang', $telegrambot, $user);
    ?>