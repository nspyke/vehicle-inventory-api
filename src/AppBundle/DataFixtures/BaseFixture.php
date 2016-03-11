<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-api
 * @category fixtures
 * @since 2015.05.27
 */

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;

abstract class BaseFixture extends AbstractFixture
{
    protected $uniqueValues;

    /**
     * Generate random pronounceable words
     *
     * @param int $min Min word length
     * @param int $max Max word length
     * @return string Random word
     */
    protected function randomPronounceableWord($min = 1, $max = 6)
    {
        $length = mt_rand($min, $max);
        // consonant sounds
        $cons = array(
            // single consonants. Beware of Q, it's often awkward in words
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'z',
            // possible combinations excluding those which cannot start a word
            'pt', 'gl', 'gr', 'ch', 'ph', 'ps', 'sh', 'st', 'th', 'wh',
        );

        // consonant combinations that cannot start a word
        $cons_cant_start = array(
            'ck', 'cm',
            'dr', 'ds',
            'ft',
            'gh', 'gn',
            'kr', 'ks',
            'ls', 'lt', 'lr',
            'mp', 'mt', 'ms',
            'ng', 'ns',
            'rd', 'rg', 'rs', 'rt',
            'ss',
            'ts', 'tch',
        );

        // wovels
        $vows = array(
            // single vowels
            'a', 'e', 'i', 'o', 'u', 'y',
            // vowel combinations your language allows
            'ee', 'oa', 'oo',
        );

        // start by vowel or consonant ?
        $current = ( mt_rand( 0, 1 ) == '0' ? 'cons' : 'vows' );

        $word = '';

        while( strlen( $word ) < $length ) {

            // After first letter, use all consonant combos
            if( strlen( $word ) == 2 )
                $cons = array_merge( $cons, $cons_cant_start );

            // random sign from either $cons or $vows
            $rnd = ${$current}[ mt_rand( 0, count( ${$current} ) -1 ) ];

            // check if random sign fits in word length
            if( strlen( $word . $rnd ) <= $length ) {
                $word .= $rnd;
                // alternate sounds
                $current = ( $current == 'cons' ? 'vows' : 'cons' );
            }
        }

        return $word;
    }

    protected function uniqueRandomWord($field, $min, $max)
    {
        if (!isset($this->uniqueValues[$field])) {
            $this->uniqueValues[$field] = [];
        }

        do {
            $word = $this->randomPronounceableWord($min, $max);
        } while (in_array($word, $this->uniqueValues[$field]));

        $this->uniqueValues[$field][] = $word;

        return $word;
    }
}