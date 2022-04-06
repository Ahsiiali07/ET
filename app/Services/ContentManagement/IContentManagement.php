<?php


namespace App\Services\ContentManagement;

/**
 * Interface IContentManagement
 * @package App\Services\ContentManagement
 */
interface IContentManagement {

    public const ABOUT_US = 'about_us';
    public const TERMS = 'terms_and_conditions';
    public const PRIVACY = 'privacy_policy';
    public const BANNER = 'banner';


    public const TYPE_TEXT = 1;
    public const TYPE_IMAGE = 2;
}
