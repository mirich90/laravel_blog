<?
class Upload
{
    function __construct()
    {
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777);
        }

        $this->saveFile($_FILES);
    }

    private function saveFile($files)
    {
        $type = $this->getExtensionFile($files);
        $nameImg = $this->translitSrc($files['file']['name']);
        $path = "uploads/img/posts/$nameImg.$type";
        move_uploaded_file($files['file']['tmp_name'], $path);
        echo  "/" . $path;
    }

    private function translit($str)
    {
        $converter = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
        );

        $str = mb_strtolower($str);
        $str = strtr($str, $converter);
        $str = mb_ereg_replace('[^-0-9a-z]', '-', $str);
        $str = mb_ereg_replace('[-]+', '-', $str);
        $str = trim($str, '-');

        return $str;
    }

    private function translitSrc($str)
    {
        $image_name =  $this->translit($str);
        $random = random_int(100, 999);
        $date = date('Ymd_His_');
        $src = $date . $random . "_$image_name";
        return $src;
    }

    private function getExtensionFile($file)
    {
        $type_file = explode('/', $file['file']['type'])[1];
        return $type_file;
    }
}

new Upload();
