<?php
namespace AwsomeJobPortal\Lib;

class Menu{

	public function _renderAddPage() {
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/add_job.php' );
    }

    public function _renderListPage() {
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/jobs_list.php' );
    }

    public function _renderTalentRegistrations() {
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/talent_registrations.php' );
    }

    public function _renderChallengeList(){
    	include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/challenge-list.php' );
    }

    public function _renderChallengeAdd(){
    	include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/challenge-add.php' );
    }

    public function _renderAddSectorPage()
    {
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/sector-add.php' );
    }
    public function _renderAddTitlePage()
    {
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/title-add.php' );
    }
    public function _renderAddfunctionPage(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/function-add.php' );
    }
    public function _renderInternshipRegistrations(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/internship-registrations.php' );
    }
    public function _renderJobApplicationsPage(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/job-applications.php' );
    }

    public function _renderApplicantDetailsPage(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/applicant-details.php' );
    }

    public function _renderEditJobPage(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/edit-job.php' );
    }
    
    public function _renderChampions(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/champions.php' );
    }
    
    public function _renderPositions(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/positions.php' );
    }
    public function _renderCareerRegistrationDetailsPage(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/talent-registration-detail.php' );
    }
    public function _renderDeleteJobPage(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/delete-job.php' );
    }
    public function _renderDeleteJobApplicationPage(){
        include_once( WP_PLUGIN_DIR.'/awsome-jobs-portal/admin/views/delete-job-application.php' );
    }
}