<?php

namespace app\models;

use app\helpers\StringHelper;

/**
 * Random generated post
 *
 * @author ilya
 */
class RandomPost extends Post
{
 
    /**
     * Minimum date
     * 01.01.2017
     */
    const DATE_CREATED_MIN = 1483228800;
    
    /**
     * Maximum date
     * 08.08.2017
     */
    const DATE_CREATED_MAX = 1502150400;
    
    /**
     * Minimum words in title
     */
    const TITLE_WORDS_MIN = 4;
    
    /**
     * Maximum words in title
     */
    const TITLE_WORDS_MAX = 6;
    
    /**
     * Title words by language id
     */
    const TITLE_WORDS_BY_LANG = [
        1 => ["жесть", "удивительно", "снова", "совсем", "шок", "случай", "сразу", "событие", "начало", "вирус"],
        2 => ["currency", "amazing", "again", "absolutely", "shocking", "case", "immediately", "event", "beginning", "virus"],
    ];
    
    /**
     * Minimum sentences
     */
    const TEXT_SENTENCES_MIN = 3;
    
    /**
     * Maximum sentences
     */
    const TEXT_SENTENCES_MAX = 4;
    
    /**
     * Minimum words in sentence
     */
    const TEXT_WORDS_IN_SENTENCE_MIN = 5;
    
    /**
     * Maximum words in sentence
     */
    const TEXT_WORDS_IN_SENTENCES_MAX = 8;
    
    const LIKES_MIN = 1;
    
    const LIKES_MAX = 9999;

    /**
     * Text words by language id
     */
    const TEXT_WORDS_BY_LANG = [
        1 => ["один", "еще", "бы", "такой", "только", "себя", "свое", "какой", "когда", "уже", "для", "вот", "кто", "да", "говорить", "год", "знать", "мой", "до", "или", "если", "время", "рука", "нет", "самый", "ни", "стать", "большой", "даже", "другой", "наш", "свой", "ну", "под", "где", "дело", "есть", "сам", "раз", "чтобы", "два", "там", "чем", "глаз", "жизнь", "первый", "день", "тута", "во", "ничто", "потом", "очень", "со", "хотеть", "ли", "при", "голова", "надо", "без", "видеть", "идти", "теперь", "тоже", "стоять", "друг", "дом", "сейчас", "можно", "после", "слово", "здесь", "думать", "место", "спросить", "через", "лицо", "что", "тогда", "ведь", "хороший", "каждый", "новый", "жить", "должный", "смотреть", "почему", "потому", "сторона", "просто", "нога", "сидеть", "понять", "иметь", "конечный", "делать", "вдруг", "над", "взять", "никто", "сделать"],
        2 => ["one", "yet", "would", "such", "only", "yourself", "his", "what", "when", "already", "for", "behold", "Who", "yes", "speak", "year", "know", "my", "before", "or", "if", "time", "arm", "no", "most", "nor", "become", "big", "even", "other", "our", "his", "well", "under", "where", "a business", "there is", "himself", "time", "that", "two", "there", "than", "eye", "a life", "first", "day", "mulberry", "in", "nothing", "later", "highly", "with", "to want", "whether", "at", "head", "need", "without", "see", "go", "now", "also", "stand", "friend", "house", "now", "can", "after", "word", "here", "think", "a place", "ask", "across", "face", "what", "then", "after all", "good", "each", "new", "live", "due", "look", "why", "because", "side", "just", "leg", "sit", "understand", "have", "finite", "do", "all of a sudden", "above", "to take", "no one", "make"],
    ];

    /**
     * Generates random post
     * @param integer $languageId
     * @param integer $authorId
     */
    public static function generate(int $languageId, int $authorId) : self
    {
        $model = new self([
            'languageId' => $languageId,
            'authorId' => $authorId,
        ]);
        $model->generateDateCreated();
        $model->generateTitle();
        $model->generateText();
        $model->generateLikes();
        
        return $model;
    }
    
    /**
     * Generated random date
     */
    protected function generateDateCreated()
    {
        $this->dateCreated = mt_rand(self::DATE_CREATED_MIN, self::DATE_CREATED_MAX);
    }
    
    /**
     * Generated random title
     */
    protected function generateTitle()
    {
        $this->title = $this->randomSentence(self::TITLE_WORDS_MIN, self::TITLE_WORDS_MAX, self::TITLE_WORDS_BY_LANG[$this->languageId]);
    }
    
    protected function generateText()
    {
        $data = self::TEXT_WORDS_BY_LANG[$this->languageId];
        $sentencesCount = mt_rand(self::TEXT_SENTENCES_MIN, self::TEXT_SENTENCES_MAX);
        $sentences = [];
        while (count($sentences) < $sentencesCount) {
            $sentences[] = $this->randomSentence(self::TEXT_WORDS_IN_SENTENCE_MIN, self::TEXT_WORDS_IN_SENTENCES_MAX, self::TEXT_WORDS_BY_LANG[$this->languageId]);
        }
        $this->text = implode('. ', $sentences).'.';
    }
    
    protected function randomSentence(int $minWords, int $maxWords, array $data) : string
    {
        $wordsCount = mt_rand($minWords, $maxWords);
        $words = [];
        while (count($words) < $wordsCount) {
            $word = $data[array_rand($data)];
            if (!in_array($word, $words)) {
                $words[] = $word;
            }
        }
        return StringHelper::ucfirst(implode(' ', $words));
    }
    
    protected function generateLikes()
    {
        $this->likesCount = mt_rand(self::LIKES_MIN, self::LIKES_MAX);
    }
    

}
