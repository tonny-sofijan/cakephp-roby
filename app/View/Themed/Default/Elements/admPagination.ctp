<?php 
    $options = array();
    $optionsNumber = array('separator' => '');
    $optionsCounter = array('format' => __('Halaman {:page} dari {:pages}, menampilkan {:current} data dari total {:count} data, dimulai dari data ke {:start}, sampai dengan {:end}'));
    if (!empty($customOptions)) {
        foreach ($customOptions as $key => $custom) {
            $option[$key] = $custom;
            $optionsNumber[$key] = $custom;
            $optionsCounter[$key] = $custom;
        }
    }
?>

<p><?php
        echo $this->Paginator->counter($optionsCounter);
?></p>

<div class="paging">
    <?php
    echo $this->Paginator->prev('< ' . __('sebelumnya'), $options, null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers($optionsNumber);
    echo $this->Paginator->next(__('berikutnya') . ' >', $options, null, array('class' => 'next disabled'));
    ?>
</div>