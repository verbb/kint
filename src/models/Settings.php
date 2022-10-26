<?php
namespace verbb\kint\models;

use craft\base\Model;

class Settings extends Model
{
    // Properties
    // =========================================================================

    public array $kintSettings = [];
    public array $richRendererSettings = [];

    // TODO: to remove
    public string $kintDisplayTheme = 'original.css';


    // Public Methods
    // =========================================================================

    public function getKintSettings()
    {
        $defaults = ['aliases' => ['time']];

        return array_merge_recursive($defaults, $this->kintSettings);
    }

    public function getRichRendererSettings()
    {
        $defaults = ['theme' => 'original.css'];

        return array_merge_recursive($defaults, $this->richRendererSettings);
    }

}
