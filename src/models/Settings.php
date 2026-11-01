<?php
namespace verbb\kint\models;

use craft\base\Model;

class Settings extends Model
{
    // Properties
    // =========================================================================

    public array $kintSettings = [];
    public array $richRendererSettings = [];
    public string $kintDisplayTheme = 'original.css';


    // Public Methods
    // =========================================================================

    public function getKintSettings(): array
    {
        $defaults = ['aliases' => ['time']];

        return array_replace_recursive($defaults, $this->kintSettings);
    }

    public function getRichRendererSettings(): array
    {
        $defaults = ['theme' => $this->kintDisplayTheme];

        return array_replace_recursive($defaults, $this->richRendererSettings);
    }

}
