<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

class GitEventController extends Controller
{

/*Function Name : event_score
       - It is Used to get githun user event score calculation.
*/

    public function event_score(){

        $response = array();
        if(isset( $_POST['name']) && !empty( $_POST['name'])){
            $name = $_POST['name'];

            $all_git_data = $this->get_data_using_url($name);

            if(isset($all_git_data) && !empty($all_git_data)) {

                $point = 0;

                $earned_points = array(
                    "PushEvent" => 0 ,
                    "PullRequestEvent" => 0,
                    "IssueCommentEvent" => 0,
                    "other" =>0
                );

                $data = json_decode($all_git_data,true);
                foreach($data as $single_data){

                    if(isset($single_data['type']) && !empty($single_data['type'])){
                        $earned_points = $this->point_calculation($single_data['type'],$earned_points);
                    }

                }

                $response['message'] = "Success Calculation";
                $response['point'] = $earned_points;
                return redirect()->back()->with($response);
            }

        }else{
            return Redirect::back()->withErrors(['Sorry, Please Enter Name.']);
        }
    }

    /*Point Calculation*/

    public function point_calculation($type,$earned_points){

        /*PushEvent = 10 points.
        PullRequestEvent = 5 points.
        IssueCommentEvent = 4 points.
        Any other event = 1 point*/

        $points = array(
        "PushEvent" => 10 ,
        "PullRequestEvent" => 5,
        "IssueCommentEvent" => 4
        );

        if(Arr::exists($points,$type))
        {
            $earned_points[$type] += $points[$type];

        }else{
            $earned_points['other'] += 1;
        }

        return $earned_points;
    }

    /*
     *  get_data_using_url() : Get Url data using curl.
    */

    public function get_data_using_url($name){

        // Generate Url.

        $url = "https://api.github.com/users/$name/events/public";
        $t_curl = curl_init( $url );
        curl_setopt($t_curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13'); // Set a user agent
        curl_setopt( $t_curl, CURLOPT_RETURNTRANSFER, true );

        $t_data = curl_exec( $t_curl );

        // Curl close.
        curl_close( $t_curl );

        // Return data.
        return $t_data;

    }
}
