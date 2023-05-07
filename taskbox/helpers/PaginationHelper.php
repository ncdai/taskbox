<?php

class PaginationHelper
{

  public static function getCurrentUrl()
  {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    return $protocol . '://' . $host . $uri;
  }

  public static function mergeQueryParams($url, $params)
  {
    // Parse the URL to get the existing query params
    $parsedUrl = parse_url($url);
    $existingParams = [];
    if (isset($parsedUrl['query'])) {
      parse_str($parsedUrl['query'], $existingParams);
    }

    // Merge the existing params with the new params
    $mergedParams = array_merge($existingParams, $params);

    // Rebuild the query string
    $queryString = http_build_query($mergedParams);

    // Build the new URL
    $newUrl = $parsedUrl['path'] . '?' . $queryString;
    if (isset($parsedUrl['fragment'])) {
      $newUrl .= '#' . $parsedUrl['fragment'];
    }

    return $newUrl;
  }

  public static function getPageLink($currentUrl, $page, $limit)
  {
    return PaginationHelper::mergeQueryParams($currentUrl, array('page' => $page, 'limit' => $limit));
  }

  public static function getPaginationData($totalRecords, $itemPerPage, $currentPage)
  {
    $totalPages = ceil($totalRecords / $itemPerPage);
    $prevPage = ($currentPage > 1) ? $currentPage - 1 : 1;
    $nextPage = ($currentPage < $totalPages) ? $currentPage + 1 : $totalPages;

    return array(
      'totalPages' => $totalPages,
      'prevPage' => $prevPage,
      'nextPage' => $nextPage
    );
  }
}