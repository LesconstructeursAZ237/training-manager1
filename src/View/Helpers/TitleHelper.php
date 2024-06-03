<?php

/**
 * PHP Skeleton app
 * Minimum structure for native PHP web apps development
 * 
 * @copyright Copyright (c) Silevester D. (https://github.com/SilverD3)
 * @link      https://github.com/devacademia/php-skeleton-ap PHP Skeleton App
 * @since     v1.0 (2024)
 */

declare(strict_types=1);

namespace App\View\Helpers;

/**
 * Helper for view pages titles
 */
class TitleHelper
{
    private string $app_name = "PHP Skeleton App";

    public function getTitle(): string
    {
        $page_title = '';

        if (isset($_SESSION["subpage_title"])) {
            $page_title .= $_SESSION["subpage_title"];
        }

        if (isset($_SESSION["page_title"])) {
            $page_title .= empty($page_title) ? $_SESSION["page_title"] : ' | ' . $_SESSION["page_title"];
        }

        if (empty($page_title)) {
            $page_title .= $this->app_name;
        } else {
            $page_title .= ' | ' . $this->app_name;
        }

        return $page_title;
    }

    /**
     * Get the App name
     */
    public function getAppName()
    {
        return $this->app_name;
    }

    /**
     * Set the App name
     *
     * @return  self
     */
    public function setAppName($app_name)
    {
        $this->app_name = $app_name;

        return $this;
    }
}
