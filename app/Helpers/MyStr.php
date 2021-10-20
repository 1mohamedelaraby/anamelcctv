<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;

class MyStr
{
    /**
     * Create slug for any title
     * @param mixed $string
     * @param string $separator
     * 
     * @return String slug style string
     */
    public static function slug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }

        // Remove spaces from the beginning and from the end of the string
        $string = trim($string);

        $string = strip_tags($string);

        $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');

        // Lower case everything
        // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
        $string = mb_strtolower($string, "UTF-8");

        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and arabic charactrs as well
        //$string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace('~[^\\pL\d ]+~u', '', $string);


        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }

    /**
     *  Remove Tashkeel from arabic string
     * @param String: string with tashkeel
     * @return String without Taskeel 
     */
    public static function removeTashkeel($string)
    {
        return preg_replace("~[\x{064B}-\x{065B}]~u", "", $string);
    }

    /**
     * @param mixed $string
     * @param boolean $limit
     * 
     * @return String cleared string
     */
    public static function clear($string, $limit = false)
    {
        $string = self::slug($string);
        $string = str_replace("-", ' ', $string);
        $string = !$limit ? $string : mb_substr($string, 0, $limit);

        return $string;
    }


    /**
     * Upload image using Intervention\Image package
     * @param mixed $file $_FILES['name']['tmp_name']
     * @param mixed $path where to store the image
     * @param null $thumbnail_path where to store the thumbnail
     * @param integer $width width of image
     * @param integer $height height of image
     * @param integer $thumbnail_width 
     * @param integer $thumbnail_height
     * 
     * @return void
     */
    public static function uploadImage($file, $path, $thumbnail_path = null, $width = 0, $height = 0, $thumbnail_width = 0, $thumbnail_height = 0)
    {
        $img = Image::make($file);
        if ($width) {
            $img->resize($width, $height, function ($c) {
                $c->aspectRatio();
            });
        }
        $img->save($path);
        if ($thumbnail_path) {
            $img->resize($thumbnail_width, $thumbnail_height);
            $img->save($thumbnail_path);
        }
    }

    /**
     * @param mixed $link: Youtube link
     * 
     * @return String $id youtube video id
     */
    public static function getYoutubeId($link)
    {
        if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches)) {
            return $id = $matches[0];
        }

        return false;
    }

    /**
     * @param mixed $link youtube video url
     * @param string $size ['0', 'default', 'mqdefault', 'hqdefault']
     * 
     * @return img return img tag with youtube thumbnail
     */
    public static function getYoutubeImg($link, $size = '0')
    {
        // sizes ('0', 'default', 'mqdefault', 'hqdefault')
        $id = SELF::getYoutubeId($link);
        $src = 'https://img.youtube.com/vi/' . $id . '/' . $size . '.jpg';
        return '<img src="' . $src . '" class="img-fluid img-thumbnail">';
    }

    /**
     * @param mixed $link youtube video link
     * 
     * @return iframe embeded youtube video
     */
    public static function getYoutubeEmbed($link, $autoPlay = 1)
    {
        $src = SELF::getVideoSrc($link, $autoPlay);
        //return '<div id="player" data-plyr-provider="youtube" data-plyr-embed-id="https://www.youtube.com/watch?v=j6YCaCaXtUc"></div>';
        return '
        <div class="relative h-0 pb-fluid-video" id="player">
            <iframe class="absolute top-0 left-0 w-full h-full" src="' . $src . '"></iframe>
        </div>
        ';
    }

    public static function getVideoSrc($link, $autoPlay = 1)
    {
        $id = SELF::getYoutubeId($link);
        return 'https://www.youtube.com/embed/' . $id . '?autoplay=' . $autoPlay . '&origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1';
    }

    /**
     * using Adate class
     * @param mixed $format (format character)
     * @param timestamp $ts timestamp
     * format character:-
     * K : Hejrah Year (1426)
     * Q : Hejrah Month (محرم)
     * q : Hejrah Month (1-12)
     * x : Hejrah day (1-30)
     * f : Arabic Day (السبت)
     * e : Arabic Month (يناير - ديسمبر)
     * E : Arabic Month (كانون ثاني - كانون أول)
     * b : Ante meridiem and Post meridiem in Arabic (صباحا - مساء)
     * @return Date Arabic date
     */
    public static function adate($format, $ts = 0)
    {
        $adate = new Adate;
        return $adate->date($format, $ts);
    }

    public static function getHadith($text)
    {
        $text = urlencode($text);
        $r = file_get_contents('https://dorar.net/dorar_api.json?skey=' . $text);
        $r = json_decode($r);

        $r = $r->ahadith->result;
        $r = explode('--------------', $r);

        array_pop($r);

        return $r;
    }
}
