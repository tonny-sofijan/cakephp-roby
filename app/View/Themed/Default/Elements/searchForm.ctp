<!-- search form -->
<?php echo $this->Form->create(null, array('type' => 'get')); ?>
<div class="searchFormWrapper">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <!-- SEARCH BY -->
            <?php if (isset($searchByList)): ?>
                <th width="15%"><?php echo __('Search by:'); ?></th>
                <th width="15%">
                    <?php echo $this->Form->select('searchBy', $searchByList, array('value' => $searchBy, 'empty' => false)); ?>
                </th>
                <th width="5%"><?php echo __('Keyword:'); ?></th>
                <th width="20%"><input type="text" name="keyword" class="text w_20" value="<?php echo $keyword; ?>" /></th>
            <?php endif; ?>

            <!-- GROUP BY -->
            <?php if (isset($groupByList)): ?>
                <th width="10%"><?php echo __('Group by:') ?></th>
                <th width="10%">
                    <?php echo $this->Form->select('groupBy', $groupByList, array('value' => $groupBy, 'empty' => false)); ?>
                </th>
            <?php endif; ?>
                
            <th>
                <div class="buttonWrapper clearfix" style="float: right">
                    <span class="btnClose last">
                        <input type="submit" class="btnIco icoSearch" name="submit" value="<?php echo __('Search'); ?>" />
                    </span>
                </div>
            </th>
        </tr>
    </table>
    
</div>
<?php echo $this->Form->end(); ?>