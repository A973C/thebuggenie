<script>
    TBG.Tutorial.Stories.planning = {
        1: {
            message: "<h2><?php echo __e('The Bug Genie interactive planning'); ?></h2><?php echo __e("This is the the interactive project planning board. From this page you can manage all your releases, milestones, epics, tasks and issues."); ?><br><br><?php echo __e("We'll just quickly go over the most important elements on this page to help you get going."); ?>",
            messageSize: 'large',
            button: "<?php echo __e('Next'); ?>"
        },
        2: {
            highlight: {element: 'global_help_link', blocked: true, delay: 500},
            message: "<h3><?php echo __e('Getting help'); ?></h3><?php echo __e("Remember that you can always get help on any page in The Bug Genie by clicking '%help_for_this_page' in the user menu.", array('%help_for_this_page' => __e('Help for this page'))).'<br><br>'.__e("This will take you to the online help page for the specific page you are on."); ?>",
            messageSize: 'large',
            messagePosition: 'left',
            button: "<?php echo __e('Got it!'); ?>",
            cb: function() {
                $('header_usermenu_link').addClassName('force_dropdown');
            }
        },
        3: {
            message: "<h3><?php echo __e('Planning page layout'); ?></h3><?php echo __e('The planning page is split into two main parts: the backlog and the milestone list view'); ?>",
            messageSize: 'medium',
            button: '<?php echo __e('Next'); ?>',
            cb: function() {
                $('header_usermenu_link').removeClassName('force_dropdown');
            }
        },
        4: {
            highlight: {element: 'project_backlog_sidebar', blocked: true},
            message: '<h3><?php echo __e('The project backlog'); ?></h3><?php echo __e('The backlog is a list of all issues matching the backlog search specified for this board, not assigned to a milestone or sprint.'); ?>',
            messageSize: 'large',
            messagePosition: 'right',
            button: '<?php echo __e('Okay'); ?>'
        },
        5: {
            highlight: {element: 'planning_container', blocked: true},
            message: '<h3><?php echo __e('The milestone list'); ?></h3><?php echo __e('The milestone list shows all unclosed milestones (past and future), as well as the current status for each milestone.').'<br><br>'.__e('Scrum planning boards also shows estimated effort in the backlog and milestone list.'); ?>',
            messageSize: 'large',
            button: "<?php echo __e("That's useful"); ?>"
        },
        6: {
            message: "<h3><?php echo __e('Interactive collaboration'); ?></h3><?php echo __e("The planning page is 100% interactive. New issues that are created will show up on the planning page if they are assigned any of the visible milestones, or if they match the backlog search criteria."); ?><br><br><?php echo __e("If any of the visible issues are updated, the information on the planning page will also be updated automatically.").'<br><br>'.__e('This means you can collaborate with users and colleagues when planning, without having to leave or refresh the planning page.'); ?>",
            messageSize: 'large',
            messagePosition: 'center',
            button: '<?php echo __e('Awesome!'); ?>'
        },
        7: {
            message: "<h3><?php echo __e('Interactive collaboration'); ?></h3><?php echo __e('Speaking of interactive, all issues shown on the page can be dragged and dropped between the backlog and any milestones on this page. Of course between milestones, as well.').'<br><br>'.__e('Should an existing or new issue be updated and moved between milestones by a different user or on a different page, the issue will be updated on the planning page automatically.'); ?>",
            messageSize: 'large',
            messagePosition: 'center',
            button: '<?php echo __e('I expected nothing less'); ?>'
        },
        8: {
            highlight: {element: 'releases_toggler_button', blocked: true},
            message: "<h3><?php echo __e('Releases'); ?></h3><?php echo __e('The planning page also lists all future releases'); ?>",
            messageSize: 'medium',
            messagePosition: 'left',
            button: '<?php echo __e('Tell me more'); ?>'
        },
        9: {
            message: "<h3><?php echo __e('Releases'); ?></h3><?php echo __e('Clicking the "Releases" button toggles the list of releases. This list is shown as a card strip above all the milestones.').'<br><br>'.__e('The release list is also interactive - you can drop issues on releases to assign them to that release, or click any release to filter out any issues not in that release in the list view.'); ?>",
            messageSize: 'large',
            messagePosition: 'center',
            button: '<?php echo __e('I see'); ?>'
        },
        10: {
            highlight: {element: 'epics_toggler_button', blocked: true},
            message: "<h3><?php echo __e('Epics'); ?></h3><?php echo __e('The planning page also features a list of unfinished epics'); ?>",
            messageSize: 'medium',
            messagePosition: 'left',
            button: '<?php echo __e('Epics?'); ?>'
        },
        11: {
            message: "<h3><?php echo __e('Epics'); ?></h3><?php echo __e("Yes, epics. Epics (specified in the board configuration) are issues of a certain types, they contain sub-issues and / or tasks, and can span multiple milestones / sprints.").'<br><br>'.__e('Epics, like releases, are displayed as a card list, they can filter issues by clicking on them, and you can assign an issue to an epic by dropping the issue on the epic.'); ?>",
            messageSize: 'large',
            messagePosition: 'center',
            button: '<?php echo __e("Also useful"); ?>'
        },
        12: {
            message: "<h3><?php echo __e('Progress bars'); ?></h3><?php echo __e("Milestones, releases and epics all have progress bars which indicate their current progress. In all cases, this is an open vs closed issues count. The progress bar will automatically update whenever it changes, such as when you add an issue to it."); ?>",
            messageSize: 'large',
            messagePosition: 'center',
            button: '<?php echo __e("Nice"); ?>'
        },
        13: {
            message: "<h3><?php echo __e('Ready to roll'); ?></h3><?php echo __e("That's all. Begin by creating a new milestone on this page, or use an existing milestone if there are any. Create an issue with the '%report_an_issue'-button in the top bar, or by using the button on each milestone to add issues directly to the milestone.", array('%report_an_issue' => __('Report an issue'))).'<br><br>'.__e('Good luck!'); ?>",
            messageSize: 'large',
            messagePosition: 'center',
            button: '<?php echo __e("Thanks!"); ?>'
        }
    };
    TBG.Tutorial.start('planning');
</script>
