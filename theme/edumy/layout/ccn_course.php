<?php
defined('MOODLE_INTERNAL') || die();
include($CFG->dirroot . '/theme/edumy/ccn/ccn_themehandler.php');

// Redirect to the login page if session has expired, only with dbsessions enabled (MDL-35029) to maintain current behaviour.
if ((!isloggedin() or isguestuser()) && !empty($SESSION->has_timed_out) && !empty($CFG->dbsessions)) {
  if ($preventredirect) {
    throw new require_login_session_timeout_exception();
  } else {
    $SESSION->wantsurl = $CFG->wwwroot . '/course';
    redirect(get_login_url());
  }
}

if ($course_mainpage_layout_dashboard == '1') {
  array_push($extraclasses, "ccn_context_dashboard");
  $bodyclasses = implode(" ", $extraclasses);
  $bodyattributes = $OUTPUT->body_attributes($bodyclasses);
  include($CFG->dirroot . '/theme/edumy/ccn/ccn_themehandler_context.php');

  if ((int)$ccnMdlVersion >= 400) {
    echo $OUTPUT->render_from_template('theme_edumy/ccn_mdl_400/ccn_dashboard', $templatecontext);
  } else {
    echo $OUTPUT->render_from_template('theme_edumy/ccn_dashboard', $templatecontext);
  }
} elseif ($course_mainpage_layout_dashboard == '2') {
  array_push($extraclasses, "ccn_context_dashboard ccn_context_focus");
  $bodyclasses = implode(" ", $extraclasses);
  $bodyattributes = $OUTPUT->body_attributes($bodyclasses);
  include($CFG->dirroot . '/theme/edumy/ccn/ccn_themehandler_context.php');

  if ((int)$ccnMdlVersion >= 400) {
    echo $OUTPUT->render_from_template('theme_edumy/ccn_mdl_400/ccn_focus', $templatecontext);
  } else {
    echo $OUTPUT->render_from_template('theme_edumy/ccn_focus', $templatecontext);
  }
} else {
  array_push($extraclasses, "ccn_context_frontend");
  $bodyclasses = implode(" ", $extraclasses);
  $bodyattributes = $OUTPUT->body_attributes($bodyclasses);
  include($CFG->dirroot . '/theme/edumy/ccn/ccn_themehandler_context.php');
  if ((int)$ccnMdlVersion >= 400) {
    echo $OUTPUT->render_from_template('theme_edumy/ccn_mdl_400/columns2', $templatecontext);
  } else {
    echo $OUTPUT->render_from_template('theme_boost/columns2', $templatecontext);
  }
}
