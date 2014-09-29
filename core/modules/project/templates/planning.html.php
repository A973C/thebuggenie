<?php

    $tbg_response->addBreadcrumb(__('Planning'), null, tbg_get_breadcrumblinks('project_summary', $selected_project));
    $tbg_response->setTitle(__('"%project_name" project planning', array('%project_name' => $selected_project->getName())));
    include_template('project/projectheader', array('selected_project' => $selected_project, 'subpage' => __('Manage agile boards')));

?>
<div id="project_boards" class="project_info_container">
    <div class="project_boards_list" id="boards_list_container">
        <h3><?php echo __('Public project boards'); ?></h3>
        <ul id="agileboards_project">
            <?php foreach ($project_boards as $board): ?>
                <?php include_component('project/agileboardbox', compact('board')); ?>
            <?php endforeach; ?>
            <li id="add_board_project_link" class="add_board_container" onclick="TBG.Main.Helpers.Backdrop.show('<?php echo make_url('get_partial_for_backdrop', array('key' => 'agileboard', 'project_id' => $selected_project->getID(), 'is_private' => 0)); ?>');">+</li>
        </ul>
        <h3><?php echo __('Private project boards'); ?></h3>
        <ul id="agileboards_user">
            <?php foreach ($user_boards as $board): ?>
                <?php include_component('project/agileboardbox', compact('board')); ?>
            <?php endforeach; ?>
            <li id="add_board_user_link" class="add_board_container" onclick="TBG.Main.Helpers.Backdrop.show('<?php echo make_url('get_partial_for_backdrop', array('key' => 'agileboard', 'project_id' => $selected_project->getID(), 'is_private' => 1)); ?>');">+</li>
        </ul>
    </div>
    <br style="clear: both;">
</div>
