<?php
namespace app\models;
use yii\base\Model;

class Str extends Model{
    public $str;
    public $arrRussianLettersToLatin = [
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'yo',
        'ж' => 'j',
        'з' => 'z',
        'и' => 'i',
        'й' => 'i',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sh',
        'ъ' => '',
        'ы' => 'i',
        'ь' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya'
    ];

    public function rules(){
        return [
            [['str'], 'required'],
            [['str'], 'string', 'max' => 300],
        ];
    }

    public function strToArray($separator){
        if($this->str){
            $tempStr = $this->str;                        
            $tempArr = [];
            $tempArr = explode($separator, $tempStr);
            return $tempArr;
        }else{
            return ["Invalid input string"];
        }
    }

    public function cutStr(){
        $arrFromStr = $this->strToArray(' ');
        if(count($arrFromStr) <= 12){
            return implode(' ', $arrFromStr)." Количество слов во входной строке меньше или равно 12, строка не была изменена.";
        }
        $result = [];
        $i = 0;
        foreach($arrFromStr as $value){
            if($value && $i < 12){
                array_push($result, $value);
                $i++;
            }
        }        
        return implode(' ', $result);               
    }

    public function capitalizeWords(){
        $arrFromStr = $this->strToArray('_');
        if(count($arrFromStr) <= 1){
            return implode('', $arrFromStr)." Входная строка не соответвует формату и не была изменена.";
        }
        $result = [];
        foreach($arrFromStr as $value){
            if($value){ 
                $tempArr = $this->str_split_unicode($value);
                $tempArr[0] = mb_strtoupper($tempArr[0], 'UTF-8');
                $tempStr = implode('', $tempArr);              
                array_push($result, $tempStr);
            }            
        }        
        return implode('', $result);               
    }

    function str_split_unicode($str, $l = 0) {
        if ($l > 0) {
            $ret = array();
            $len = mb_strlen($str, "UTF-8");
            for ($i = 0; $i < $len; $i += $l) {
                $ret[] = mb_substr($str, $i, $l, "UTF-8");
            }
            return $ret;
        }
        return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function latinStr(){
        $tempStr = $this->str;
        $tempStr = $this->str_split_unicode($tempStr);       
        $result = "";
        for($i = 0; $i < count($tempStr); $i++){
            if(preg_match('/[а-яА-Я]/', $tempStr[$i])){
                $chStr = $tempStr[$i];
                $chStr = mb_strtolower($chStr, 'UTF-8');              
                if($chStr != $tempStr[$i]){                                    
                    $ch = $this->changeLetters($chStr);                    
                    $ch  = mb_strtoupper($ch, 'UTF-8');
                    $result = $result.$ch;                                      
                }else{ 
                    $ch = $this->changeLetters($tempStr[$i]);                  
                    $result = $result.$ch;                    
                }
            }else{                
                $result = $result.$tempStr[$i];                
            }
        }        
        return $result;
    }

    public function changeLetters($chRus){
        $arrOfLetters = $this->arrRussianLettersToLatin;
        $chLatin = "";
        foreach($arrOfLetters as $key=>$value){
            if($key == $chRus){                
                $chLatin = $value;                
            }
        }
        return $chLatin;
    }
}
