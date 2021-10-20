<?php

namespace App\Helpers;
// ----------------------------------------------------------------------
// Class Name: 	Hejrah Date
// Filename:   	ArDate.class.php
// Author: 		abdulla Assaggaf <abbdulla@gmail.com>
// Function:    Class to represent hejrah date and arabiv date
// ----------------------------------------------------------------------
class Adate
{
    public $now;
    public $hd;
    public $hm;
    public $hy;
    public $ArabicDay    = array('Sat' => 'السبت', 'Sun' => 'الأحد', 'Mon' => 'الأثنين', 'Tue' => 'الاثلاثاء', 'Wed' => 'الأربعاء', 'Thu' => 'الخميس', 'Fri' => 'الجمعة');
    public $HejrahMonth  = array(1 => 'محرم', 'صفر', 'ربيع أول', 'ربيع ثاني', 'جماد أول', 'جماد ثاني', 'رجب', 'شعبان', 'رمضان', 'شوال', 'ذو القعدة', 'ذو الحجة');
    public $ArabicMonth  = array(1 => 'يناير', 'فبراير', 'مارس', 'ابريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر');
    public $ArabicMonth2 = array(1 => 'كانون ثاني', 'شباط', 'آذار', 'نيسان', 'أيار', 'حزيران', 'تموز', 'آب', 'أيلول', 'تشرين أول', 'تشرين ثاني', 'كانون أول');
    public $AmPm = array('am' => 'صباحا', 'pm' => 'مساء');


    function __construct()
    {
        $this->now = time();
    }

    /*
    **
    ** format character:-
    ** K : Hejrah Year (1426)
    ** Q : Hejrah Month (محرم)
    ** q : Hejrah Month (1-12)
    ** x : Hejrah day (1-30)
    ** f : Arabic Day (السبت)
    ** e : Arabic Month (يناير - ديسمبر)
    ** E : Arabic Month (كانون ثاني - كانون أول)
    ** b : Ante meridiem and Post meridiem in Arabic (صباحا - مساء)
    */
    function date($format, $ts = 0)
    {
        $result = '';
        if ($ts == 0) {
            $ts = $this->now;
        }
        $a = getdate($ts);
        $this->hijrah($ts);
        for ($i = 0; $i < strlen($format); $i++) {
            $part = $format[$i];
            switch ($part) {
                case 'a':
                case 'A':
                case 'B':
                case 'c':
                case 'D':
                case 'F':
                case 'G':
                case 'g':
                case 'H':
                case 'h':
                case 'I':
                case 'i':
                case 'j':
                case 'l':
                case 'L':
                case 'M':
                case 'm':
                case 'n':
                case 'O':
                case 'r':
                case 'S':
                case 's':
                case 'T':
                case 't':
                case 'U':
                case 'W':
                case 'w':
                case 'Y':
                case 'y':
                case 'd':
                case 'Z':
                case 'z':
                    $result .= date($part, $ts);
                    break;
                case 'f':
                    $z = date('D', $ts);
                    $result .= $this->ArabicDay[$z];
                    break;
                case 'Q':
                    $result .= $this->HejrahMonth[$this->hm];
                    break;
                case 'q':
                    $result .= $this->hm;
                    break;
                case 'K':
                    $result .= $this->hy;
                    break;
                case 'e':
                    $z = date('n', $ts);
                    $result .= $this->ArabicMonth[$z];
                    break;
                case 'E':
                    $z = date('n', $ts);
                    $result .= $this->ArabicMonth2[$z];
                    break;
                case 'x':
                    $result .= $this->hd;
                    break;
                case ' ':
                    $result .= ' ';
                    break;
                case 'b':
                    $z = date('a', $ts);
                    $result .= $this->AmPm[$z];
                    break;
                case '\\':
                    $result .= $format[++$i];
                    break;
                default:
                    $result .= $part;
            }
        }
        return $result;
    }

    /*
    **
    **
    **
    */
    function hijrah($ts = 0)
    {
        if ($ts == 0) {
            $ts = $this->now;
        }
        list($d, $m, $y) = explode(' ', date('d m Y', $ts));
        if (($y > 1582) || (($y == 1582) && ($m > 10)) || (($y == 1582) && ($m == 10) && ($d > 14))) {
            $jd  = $this->ard_int((1461 * ($y + 4800 + $this->ard_int(($m - 14) / 12))) / 4);
            $jd += $this->ard_int((367 * ($m - 2 - 12 * ($this->ard_int(($m - 14) / 12)))) / 12);
            $jd -= $this->ard_int((3 * ($this->ard_int(($y + 4900 + $this->ard_int(($m - 14) / 12)) / 100))) / 4);
            $jd += $d - 32075;
        } else {
            $jd = 367 * $y - $this->ard_int((7 * ($y + 5001 + $this->ard_int(($m - 9) / 7))) / 4) + $this->ard_int((275 * $m) / 9) + $d + 1729777;
        }
        $l = $jd - 1948440 + 10632;
        $n = $this->ard_int(($l - 1) / 10631);
        $l = $l - 10631 * $n + 355;
        $j = ($this->ard_int((10985 - $l) / 5316)) * ($this->ard_int((50 * $l) / 17719)) + ($this->ard_int($l / 5670)) * ($this->ard_int((43 * $l) / 15238));
        $l = $l - ($this->ard_int((30 - $j) / 15)) * ($this->ard_int((17719 * $j) / 50)) - ($this->ard_int($j / 16)) * ($this->ard_int((15238 * $j) / 43)) + 29;
        $this->hm = $this->ard_int((24 * $l) / 709);
        $this->hd = $l - $this->ard_int((709 * $this->hm) / 24);
        $this->hy = 30 * $n + $j - 30;
    }

    function ard_int($float)
    {
        return ($float < -0.0000001) ? ceil($float - 0.0000001) : floor($float + 0.0000001);
    }

    public function htom($date)
    {
        $month = (int) explode('-', $date)[1];
        $day = (int) explode('-', $date)[2];
        $year = (int) explode('-', $date)[0];

        $new = floor((11 * $year + 3) / 30) + floor(354 * $year) + floor(30 * $month)
            - floor(($month - 1) / 2) + $day + 1948440 - 386;


        return date('Y-m-d', strtotime(jdtogregorian($new)));
    }
}
