<?php

namespace App\Controllers;


use App\Models\CustomModel;


class Account extends BaseController
{
	

	public function __construct(){
		//connect to database and initialize model
                $db=db_connect();
		$this->model=new CustomModel($db);
         	helper(['url', 'form','cookie']);
		
	}

	
	public function dashboard()
	{       //get user ID from session
                $userID=session()->get('loggedID'); 
       
                //fetch user record from database
		$data['user']=$this->model->rowSelectColumn('user_table','id,email,password', array('userID'=>$userID));
		$data['total_dep']=$this->model->sumRows('transactions',array('userID'=>$userID),'amount');
                $data['recent_deposits']=$this->model->resultSelectColumn('deposits','*',array('userID'=>$userID));


		echo view('dashboard',$data);

		
		}
	}

		
