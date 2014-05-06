<?php

class qsbButton extends xPDOSimpleObject {

    /**
     * {inheritdoc}
     * @param string $keyPrefix
     * @param bool $rawValues
     * @param bool $excludeLazy
     * @param bool $includeRelated
     * @return array
     */
    public function toArray($keyPrefix='', $rawValues=false, $excludeLazy=false, $includeRelated=false) {
        $arr = parent::toArray($keyPrefix, $rawValues, $excludeLazy, $includeRelated);

        // figure out the icon
        $icon = $this->getIcon();
        if(!empty($icon) && is_array($icon)) {
            switch($icon['type']) {
                case 'custom':
                    $arr['iconcls'] = '';
                    $arr['iconpath'] = $icon['value'];
                break;
                case 'preset':
                default:
                    $arr['iconcls'] = $icon['value'];
                    $arr['iconpath'] = '';
                break;
            }
        }

        return $arr;
    }

    /**
     * Figures out the icon to use
     * @return array
     */
    public function getIcon() {

        $icon_ms = $this->get('icon_ms');
        $icon_file = $this->get('icon_file');
        if(!empty($icon_ms) && !empty($icon_file)) {

            /** @var modMediaSource|modFileMediaSource $ms */
            $ms = $this->getOne('MediaSource');
            if(!empty($ms) && is_object($ms)) {
                $ms->initialize();

                $iconUrl = $ms->getObjectUrl($icon_file);
                if(!empty($iconUrl)) {
                    return array('type' => 'custom', 'value' => $iconUrl);
                }
            }
        }

        /** @var qsbIcon $icon - Fallback */
        $icon = $this->getOne('Icon');
        if(!empty($icon) && is_object($icon)) {
            return array('type' => 'preset', 'value' => $icon->get('class'));
        }

        return array('type' => 'preset', 'value' => 'fa-chevron-right');
    }
}