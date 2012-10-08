<?php

defined('MOODLE_INTERNAL') || die();

$hasheading = $PAGE->heading;
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));

$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}

if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}
/************************************************************************************************/

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
    <?php echo $OUTPUT->standard_top_of_body_html();?>

    <div id="frametop">
        <div id="framebottom">
            <div id="frameleft">
                <div id="frameright">
                    <div id="wrapper">

<!-- begin of page-header -->
            <?php if ($hasheading) { ?>
                <div id="page-header">
                    <div id="headerlogo">
                        <img src="<?php echo $OUTPUT->pix_url('logo', 'theme');?>" alt="Custom logo here" />
                    </div>
                    <div class="headermenu">
                        <?php
                            echo $OUTPUT->login_info();
                            if (($CFG->langmenu) && (!empty($PAGE->layout_options['langmenu']))) {
                                echo $OUTPUT->lang_menu();
                            }
                            echo $PAGE->headingmenu;
                        ?>
                    </div>
                </div>
            <?php } ?>
<!-- end of page-header -->

<!-- begin of custom menu -->
            <?php if ($hascustommenu) { ?>
                <div id="custommenu"><?php echo $custommenu; ?></div>
            <?php } ?>
<!-- end of custom menu -->

<!-- begin of navigation bar -->
            <?php if ($hasnavbar) { ?>
                <div class="navbar clearfix">
                    <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
                    <div class="navbutton"><?php echo $PAGE->button; ?></div>
                </div>
            <?php } ?>
<!-- end of navigation bar -->

<!-- start of moodle content -->
            <div id="page-content">
                <div id="region-main-box">
                    <div id="region-post-box">

                        <!-- main mandatory content of the moodle page  -->
                        <div id="region-main-wrap">
                            <div id="region-main">
                                <div class="region-content">
                                    <?php echo $OUTPUT->main_content() ?>
                                </div>
                            </div>
                        </div>
                        <!-- end of main mandatory content of the moodle page -->


                        <!-- left column block - diplayed only if... -->
                        <?php if ($hassidepre) { ?>
                        <div id="region-pre" class="block-region">
                            <div class="region-content">
                                <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- end of left column block - diplayed only if... -->

                        <!-- right column block - diplayed only if... -->
                        <?php if ($hassidepost) { ?>
                        <div id="region-post" class="block-region">
                            <div class="region-content">
                                <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- end of right column block - diplayed only if... -->

                    </div>
                </div>
            </div>
<!-- end of moodle content -->
            <div class="clearfix"></div>
                    </div> <!-- end of wrapper -->
                </div> <!-- </frameright> -->
            </div> <!-- </frameleft> -->
        </div> <!-- </framebottom> -->
    </div> <!-- </frametop> -->

<?php if ($hasfooter) {?>
        <!-- START OF FOOTER -->
        <div id="page-footer">
        <?php if (!empty($PAGE->theme->settings->footnote)) { ?>
            <div id="footerframetop">
                <div id="footerframebottom">
                    <div id="footerframeleft">
                        <div id="footerframeright">
                            <!-- the content to show -->
                            <div id="footerwrapper" class="clearfix">
                                <hr />
                                <div class="footnote"><?php echo $PAGE->theme->settings->footnote; ?></div>
                                <?php echo $OUTPUT->login_info(); ?>
                            </div> <!-- end of footerwrapper -->
                        </div>
                    </div> <!-- </footerframeright></footerframeleft> -->
                    <div id="footerframebottomright">
                        <div>&nbsp;</div>
                    </div>
                </div>
            </div> <!-- </footerframebottom></footerframetop> -->
        <?php }?>

            <div class="moodledocsleft">
                <div class="moodledocs">
                    <?php echo page_doc_link(get_string('moodledocslink')); ?>
                </div>
                <div class="sitelink">
                    <a title="Moodle" href="http://moodle.org/">
                        <img style="width:100px;height:30px" src="<?php echo $this->pix_url('moodlelogo') ?>" alt="moodlelogo" />
                    </a>
                </div>
                <?php echo $OUTPUT->standard_footer_html(); ?>
            </div>
        </div> <!-- end of page-footer or page-footer_noframe -->
<?php   //the waiting div has been closed
}
    echo $OUTPUT->standard_end_of_body_html(); ?>
</body>
</html>
