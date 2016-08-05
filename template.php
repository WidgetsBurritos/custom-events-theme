<?php
/**
 * @file
 * The primary PHP file for this theme.
 */


/**
 * Implements theme_preprocess_node().
 */
function subtheme_preprocess_node(&$variables, $hook) {
  // Determine bundle and mode for current node.
  $bundle = $variables['node']->type;
  $mode = $variables['view_mode'];

  // Create template suggestions based on bundle and mode.
//  array_unshift($variables['theme_hook_suggestions'], implode('__', [$hook, $bundle, $mode]));
  $variables['theme_hook_suggestions'][] = implode('__', [$hook, $bundle, $mode]);

  // Look for additiional preprocess functions for bundle/mode.
  $fn = implode('__', [__FUNCTION__, $bundle, $mode]);

  if (!function_exists($fn)) {
    $fn = implode('__', [__FUNCTION__, $bundle]);
  }

  if (function_exists($fn)) {
    $fn($variables);
  }
}

/**
 * View for events nodes.
 */
function subtheme_preprocess_node__events(&$variables) {
  $timezone = $variables['field_event_start_date'][0]['timezone'];
  $start = $variables['field_event_start_date'][0]['value'];
  $end = $variables['field_event_end_date'][0]['value'];
  list($start_year, $start_month, $start_day) = custom_events_convert_timestamp_to_tokens($start, $timezone);
  list($end_year, $end_month, $end_day) = custom_events_convert_timestamp_to_tokens($end, $timezone);
  $variables['event_date_range'] = custom_events_generate_date_range_string($start_year, $start_month, $start_day, $end_year, $end_month, $end_day);
  $variables['event_time_range'] = custom_events_generate_time_range_string($start, $end);
  $variables['event_details'] = $variables['body'][0]['safe_value'];
  $variables['event_location'] = $variables['field_event_location'][0]['safe_value'];
  $variables['back_to_all_events'] = l('← ' .t('Back to Events Page'), '<front>', ['attributes' => ['class' => ['btn', 'btn-primary', 'btn-xs']]]);
}

/**
 * View for events node teasers.
 */
function subtheme_preprocess_node__events__teaser(&$variables) {
  $timezone = $variables['field_event_start_date'][LANGUAGE_NONE][0]['timezone'];
  $start = $variables['field_event_start_date'][LANGUAGE_NONE][0]['value'];
  $end = $variables['field_event_end_date'][LANGUAGE_NONE][0]['value'];
  list($start_year, $start_month, $start_day) = custom_events_convert_timestamp_to_tokens($start, $timezone);
  list($end_year, $end_month, $end_day) = custom_events_convert_timestamp_to_tokens($end, $timezone);
  $variables['event_date_range'] = custom_events_generate_date_range_string($start_year, $start_month, $start_day, $end_year, $end_month, $end_day);
  $variables['event_time_range'] = custom_events_generate_time_range_string($start, $end);
  $variables['event_details'] = custom_events_generate_teaser($variables['body'][0]['value']);
  $variables['event_location'] = $variables['field_event_location'][LANGUAGE_NONE][0]['safe_value'];

  $path = drupal_get_path_alias('node/' . $variables['node']->nid);
  $variables['event_read_more_button'] = l(t('See More Info') . ' →', $path, ['attributes' => ['class' => ['btn', 'btn-primary', 'btn-xs']]]);
}


