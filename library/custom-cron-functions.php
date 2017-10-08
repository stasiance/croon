<?php

// 내부 WP-Cron 비활성화
//define('DISABLE_WP_CRON', true);

// 새 cron 이벤트 생성

add_action( 'cron_test_hook', 'cron_test' , 1, 1);
if(!wp_next_scheduled('cron_test_hook')) // 이미 동명의 예약 액션 훅 이름이 있는지 확인합니다
{
    wp_schedule_event( strtotime(date("h", new DateTimeZone('Asia/Seoul')).'00:00'), 'hourly', 'cron_test_hook' );
}
function cron_test() {
    $tz = 'Asia/Seoul';
    $dt = new DateTime('now', new DateTimeZone($tz));
    $df = $dt->format('YmdHis');
}
