<?php
namespace Silexcane\Enum;

class Prefectures extends Enum
{
    protected static $data = [
        '01' => '北海道',
        '02' => '青森県',
        '03' => '岩手県',
        '04' => '宮城県',
        '05' => '秋田県',
        '06' => '山形県',
        '07' => '福島県',
        '08' => '茨城県',
        '09' => '栃木県',
        '10' => '群馬県',
        '11' => '埼玉県',
        '12' => '千葉県',
        '13' => '東京都',
        '14' => '神奈川県',
        '15' => '新潟県',
        '16' => '富山県',
        '17' => '石川県',
        '18' => '福井県',
        '19' => '山梨県',
        '20' => '長野県',
        '21' => '岐阜県',
        '22' => '静岡県',
        '23' => '愛知県',
        '24' => '三重県',
        '25' => '滋賀県',
        '26' => '京都府',
        '27' => '大阪府',
        '28' => '兵庫県',
        '29' => '奈良県',
        '30' => '和歌山県',
        '31' => '鳥取県',
        '32' => '島根県',
        '33' => '岡山県',
        '34' => '広島県',
        '35' => '山口県',
        '36' => '徳島県',
        '37' => '香川県',
        '38' => '愛媛県',
        '39' => '高知県',
        '40' => '福岡県',
        '41' => '佐賀県',
        '42' => '長崎県',
        '43' => '熊本県',
        '44' => '大分県',
        '45' => '宮崎県',
        '46' => '鹿児島県',
        '47' => '沖縄県',
    ];

    protected static $romanData = [
        '01' => 'hokkaido',
        '02' => 'aomori',
        '03' => 'iwate',
        '04' => 'miyagi',
        '05' => 'akita',
        '06' => 'yamagata',
        '07' => 'fukushima',
        '08' => 'ibaraki',
        '09' => 'tochigi',
        '10' => 'gunma',
        '11' => 'saitama',
        '12' => 'chiba',
        '13' => 'tokyo',
        '14' => 'kanagawa',
        '15' => 'niigata',
        '16' => 'toyama',
        '17' => 'ishikawa',
        '18' => 'fukui',
        '19' => 'yamanashi',
        '20' => 'nagano',
        '21' => 'gifu',
        '22' => 'shizuoka',
        '23' => 'aichi',
        '24' => 'mie',
        '25' => 'shiga',
        '26' => 'kyoto',
        '27' => 'osaka',
        '28' => 'hyogo',
        '29' => 'nara',
        '30' => 'wakayama',
        '31' => 'tottori',
        '32' => 'shimane',
        '33' => 'okayama',
        '34' => 'hiroshima',
        '35' => 'yamaguchi',
        '36' => 'tokushima',
        '37' => 'kagawa',
        '38' => 'ehime',
        '39' => 'kochi',
        '40' => 'fukuoka',
        '41' => 'saga',
        '42' => 'nagasaki',
        '43' => 'kumamoto',
        '44' => 'oita',
        '45' => 'miyazaki',
        '46' => 'kagoshima',
        '47' => 'okinawa',
    ];

    public static function getRomanName($code)
    {
        if (array_key_exists($code, static::$romanData)) {
            return static::$romanData[$code];
        }
        return null;
    }

    public static function getRomanCode($romanName)
    {
        $code = array_search($romanName, static::$romanData);
        if ($code !== false) {
            return $code;
        }
        return null;
    }
}
