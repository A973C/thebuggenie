<?php
TBGContext::getResponse()->addHeader('Content-Disposition: attachment; filename="'.$searchtitle.'.csv"');
include_component('search/results_normal_csv', array('issues' => $issues));
?>
