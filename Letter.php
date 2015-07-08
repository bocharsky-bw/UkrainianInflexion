<?php

/**
 * Class Letter
 */
class Letter
{
    const TYPE_UNDEFINED    = 'undefined';
    const TYPE_CONSONANT    = 'consonant';
    const TYPE_VOWEL        = 'vowel';
    const TYPE_SEMIVOWEL    = 'semivowel';
    const TYPE_SIGN         = 'sign';

    /**
     * @var array
     */
    private static $alphabet = [
        'а', 'б', 'в', 'г', 'ґ',
        'д', 'е', 'є', 'ж', 'з',
        'и', 'і', 'ї', 'й', 'к',
        'л', 'м', 'н', 'о', 'п',
        'р', 'с', 'т', 'у', 'ф',
        'х', 'ц', 'ч', 'ш', 'щ',
        'ь', 'ю', 'я', '’',
    ];

    /**
     * @var array приголосні
     */
    private static $consonants = [
        'б', 'в', 'г', 'ґ', 'д',
        'ж', 'з', 'к', 'л', 'м',
        'н', 'п', 'р', 'с', 'т',
        'ф', 'х', 'ц', 'ч', 'ш',
        'щ',
    ];

    /**
     * @var array голосні
     */
    private static $vowels = [
        'а', 'е', 'є', 'и', 'і',
        'ї', 'о', 'у', 'ю', 'я',
    ];

    /**
     * @var array
     */
    private static $semivowels = [
        'й',
    ];

    /**
     * @var array
     */
    private static $signs = [
        'ь', '’',
    ];

    /**
     * @var string The original letter
     */
    private $letter;

    /**
     * @var string
     */
    private $uppercaseLetter;

    /**
     * @var string
     */
    private $lowercaseLetter;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $case;

    /**
     * @var int
     */
    private $position;

    /**
     * @param string $letter
     */
    public function __construct($letter)
    {
        $letter = (string)$letter;
        $letter = trim($letter);
        $this->uppercaseLetter = $this->convertToUpper($letter);
        $this->lowercaseLetter = $this->convertToLower($letter);
        if (!$this->isValid()) {
            throw new \InvalidArgumentException(sprintf(
                'There are no "%s" letter in Ukrainian alphabet', $letter
            ));
        }
        $this->letter = $letter;
        $this->case = $this->determineCase();
        $this->type = $this->determineType();
        $this->position = $this->determinePosition();
    }

    public function __toString()
    {
        return (string)$this->printOut();
    }

    public function printOut()
    {
        return $this->letter;
    }

    public function printLowercase()
    {
        return $this->lowercaseLetter;
    }

    public function printUppercase()
    {
        return $this->uppercaseLetter;
    }

    /**
     * @return int
     */
    public function getCase()
    {
        return $this->case;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    public function isValid()
    {
        return in_array($this->lowercaseLetter, static::$alphabet);
    }

    public function determineCase()
    {
        if (0 === strcmp($this->letter, $this->uppercaseLetter)) {
            return CASE_UPPER;
        }

        return CASE_LOWER;
    }

    public function determineType()
    {
        if (false) {
            ;
        } elseif (in_array($this->lowercaseLetter, static::$consonants)) {
            return static::TYPE_CONSONANT;
        } elseif (in_array($this->lowercaseLetter, static::$vowels)) {
            return static::TYPE_VOWEL;
        } elseif (in_array($this->lowercaseLetter, static::$semivowels)) {
            return static::TYPE_SEMIVOWEL;
        } elseif (in_array($this->lowercaseLetter, static::$signs)) {
            return static::TYPE_SIGN;
        }

        return static::TYPE_UNDEFINED;
    }

    public function determinePosition()
    {
        $keys = array_keys(static::$alphabet, $this->lowercaseLetter);

        return isset($keys[0]) ? $keys[0] + 1 : null;
    }

    public static function convertToLower($letter)
    {
        return mb_strtolower($letter);
    }

    public static function convertToUpper($letter)
    {
        return mb_strtoupper($letter);
    }

    public function isEqualTo($letter)
    {
        return 0 === strcmp($this->convertToLower($letter), $this->lowercaseLetter);
    }
}
