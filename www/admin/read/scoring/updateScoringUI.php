<?php
   ob_start();
   session_start();
   include '../database.php';
   include '../../includes/session_role.php';
   include '../../category_includes/activity_folder/processingActivityFunctionality.php';
   include '../../category_includes/scoring_folder/processingScoringFunctionality.php';
   include '../a_includes/admin_header.php';
   
   //SCORING UI

   include '../../category_includes/scoring_folder/edit_scoring/updateScoringUI.php';

   include '../a_includes/admin_footer.php'; ?>
