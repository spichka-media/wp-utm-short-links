<?php

namespace Spichka\Usl;

use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;

/**
 * Simple translation Singleton using Symfony Translation component
 */
class T
{
    private static ?Translator $t = null;

    /**
     * Initialize the translator
     * @param string $language
     * @return void
     */
    public static function init(string $language = ''): void
    {
        $translationPath = dirname(__DIR__) . '/languages/';
        $failback = 'en';

        $language = preg_replace('/_.*$/', '', $language);
        if (!$language) {
            $language = $failback;
        }
        $languagePath = "$translationPath$language.yaml";
        if (!file_exists($languagePath)) {
            $language = $failback;
        }

        self::$t = new Translator($language);
        self::$t->setLocale($language);
        self::$t->addLoader('yaml', new YamlFileLoader());

        $languagePath = "$translationPath$language.yaml";
        if (!file_exists($languagePath)) {
            $language = $failback;
            $languagePath = "$translationPath$failback.yaml";
        }

        self::$t->addResource('yaml', $languagePath, $language);

        if ($language !== $failback) {
            self::$t->setFallbackLocales([$failback]);
            self::$t->addResource(
                'yaml',
                "$translationPath$failback.yaml",
                $failback
            );
        }
    }

    /**
     * Translate string by id
     * @param string $id
     * @return string
     */
    public static function t(string $id): string
    {
        return self::$t->trans($id);
    }
}
