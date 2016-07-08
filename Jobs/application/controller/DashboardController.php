<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class DashboardController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {
        $this->View->render('dashboard/index', array("jobs" => DashboardModel::getAllJobs()));
    }

    /**
     * This method controls what happens when you move to /note/edit(/XX) in your app.
     * Shows the current content of the note and an editing form.
     * @param $note_id int id of the note
     */
    public function edit($job_id)
    {
        $this->View->render('dashboard/editjob', array(
            'jobs' => DashboardModel::getJob($job_id)
        ));
    }

    public function viewcomments($job_id)
    {
        $this->View->render('dashboard/viewcomments', array(
            'jobs' => DashboardModel::getJob($job_id)
        ));
    }

    public function jobsheet($job_id)
    {
	$this->View->render('dashboard/jobsheet', array(
		'jobs' => DashboardModel::getJob($job_id)
	));
    }

    public function complete($job_id)
    {
        DashboardModel::markComplete($job_id);
        Redirect::to('dashboard');
    }

    public function incomplete($job_id)
    {
        DashboardModel::markIncomplete($job_id);
        Redirect::to('dashboard');
    }

    /**
     * This method controls what happens when you move to /note/editSave in your app.
     * Edits a note (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        DashboardModel::updateJob(Request::post('job_id'), Request::post('job_comment'));
        Redirect::to('dashboard/jobsheet/' . Request::post('job_id'));
    }

    /**
     * This method controls what happens when you move to /note/delete(/XX) in your app.
     * Deletes a note. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $note_id id of the note
     */
    public function delete($job_id)
    {
        DashboardModel::deleteJob($job_id);
        Redirect::to('dashboard');
    }
}
