<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class AdminController extends Controller
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
        $this->View->render('admin/index');
    }    
    public function updateuser()
    {
    	$this->View->render('admin/updateuser', array("users" => DashboardModel::getAllUsers()));
    }
    public function adduser()
    {
        $this->View->render('admin/adduser');
    }
    public function deleteuser()
    {
        $this->View->render('admin/deleteuser', array("users" => DashboardModel::getAllUsers()));
    }
    public function sendinvoice()
    {
        $this->View->render('admin/sendinvoice', array("jobs" => AdminModel::getAllJobs()));
    }
    public function updatejob()
    {
        $this->View->render('admin/updatejob', array("jobs" => AdminModel::getAllJobs()));
    }
    public function deletejob()
    {
        $this->View->render('admin/deletejob', array("jobs" => AdminModel::getAllJobs()));
    }
    public function assignjob()
    {
        $this->View->render('admin/assignjob', array("jobs" => AdminModel::getAllJobs(), "engineers" => AdminModel::getAllEngineers()));
    }
    public function addjob()
    {
        $this->View->render('admin/addjob', array('users' => AdminModel::getAccounts(), 'user' => AdminModel::getAllUsers()));
    }
    public function viewdeletedjobs()
    {
        $this->View->render('admin/viewdeletedjobs', array("jobs" => AdminModel::getAllJobs()));
    }
    public function moveitem()
    {
        $this->View->render('admin/moveitem', array("stock" => AdminModel::GetAllStock(), "engineers" => AdminModel::getAllEngineers()));
    }
    public function removestock()
    {
        $this->View->render('admin/removestock', array("invent" => AdminModel::getAllStock()));
    }
    public function stocksearch()
    {
        $this->View->render('admin/searchstock', array("invent" => AdminModel::getAllStock()));
    }
    public function stockreorder()
    {
        $this->View->render('admin/stockreorder', array("invent" => AdminModel::getAllStock()));
    }
    public function addstocklocation()
    {
        $this->View->render('admin/addstocklocation', array("engineers" => AdminModel::getAllEngineers()));
    }
    public function addstock()
    {
        $this->View->render('admin/addstock', array("invent" => AdminModel::getAllStock()));
    }
    public function viewstock()
    {
        $this->View->render('admin/viewallstock', array("loc" => AdminModel::getAllVehicles()));
    }

    /**
     * Register page action
     * POST-request after form submit
     */
    public function register_action()
    {
        $registration_successful = RegistrationModel::registerNewUser();

        if ($registration_successful) {
            Redirect::to('admin/index');
        } else {
            Redirect::to('admin/adduser');
        }
    }
	
    public function movestock()
    {
	   AdminModel::stockMove(Request::post('item_code'), Request::post('item_quant_move'), Request::post('item_move_name'));
	   Redirect::to('admin');
    }

    public function stocklocation()
    {
        AdminModel::createStockLocation(Request::post('v_type'), Request::post('v_make'), Request::post('v_model'), Request::post('v_assigned'), Request::post('v_reg'), Request::post('v_mot'), Request::post('v_tax'));
        Redirect::to('admin');
    }

    public function userupdate()
    {
	   AdminModel::updateUser(Request::post('user_id'), Request::post('user_account_type'));
	   Redirect::to('admin');
    }

    public function userdelete()
    {
       AdminModel::deleteUser(Request::post('user_id'));
       Redirect::to('admin');
    }

    public function addtostock()
    {
	   AdminModel::addItemToStock(Request::post('item_code'), Request::post('item_name'), Request::post('item_description'), Request::post('item_make'), Request::post('item_cost'), Request::post('item_resell'), Request::post('item_location'), Request::post('item_quant'));
	   Redirect::to('admin/additem');
    }

    public function search()
    {
	   AdminModel::search(Request::post('search_terms'));
    }

    public function jobassign()
    {
        AdminModel::assignJobs(Request::post('job_id'), Request::post('job_for'));
        Redirect::to('admin');
    }

    public function removefromstock()
    {
        AdminModel::removeFromStock(Request::post('item_code'));
        Redirect::to('admin');
    }

     public function create()
    {
        AdminModel::createJob(Request::post('job_name'), Request::post('job_address_number'), Request::post('custom_field'), Request::post('address3'), Request::post('postcode'), Request::post('job_tel'), Request::post('job_fi'), Request::post('job_mt'), Request::post('job_fault'), Request::post('job_date'), Request::post('job_time'), Request::post('job_keys'), Request::post('job_account'), Request::post('job_account_name'));
        Redirect::to('admin');
    }

    public function declinejob()
    {
        AdminModel::declineJob(Request::post('job_id'));
        Redirect::to('dashboard');
    }
}
