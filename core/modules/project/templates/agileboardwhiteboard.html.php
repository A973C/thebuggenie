<?php

    use thebuggenie\core\entities\AgileBoard;
    $tbg_response->addBreadcrumb(__('Planning'), null, tbg_get_breadcrumblinks('project_summary', $selected_project));
    $tbg_response->setTitle(__('"%project_name" agile whiteboard', array('%project_name' => $selected_project->getName())));
    include_template('project/projectheader', array('selected_project' => $selected_project, 'subpage' => $board->getName(), 'board' => $board));

?>
<div id="project_planning" class="project_info_container whiteboard <?php if (!count($board->getColumns())) echo ' edit-mode'; ?> left_toggled <?php if ($board->getType() == AgileBoard::TYPE_GENERIC) echo 'type-generic'; if ($board->getType() == AgileBoard::TYPE_SCRUM) echo 'type-scrum'; if ($board->getType() == AgileBoard::TYPE_KANBAN) echo 'type-kanban'; ?>" data-last-refreshed="<?php echo time(); ?>" data-poll-url="<?php echo make_url('project_planning_poll', array('project_key' => $selected_project->getKey(), 'board_id' => $board->getID(), 'mode' => 'whiteboard')); ?>" data-retrieve-issue-url="<?php echo make_url('project_planning_get_issue', array('project_key' => $selected_project->getKey(), 'board_id' => $board->getID(), 'mode' => 'whiteboard')); ?>" data-board-id="<?php echo $board->getID(); ?>">
    <div class="planning_indicator" id="planning_indicator"><?php echo image_tag('spinning_30.gif'); ?></div>
    <div class="project_right_container">
        <div class="project_right planning_container" id="planning_container">
            <div class="project_save_container" id="project_planning_action_strip">
                <input type="search" class="planning_filter_title" id="planning_filter_title_input" disabled placeholder="<?php echo __('Filter issues by title'); ?>">
                <div class="edit-mode-buttons">
                    <?php if (count($board->getColumns())): ?>
                        <a class="button button-silver" href="javascript:void(0);" onclick="TBG.Project.Planning.Whiteboard.toggleEditMode();"><?php echo __('Cancel'); ?></a>
                    <?php endif; ?>
                    <a class="button button-silver" href="javascript:void(0);" onclick="TBG.Project.Planning.Whiteboard.addColumn(this);" data-url="<?php echo make_url('project_planning_board_whiteboard_column', array('project_key' => $board->getProject()->getKey(), 'board_id' => $board->getID())); ?>"><?php echo __('Add column'); ?></a>
                    <a class="button button-silver" href="javascript:void(0);" onclick="TBG.Project.Planning.Whiteboard.saveColumns($('planning_whiteboard_columns_form'));"><?php echo __('Save columns'); ?></a>
                </div>
                <div class="button-group whiteboard-view-mode">
                    <a class="button button-silver button-pressed" href="javascript:void(0);" onclick="TBG.Project.Planning.Whiteboard.setViewMode(this, 'simple');"><?php echo image_tag('whiteboard-simple.png'); ?></a>
                    <a class="button button-silver" href="javascript:void(0);" onclick="TBG.Project.Planning.Whiteboard.setViewMode(this, 'detailed');"><?php echo image_tag('whiteboard-detailed.png'); ?></a>
                </div>
                <a href="javascript:void(0)" class="fancydropdown changeable self-updateable milestone_virtual_status" id="selected_milestone_container">
                    <span id="selected_milestone_status_details" style="display: none;"></span>
                    <?php echo image_tag('spinning_16.gif', array('id' => 'selected_milestone_status_indicator')); ?>
                </a>
                <ul id="selected_milestone_input" class="fancydropdown-list" data-selected-value="<?php echo ($selected_milestone instanceof TBGMilestone) ? $selected_milestone->getID() : 0; ?>" data-status-url="<?php echo make_url('project_planning_board_whiteboard', array('project_key' => $board->getProject()->getKey(), 'board_id' => $board->getID(), 'mode' => 'getmilestonestatus')); ?>">
                    <?php foreach ($board->getMilestones() as $milestone): ?>
                        <li data-input-value="<?php echo $milestone->getID(); ?>" data-display-name="<?php echo $milestone->getName(); ?>" class="fancydropdown-item <?php if ($selected_milestone instanceof TBGMilestone && $selected_milestone->getID() == $milestone->getID()) echo 'selected'; ?>" onclick="setTimeout(TBG.Project.Planning.Whiteboard.retrieveWhiteboard, 100);">
                            <h1><?php echo $milestone->getName(); ?></h1>
                            <?php echo image_tag('icon_milestone_issues.png'); ?>
                            <dl class="info">
                                <dt><?php echo __('Start date'); ?></dt>
                                <dd><?php echo ($milestone->getStartingDate()) ? tbg_formatTime($milestone->getStartingDate(), 22, true, true) : '-'; ?></dd>
                                <dt><?php echo __('End date'); ?></dt>
                                <dd><?php echo ($milestone->getScheduledDate()) ? tbg_formatTime($milestone->getScheduledDate(), 22, true, true) : '-'; ?></dd>
                            </dl>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div id="planning_whiteboard">
                <div class="planning_indicator" id="whiteboard_indicator"><?php echo image_tag('spinning_30.gif'); ?></div>
                <form id="planning_whiteboard_columns_form" onsubmit="TBG.Project.Planning.Whiteboard.saveColumns(this);return false;" action="<?php echo make_url('project_planning_board_whiteboard', array('project_key' => $board->getProject()->getKey(), 'board_id' => $board->getID())); ?>">
                    <table class="whiteboard-columns">
                        <tr id="planning_whiteboard_columns_form_row">
                            <?php foreach ($board->getColumns() as $column): ?>
                                <?php include_component('project/editboardcolumn', compact('column')); ?>
                            <?php endforeach; ?>
                        </tr>
                    </table>
                </form>
                <table class="whiteboard-columns <?php echo ($board->usesSwimlanes()) ? ' swimlanes' : ' no-swimlanes'; ?>" id="whiteboard" data-whiteboard-url="<?php echo make_url('project_planning_whiteboard_issues', array('project_key' => $board->getProject()->getKey(), 'board_id' => $board->getID())); ?>">
                    <thead id="whiteboard-headers">
                        <tr>
                            <?php foreach ($board->getColumns() as $column): ?>
                                <?php include_component('project/boardcolumnheader', compact('column')); ?>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="project_left_container" id="project_backlog_sidebar">
        <div class="project_left">
            <div id="milestone_0" class="milestone_box" data-milestone-id="0" data-issues-url="<?php echo make_url('project_planning_milestone_issues', array('project_key' => $board->getProject()->getKey(), 'milestone_id' => 0, 'board_id' => $board->getID())); ?>" data-assign-issue-url="<?php echo make_url('project_planning_assign_milestone', array('project_key' => $board->getProject()->getKey(), 'milestone_id' => 0)); ?>" data-backlog-search="<?php echo ($board->usesAutogeneratedSearchBacklog()) ? 'predefined_'.$board->getAutogeneratedSearch() : 'saved_'.$board->getBacklogSearchObject()->getID(); ?>">
                <div class="planning_indicator" id="milestone_0_indicator" style="display: none;"><?php echo image_tag('spinning_30.gif'); ?></div>
                <div class="header backlog" id="milestone_0_header">
                    <div class="milestone_basic_container">
                        <span class="milestone_name"><?php echo __('Backlog'); ?></span>
                        <div class="backlog_toggler dynamic_menu_link" onclick="$('project_planning').toggleClassName('left_toggled');" title="<?php echo __('Click to toggle the show / hide the backlog'); ?>"><?php echo image_tag('icon_sidebar_collapse.png'); ?></div>
                    </div>
                    <div class="milestone_counts_container">
                        <table>
                            <tr>
                                <td id="milestone_0_issues_count">-</td>
                                <td id="milestone_0_points_count" class="issue_estimates">-</td>
                                <td id="milestone_0_hours_count" class="issue_estimates">-</td>
                            </tr>
                            <tr>
                                <td><?php echo __('Issues'); ?></td>
                                <td class="issue_estimates"><?php echo __('Points'); ?></td>
                                <td class="issue_estimates"><?php echo __('Hours'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <?php echo image_tag('spinning_20.gif', array('id' => 'milestone_0_issues_indicator', 'class' => 'milestone_issues_indicator', 'style' => 'display: none;')); ?>
                </div>
                <ul id="milestone_0_issues" class="milestone_issues jsortable intersortable <?php //if ($board->getBacklogSearchObject()->getTotalNumberOfIssues() == 0) echo 'empty'; ?>"></ul>
                <div class="milestone_no_issues" style="<?php /*if ($board->getBacklogSearchObject()->getTotalNumberOfIssues() > 0): ?> display: none;<?php endif; */ ?>" id="milestone_0_unassigned"><?php echo __('No issues are assigned to this milestone'); ?></div>
                <div class="milestone_no_issues" style="display: none;" id="milestone_0_unassigned_filtered"><?php echo __('No issues assigned to this milestone matches selected filters'); ?></div>
                <div class="milestone_error_issues" style="display: none;" id="milestone_0_initialize_error"><?php echo __('The issue list could not be loaded'); ?></div>
            </div>
        </div>
    </div>
    <br style="clear: both;">
</div>
<script type="text/javascript">
    document.observe('dom:loaded', function() {
        TBG.Project.Planning.Whiteboard.initialize({dragdrop: <?php echo ($tbg_user->canAssignScrumUserStories($selected_project)) ? 'true' : 'false'; ?>});
    });
</script>
