<?php

/**
 * Allows global configuration of all changes
 */
class VersionFeedSiteConfig extends DataExtension
{
    
    private static $db = array(
        'AllChangesEnabled' => 'Boolean(true)'
    );

    private static $defaults = array(
        'AllChangesEnabled' => true
    );

    public function updateFieldLabels(&$labels)
    {
        $labels['AllChangesEnabled'] = _t('VersionFeedSiteConfig.ALLCHANGESLABEL', 'Make global changes feed public');
    }
    
    public function updateCMSFields(\FieldList $fields)
    {
        if (!Config::inst()->get('VersionFeed', 'allchanges_enabled')) {
            return;
        }

        $fields->addFieldToTab('Root.Access',
            FieldGroup::create(new CheckboxField('AllChangesEnabled', $this->owner->fieldLabel('AllChangesEnabled')))
                ->setTitle(_t('VersionFeedSiteConfig.ALLCHANGES', 'All page changes'))
                ->setDescription(_t(
                    'VersionFeed.Warning',
                    "Publicising the history will also disclose the changes that have at the time been protected " .
                    "from the public view."
                ))
        );
    }
}
