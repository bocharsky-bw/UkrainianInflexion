<?php

/**
 * Class Word
 */
class Word implements Countable
{
    const POS_UNDEFINED     = 'undefined';

    // ЗМІНЮВАНІ ЧАСТИНИ МОВИ:
    /**
     * іменник
     */
    const POS_NOUN          = 'noun';

    /**
     * прикметник
     */
    const POS_ADJECTIVE     = 'adjective';

    /**
     * числівник
     */
    const POS_NUMERAL       = 'numeral';

    /**
     * займенник
     */
    const POS_PRONOUN       = 'pronoun';

    /**
     * дієслово
     */
    const POS_VERB          = 'verb';

    // НЕЗМІНЮВАНІ ЧАСТИНИ МОВИ:
    /**
     * прислівник
     */
    const POS_ADVERB        = 'adverb';

    /**
     * сполучник
     */
    const POS_CONJUNCTION   = 'conjunction';

    /**
     * прийменник
     */
    const POS_PREPOSITION   = 'preposition';

    /**
     * частка
     */
    const POS_FRACTION      = 'fraction';

    /**
     * вигук
     */
    const POS_EXCLAMATION   = 'exclamation';

    /**
     * @var string
     */
    private $word;

    /**
     * @var string
     */
    private $uppercaseWord;

    /**
     * @var string
     */
    private $lowercaseWord;

    /**
     * @var Letter[]|array
     */
    private $letters = [];

    /**
     * @var Letter[]|array
     */
    private $reversedLetters = [];

    /**
     * @var string
     */
    private $partOfSpeech;

    /**
     * @param string $word
     */
    public function __construct($word)
    {
        $this->word = trim($word);
        $this->uppercaseWord = mb_strtoupper($this->word);
        $this->lowercaseWord = mb_strtolower($this->word);
        $letters = preg_split('//u', $this->word, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($letters as $letter) {
            $this->letters[] = new Letter($letter);
        }
        $this->reversedLetters = array_reverse($this->letters);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->letters);
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->count();
    }

    /**
     * Check whether word is verb (дієслово)
     *
     * @return bool Check only infinitive verb
     */
    public function isVerb()
    {
        if (true
            // -ти (писати, говорити, літати, гриміти, мерзнути, дивувати)
            and 2 < $this->getLength()
            and $this->reversedLetters[1]->isEqualTo('т')
            and $this->reversedLetters[0]->isEqualTo('и')
        ) {
            return true;
        }

        return false;
    }

    /**
     * Check whether word is noun (іменник)
     *
     * @return bool Check only infinitive noun
     */
    public function isNoun()
    {
        $length = $this->getLength();

        // -ість (якість, щедрість, духовність)
        if (true
            and 4 < $length
            and $this->reversedLetters[3]->isEqualTo('і')
            and $this->reversedLetters[2]->isEqualTo('с')
            and $this->reversedLetters[1]->isEqualTo('т')
            and $this->reversedLetters[0]->isEqualTo('ь')
        ) {
            return true;
        }

        // -ство (суспільство, студентство)
        if (true
            and 4 < $length
            and $this->reversedLetters[3]->isEqualTo('с')
            and $this->reversedLetters[2]->isEqualTo('т')
            and $this->reversedLetters[1]->isEqualTo('в')
            and $this->reversedLetters[0]->isEqualTo('о')
        ) {
            return true;
        }

        // -цтво (мистецтво, керівництво)
        if (true
            and 4 < $length
            and $this->reversedLetters[3]->isEqualTo('ц')
            and $this->reversedLetters[2]->isEqualTo('т')
            and $this->reversedLetters[1]->isEqualTo('в')
            and $this->reversedLetters[0]->isEqualTo('о')
        ) {
            return true;
        }

        // -зтво (боягузтво, убозтво)
        if (true
            and 4 < $length
            and $this->reversedLetters[3]->isEqualTo('з')
            and $this->reversedLetters[2]->isEqualTo('т')
            and $this->reversedLetters[1]->isEqualTo('в')
            and $this->reversedLetters[0]->isEqualTo('о')
        ) {
            return true;
        }

        // -ота (спільнота, гризота)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('о')
            and $this->reversedLetters[1]->isEqualTo('т')
            and $this->reversedLetters[0]->isEqualTo('а')
        ) {
            return true;
        }

