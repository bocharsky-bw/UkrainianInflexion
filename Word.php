<?php

/**
 * Class Word
 */
class Word implements Countable
{
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
