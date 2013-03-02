<?php 
    $action = isset($customAction) ? $customAction : 'index';    
    $options = array('action' => $action);
        
    if (isset($customController))
        $options = array_merge($options, array('controller' => $customController));
    
    if (isset($customId))
        array_push($options, $customId);
    
    if (isset($additionalParams))
        $options = array_merge($options, array('?' => $additionalParams));
    
?>

<div class="buttonWrapper clearfix">
    <div style="float: right;">
        <span class="btnClose">
            <a class="linkIco icoSubmit" onclick="<?php echo 'if (confirm(\'' . __('Apakah anda yakin?') . '\')) { document.getElementById(\''. $formId .'\').submit(); } event.returnValue = false; return false;'; ?>" href="#">
                <?php echo $text; ?>
            </a>
        </span>
        
        <?php if (isset($saveNsend) && $saveNsend === true): ?>
        <span class="btnClose">
            <a class="linkIco icoSubmit" onclick="<?php echo 'if (confirm(\'' . __('Apakah anda yakin?') . '\')) { document.getElementById(\'status\').value = 1; document.getElementById(\''. $formId .'\').submit(); } event.returnValue = false; return false;'; ?>" href="#">
                <?php echo __('Simpan dan Kirimkan'); ?>
            </a>
        </span>
        <?php endif; ?>
        
        <span class="btnClose last">
            <?php echo $this->Html->link(__('Kembali'), $options, array('escape' => false, 'class' => 'linkIco icoCancel')); ?>
        </span>
    </div>
</div>