<?php namespace Modules\Setting\Support;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Setting\Repositories\SettingRepository;

class Reader
{
    /**
     * @var SettingRepository
     */
    private $setting;

    /**
     * @param SettingRepository $setting
     */
    public function __construct(SettingRepository $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Return the setting
     * @param $setting
     * @return mixed
     */
    public function read($setting)
    {
        $setting = $this->setting->get($setting);

        if ($setting->isTranslatable) {
            foreach (LaravelLocalization::getSupportedLocales() as $locale => $language) {
                $settings[$locale] = $setting->translate($locale)->value;
            }
            return $settings;
        }

        return $setting->plainValue;
    }
}
