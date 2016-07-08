<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index()
    {
        $this->View->render('index/index');
    }
    public function services()
    {
        $this->View->render('index/services');
    }
    public function about()
    {
        $this->View->render('index/about');
    }
    public function contact()
    {
        $this->View->render('index/contact');
    }
    public function quote()
    {
        $this->View->render('index/quote');
    }

    public function getquote()
    {
        IndexModel::getQuote(Request::post('quote_address_name'), Request::post('quote_address_postcode'), Request::post('quote_address_type'), Request::post('quote_address_age'), Request::post('quote_address_phone'), Request::post('quote_address_email'), Request::post('quote_address_make'));
        Redirect::to('index/quote');
    }

    public function contactsend()
    {
        IndexModel::contactSend(Request::post('contact_name'), Request::post('contact_email'), Request::post('contact_phone'), Request::post('contact_postcode'), Request::post('contact_message'));
        Redirect::to('index/contact');
    }
}
