<?php
$this->set('channel', array(
    'title' => __("Most Recent Posts"),
    'link' => $this->Html->url('/', true),
    'description' => __("Most recent posts."),
    'language' => 'en-us'
));

$this->set('data', array(
    'title' => __("Most Recent Posts"),
    'link' => $this->Html->url('/', true),
    'description' => __("Most recent posts."),
    'language' => 'en-us'
));
?>

<?php

foreach ($bets as $bet) {
    echo  $this->Rss->item(array(), array(
        'title' => 'abc',
        'link' => 'http://google.com',
        'description' => 'descriptions',
        'pubDate' => date('Y-m-d')
    ));
}
/*
// You should import Sanitize
App::uses('Sanitize', 'Utility');

foreach ($bets as $bet) {
    $betTime = strtotime($bet['Bet']['created_date']);

    $betLink = array(
        'controller' => 'bets',
        'action' => 'view',
        $bet['Bet']['id']
    );
    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
//    $bodyText = preg_replace('=\(.*?\)=is', '', $bet['Bet']['home']);
//    $bodyText = $this->Text->stripLinks($bodyText);
//    $bodyText = Sanitize::stripAll($bodyText);
//    $bodyText = $this->Text->truncate($bodyText, 400, array(
//        'ending' => '...',
//        'exact'  => true,
//        'html'   => true,
//    ));

    echo  $this->Rss->item(array(), array(
        'title' => $bet['Bet']['home'],
        'link' => $betLink,
        'guid' => array('url' => $betLink, 'isPermaLink' => 'true'),
        'description' => $bet['home'], #$bodyText,
        'pubDate' => $bet['Bet']['created']
    ));
}
 * 
 */
?>