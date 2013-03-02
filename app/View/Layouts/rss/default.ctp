<?php

if (!isset($data)) {
	$data = array();
}
if (!isset($channel)) {
	$channel = array();
}
if (!isset($channel['title'])) {
	$channel['title'] = $title_for_layout;
}

echo $this->Rss->document($data, $this->Rss->channel(array(), $channel, $this->fetch('content')));

?>