        // -ння (вміння, навчання)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('н')
            and $this->reversedLetters[1]->isEqualTo('н')
            and $this->reversedLetters[0]->isEqualTo('я')
        ) {
            return true;
        }

        // -ття (почуття, сприйняття)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('т')
            and $this->reversedLetters[1]->isEqualTo('т')
            and $this->reversedLetters[0]->isEqualTo('я')
        ) {
            return true;
        }

        // -изм (ліризм, класицизм)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('и')
            and $this->reversedLetters[1]->isEqualTo('з')
            and $this->reversedLetters[0]->isEqualTo('м')
        ) {
            return true;
        }

        // -ізм (реалізм)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('і')
            and $this->reversedLetters[1]->isEqualTo('з')
            and $this->reversedLetters[0]->isEqualTo('м')
        ) {
            return true;
        }

        // -їзм (героїзм)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('ї')
            and $this->reversedLetters[1]->isEqualTo('з')
            and $this->reversedLetters[0]->isEqualTo('м')
        ) {
            return true;
        }

        // -ощі (пустощі, прикрощі)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('о')
            and $this->reversedLetters[1]->isEqualTo('щ')
            and $this->reversedLetters[0]->isEqualTo('і')
        ) {
            return true;
        }

        // -ва (мушва, братва)
        if (true
            and 2 < $length
            and $this->reversedLetters[1]->isEqualTo('в')
            and $this->reversedLetters[0]->isEqualTo('а')
        ) {
            return true;
        }

        // -ина (озимина, городина)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('и')
            and $this->reversedLetters[1]->isEqualTo('н')
            and $this->reversedLetters[0]->isEqualTo('а')
        ) {
            return true;
        }

        // -ник (чагарник)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('н')
            and $this->reversedLetters[1]->isEqualTo('и')
            and $this->reversedLetters[0]->isEqualTo('к')
        ) {
            return true;
        }

        // -няк (сосняк)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('н')
            and $this->reversedLetters[1]->isEqualTo('я')
            and $this->reversedLetters[0]->isEqualTo('к')
        ) {
            return true;
        }

        // -еча (стареча, малеча)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('е')
            and $this->reversedLetters[1]->isEqualTo('ч')
            and $this->reversedLetters[0]->isEqualTo('а')
        ) {
            return true;
        }

        // -ія (братія, адміністрація)
        if (true
            and 2 < $length
            and $this->reversedLetters[1]->isEqualTo('і')
            and $this->reversedLetters[0]->isEqualTo('я')
        ) {
            return true;
        }

        // -іка (символіка)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('і')
            and $this->reversedLetters[1]->isEqualTo('к')
            and $this->reversedLetters[0]->isEqualTo('а')
        ) {
            return true;
        }

        // -ика (проблематика)
        if (true
            and 3 < $length
            and $this->reversedLetters[2]->isEqualTo('и')
            and $this->reversedLetters[1]->isEqualTo('к')
            and $this->reversedLetters[0]->isEqualTo('а')
        ) {
            return true;
        }

        // -арій (розарій, гербарій)
        if (true
            and 4 < $length
            and $this->reversedLetters[3]->isEqualTo('а')
            and $this->reversedLetters[2]->isEqualTo('р')
            and $this->reversedLetters[1]->isEqualTo('і')
            and $this->reversedLetters[0]->isEqualTo('й')
        ) {
            return true;
        }

        // -іана (Франкіана)
        if (true
            and 4 < $length
            and $this->reversedLetters[3]->isEqualTo('і')
            and $this->reversedLetters[2]->isEqualTo('а')
            and $this->reversedLetters[1]->isEqualTo('н')
            and $this->reversedLetters[0]->isEqualTo('а')
        ) {
            return true;
        }

        return false;
    }

    /**
     * Check whether word is adjective (прикметник)
     *
     * @return bool
     */
    public function isAdjective()
    {
        if (true
            // я, ти, він
            // -ий (добрий, милий, довгий, міцний, малий)
            and 2 < $this->getLength()
            and $this->reversedLetters[1]->isEqualTo('и')
            and $this->reversedLetters[0]->isEqualTo('й')
        ) {
            return true;
        }

        if (true
            // вона
            // -а (добра, мила, довга, міцна, мала)
            and 1 < $this->getLength()
            and $this->reversedLetters[0]->isEqualTo('а')
        ) {
            return true;
        }

        if (true
            // воно
            // -е (добре, миле, довге, міцне, мале)
            and 1 < $this->getLength()
            and $this->reversedLetters[0]->isEqualTo('е')
        ) {
            return true;
        }

        if (true
            // ми, ви, вони
            // -і (добрі, милі, довгі, міцні, малі)
            and 1 < $this->getLength()
            and $this->reversedLetters[0]->isEqualTo('і')
        ) {
            return true;
        }

        return false;
    }

    /**
     * Check whether word is numeral (числівник)
     *
     * @return bool
     */
    public function isNumeral()
    {
        // (три, одинадцять, тридцять чотири, семеро, три восьмих)

        return false;
    }

    /**
     * Check whether word is pronoun (займенник)
     *
     * @return bool
     */
    public function isPronoun()
    {
        // особові (я, ми, ти, ви, він, вона, воно, вони)
        if (in_array($this->lowercaseWord, ['я', 'ми', 'ти', 'ви', 'він', 'вона', 'воно', 'вони'])) {
            return true;
        }

        // зворотний (себе)
        // взаємні (одне одного, одне другого)
        // присвійні (мій, твій, ваш, наш, його, її, їхній)
        // вказівні (цей, сей, осей, той, такий)
        // означальні (весь, всякий, кожен, самий, сам, жодний, інший)
        // питальні (хто?, що?, скільки?, котрий?, чий?)
        // відносні (хто, що, скільки, котрий, чий)
        // неозначені (абихто, абищо, деякий, дечий, хтось, щось, котрийсь, будь-хто, будь-що, скільки-небудь, казна-скільки, хтозна-як)
        // заперечні (ніхто, ніщо, ніяк, ніскільки, аніщо, ані-чий, аніякий)

        return false;
    }

    /**
     * @return Letter[]|array
     */
    public function getLetters()
    {
        return $this->letters;
    }

    /**
     * @return Letter[]|array
     */
    public function getReversedLetters()
    {
        return $this->reversedLetters;
    }
}
