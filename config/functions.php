<?php

/**
 * PHP Skeleton app
 * Minimum structure for native PHP web apps development
 * 
 * @copyright Copyright (c) Silevester D. (https://github.com/SilverD3)
 * @link      https://github.com/devacademia/php-skeleton-ap PHP Skeleton App
 * @since     v1.0 (2024)
 */

/**
 * Example function to get domain full URL
 */
function getFullDomainUrl(bool $sufix = true)
{
  if ((!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on')
    && (!isset($_SERVER['SERVER_PORT']) || $_SERVER['SERVER_PORT'] != 443)
  ) {
    $protocol = 'http://';
  } else {
    $protocol = 'https://';
  }

  $host = $_SERVER['HTTP_HOST'];
  $fullDomainUrl = $protocol . $host . ($sufix ? '/' : '');

  return $fullDomainUrl;
}
