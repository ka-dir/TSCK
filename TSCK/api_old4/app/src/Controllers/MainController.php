<?php

namespace App\Controllers;

use App\Models\Applicants;
use App\Models\AppliedJobs;
use \App\Models\ApiKeys;
use App\Models\Users;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;


/**
 *
 */
final class MainController
{

    /*private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }*/

    public function __invoke(Request $request, Response $response, $args)
    {
      
        $data = $this->details($response,$args);
      //  $this->logger->info($data);

        return $data;

    }


    /**
     * @param $request
     * @param $response
     * @param $args
     * @return bool
     *
     * this is our main function
     */
    /*public function index($request,$response,$args){
        $data = $this->details($response,$args);
        $this->logger->info($data);

        return $data;
    }*/

    /**
     * @param $response
     * @param $args
     * @return bool
     *
     * build our data base on verified results
     */
    public function details($response,$args)
    {
        //Authnticate user
        $user_auth = $this->authenticate_user($args);

        if($user_auth)
        {
            if($user_auth == Applicants::KEY_SUCCESSFUL)
            {
                $user = Users::where('id_number',trim($args['id']))->get();


                foreach ($user as $users)
                {
                    $appliedjobs = AppliedJobs::where('id_number',$users->id_number)->get();
                    $applicant_details = Applicants::where('id_no',$users->id_number)->first();

                    $data['title'] = $applicant_details->title;

                    $data['surname'] = $applicant_details->S_name;
                    $data['first_name'] = $applicant_details->F_name;
                    $data['other_name'] = $applicant_details->O_name;
                    $data['other_name'] = $applicant_details->O_name;
                    $data['gender'] = $applicant_details->gender;
                    $data['id_number'] = $users->id_number;
                    if($applicant_details->tscNo != null)
                    {
                        $data['tsc_no'] = $applicant_details->tscNo;
                    }
                    $data['email'] = $users->email;
                    $data['phone_number'] = $users->phone_number;

                    foreach ($appliedjobs as $appliedjob)
                    {
                        $data['applied_jobs'][]['post']  =
                            [
                                "advert_no" => $appliedjob->advert_no,
                                "post" => $appliedjob->post_vacancy,
                                "status" => $appliedjob->status,
                                "date" => $appliedjob->DateTime
                            ];
                    }
                    $datas[] = $data;
                }


                return  $response->withHeader('Content-Type', 'application/json')
                    ->withStatus(200)
                    ->withJson(['status' => 'success', 'data' => $data]);
            }
            //build user authentication response
            elseif ($user_auth == Applicants::USER_NOT_FOUND)
            {
                return  $response->withHeader('Content-Type', 'application/json')
                    ->withStatus(400)
                    ->withJson(['status' => 'error', 'message' => 'Id Number not found']);
            }
            elseif ($user_auth == Applicants::API_KEY_NOT_FOUND)
            {
                return  $response->withHeader('Content-Type', 'application/json')
                    ->withStatus(401)
                    ->withJson(['status' => 'error', 'message' => 'Authentication Error']);
            }
            elseif ($user_auth == Applicants::API_KEY_CLOSED)
            {
                return  $response->withHeader('Content-Type', 'application/json')
                    ->withStatus(401)
                    ->withJson(['status' => 'error', 'message' => 'Access Denied']);
            }

        }
        else
        {
            return false;
        }
    }

    /**
     * @param $args
     * @return int
     */
    public function authenticate_user($args)
    {
        $id_no = trim($args['id']);
        $api_key = $args['api_key'];
        $user = Users::where('id_number',$id_no)->first();
        $apikey_authenticate = ApiKeys::where('api_key',$args['key'])->first();



        if($user == null)
        {
            return Applicants::USER_NOT_FOUND;//User id not found
        }

        if($apikey_authenticate == null)
        {
            return Applicants::API_KEY_NOT_FOUND;//Api Key not found or wrong Api Key
        }
        if($apikey_authenticate)
        {
            if(trim($apikey_authenticate->active == 0))
            {
                return Applicants::API_KEY_CLOSED; // Api key Access Closed
            }
            else
            {
                $apikey_authenticate->request_count = $apikey_authenticate->request_count + 1;
                $apikey_authenticate->save();
                return Applicants::KEY_SUCCESSFUL; //Api key Authenticated
            }
        }
    }

}