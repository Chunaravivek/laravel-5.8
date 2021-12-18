<?php

namespace App\Http\Controllers;


BASE_PATH . '/vendor/Nelexa_gplay/autoload.php';
base_path() . '/vendor/googleplayscraper/autoload.php';

use App\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Session;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        echo "<pre>";
        print_r(base_path() . '/vendor/googleplayscraper/autoload.php');
        exit;
        $controller = $request->path();
        $name = $request->session()->get('name');
        $email = $request->session()->get('email');
        $id = $request->session()->get('admin_id');
        $status = $request->session()->get('status');      
        
        
        return view('Application.index',
                    [
                        'controller' => $controller,
                        'name' => $name,
                        'email' => $email,
                        'id' => $id,
                        'status' => $status,
                    ]);
    }
    
    public function records(Request $request) {
      
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
        */
        
        $aColumns = array('id','full_name','email', 'type', 'created_date' ,'modified_date');
        $search = array('full_name','email');
        /*
        * Paging
        */
        $sLimit = "";
        $offset = "";
        if ( isset( $request->iDisplayStart ) && $request->iDisplayStart != '-1' )
        {
            $sLimit = " ".intval( $request->iDisplayStart ).", ".
                    intval( $request->iDisplayLength );
         
            $paggin = explode(',', $sLimit);
           
            $offset = $paggin[0];
            $sLimit = $paggin[1];
        }
      
        /*
         * Ordering
        */
        $sOrder = "";
      
        if ( isset( $request->iSortCol_0 ) )
        {           
            
            $sOrder = " ";
            for ( $i = 0 ; $i<intval( $request->iSortingCols ) ; $i++ )
            {
                $bSortable_ = 'bSortable_' .$i;
               
                if ( $request->$bSortable_  == "true" )
                {
                    $sSortDir_ =  'sSortDir_' .$i;
                    $sOrder .= "applications.".$aColumns[ intval( $request->$sSortDir_ ) ]." ".
                        ($request->$sSortDir_ === 'asc' ? 'asc' : 'desc') .", ";
                  
                }
            }
         
            $sOrder = explode( ' ', (trim(substr_replace( $sOrder, "", -2 ))));
          
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }
       
        // echo "<pre>"; print_r($sOrder); exit;
     	/*
            * Filtering
            * NOTE this does not match the built-in DataTables filtering which does it
            * word by word on any field. It's possible to do here, but concerned about efficiency
            * on very large tables, and MySQL's regex functionality is very limited
        */
        $sWhere = "";
        
//        
        $sWhere = " 1=1 ";
        

        if ( isset($request->sSearch) && $request->sSearch != "" )
        {
           
            $sWhere .= " AND ";
            for ( $i=0 ; $i<count($search) ; $i++ )
            {
               
                $sWhere .= " applications.".$search[$i]." LIKE '%". $request->sSearch ."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
           
        }
         
        /* Individual column filtering */
        for ( $i=0 ; $i<count($search) ; $i++ )
        {          
            
            $bSearchable = 'bSearchable_'.$i;
            $sSearch = 'sSearch_'.$i;
            
            if ( isset($bSearchable) && $request->$bSearchable.$i == "true" && $request->$sSearch  != '' )
            {
                
                if ( $sWhere == "" )
                {
                    $sWhere = " 1=1 ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $sWhere = " applications.".$search[$i]." LIKE '%".$request->$sSearch."%' ";
            }
            
        }
        // echo "<pre>"; print_r($request->query); exit;
    
        $keys =  DB::table('applications')->whereRaw($sWhere)->orderBy($sOrder[0], $sOrder[1])->offset($offset)->limit($sLimit)->get();
      
        $iTotal = DB::table('applications')->whereRaw($sWhere)->count();

                    
        $idisplayrecords = DB::table('applications')->whereRaw($sWhere)->limit($sLimit)->count();
        /*
         * Output
        */
        $output = array(
            "sEcho" => isset($request->sEcho) ? intval($request->sEcho) : 1,
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $idisplayrecords,
            "aaData" => array(),
        );
        
        foreach ($keys as $key) {
           
            $output['aaData'][]['Application'] = array(
                'id'                =>  $key->id,
                'name'              =>  $key->name,
                'package_name'      =>  $key->package_name,
                'status'            =>  $key->status,
                'created_date'      =>  date('d/m/Y', $key->created_date),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key->modified_date),
            );
           
        }
        
     	echo json_encode($output); exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $datas = $request->all();
            
            $insert_arr = [
                'name' => $datas['name'], 
                'package_name' => $datas['package_name'],
                'status' => 1,
                'created_date' => time(),
                'modified_date' => time(),
            ];
            
            if (DB::table('applications')->insert($insert_arr)) {
                return redirect()->route('application.index')->with('success','Application created successfully.');
            } else {
                return redirect()->route('application.index')->with('dangers','Unable to Add Admin');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application) {
        //
    }
    
    public function package_name(Request $request, Application $application) {
        if ($request->isMethod('post')) {
            $datas = $request->all();
            
            $gplay = new \Nelexa\GPlay\GPlayApps();
            $scraper = new Scraper();
            echo "<pre>";
            print_r($scraper);
            exit;
            $response = [];
            $response['code'] = 0;

            $url = $datas['package_name'];
            $package_name = str_replace('https://play.google.com/store/apps/details?id=', '', $url);

            $ifpackage_name = DB::table('applications')->whereRaw("package_name = '$package_name'")->count();
            echo "<pre>";
            print_r($ifpackage_name);
            exit;
            if ($ifpackage_name > 0) {
                $response['code'] = 201;
            } else {
                $app = $scraper->getApp($package_name);

                if (isset($app['success']) && $app['success'] == 200) {
                    
                    $response['code'] = 200;

                } else {

                    $response['code'] = 401;
                }
            }


            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }
}
