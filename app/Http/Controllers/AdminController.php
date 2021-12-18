<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Session;

class AdminController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!$request->session()->has('admin_id')) {
            return redirect('admin/login');
        } 
        $controller = $request->path();
        $name = $request->session()->get('name');
        $email = $request->session()->get('email');
        $id = $request->session()->get('admin_id');
        $status = $request->session()->get('status');      
        
        
        return view('Admin.index',
                    [
                        'controller' => $controller,
                        'name' => $name,
                        'email' => $email,
                        'id' => $id,
                        'status' => $status,
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
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
                'email' => $datas['email'],
                'password' => $datas['password'],
                'status' => 1,
                'created_date' => time(),
                'modified_date' => time(),
            ];
            
            if (DB::table('admins')->insert($insert_arr)) {
                $request->session()->flash('success', 'Admin has been Add successfully');
            } else {
                $request->session()->flash('dangers', "Unable to Add Admin");
            }
        }
        
        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if ($request->isMethod('post') || $request->isMethod('put')) {
            $input = $request->all();
            
            $id = $input['id'];
            
            if (Admin::where('id', $id)->exists()) {
                $data = DB::table('admins')->where('id', $id)->first();
                
                return view("Admin.edit", ["data" => $data]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if ($request->isMethod('post') || $request->isMethod('put')) {
            $datas = $request->all();
            
            if (Admin::where('id', $id)->exists()) {
                
                $update_arr = [
                    'name' => $datas['name'], 
                    'email' => $datas['email'],
                    'password' => $datas['password'],
                    'status' => 1,
                    'created_date' => time(),
                    'modified_date' => time(),
                ];
            
                if (DB::table('admins')->where('id', $id)->update($update_arr)) {
                    $request->session()->flash('success', 'Admin has been update successfully');
                } else {
                    $request->session()->flash('dangers', "Unable to update Admin");
                }
                
            }
        }
        return redirect('/admin/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if ($request->isMethod('get')) {
            if (Admin::where('id', $id)->exists()) {
                DB::table('admins')->where('id', $id)->delete();
                $request->session()->flash('success', 'Admin has been deleted successfully');
            } else {
                $request->session()->flash('dangers', "The Admin with id: '$id' could not be deleted");
            }
        }
       
        return redirect('/admin/index');
    }
    
    public function login(Request $request) {
        
        if ($request->session()->has('admin_id')) {
            return redirect('dashboard');
        }
        
        if ($request->isMethod('post')) {
           
            $datas = $request->all();
           
            if (!isset($datas['_token']) && $datas['_token'] == '') {
                return redirect('/admin');
            } else {
                $email = $datas['email'];
                $pass  = $datas['password'];
                $token = $datas['_token'];                
               
                $check = DB::table('admins')->where(function($query) use ($email, $pass, $token) {
                            $query->where('email', $email);
                            $query->where('password', $pass);
                        })->get();
                        
               
                if (count($check) > 0) {
                    
                    foreach ($check as $val) {
                        $request->session()->put('admin_id', $val->id);
                        $request->session()->put('name', $val->name);
                        $request->session()->put('email', $val->email);
                        $request->session()->put('status', $val->status);
                    }
                    
                    return redirect('/dashboard');
                } else {
                    $request->session()->flash('dangers', 'Invalid email or Password');
                }
            }
            
            return redirect('/admin');
        }
        return view('Admin.login');
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
                    $sOrder .= "admins.".$aColumns[ intval( $request->$sSortDir_ ) ]." ".
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
               
                $sWhere .= " admins.".$search[$i]." LIKE '%". $request->sSearch ."%' OR ";
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
                $sWhere = " admins.".$search[$i]." LIKE '%".$request->$sSearch."%' ";
            }
            
        }
    
        $keys =  DB::table('admins')->whereRaw($sWhere)->orderBy($sOrder[0], $sOrder[1])->offset($offset)->limit($sLimit)->get();
              
       
        $iTotal = DB::table('admins')->whereRaw($sWhere)->count();

                    
        $idisplayrecords = DB::table('admins')->whereRaw($sWhere)->limit($sLimit)->count();
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
           
            $output['aaData'][]['admins'] = array(
                'id'                =>  $key->id,
                'name'              =>  $key->name,
                'email'             =>  $key->email,
                'status'            =>  $key->status,
                'created_date'      =>  date('d/m/Y', $key->created_date),
                'modified_date'     =>  date('d/m/Y h:i:s A', $key->modified_date),
            );
           
        }
        
     	echo json_encode($output); exit;
    }
    
    
    public function update_status(Request $request) {
        
        if ($request->isMethod('post') || $request->isMethod('put')) {
            $input = $request->all();
            
            $id     = $input['id'];
            $status = $input['status_val'];
            
            if (Admin::where('id', $id)->exists()) {
                
                DB::table('admins')->where('id', $id)->update(array('status' => $status));  

            }
        }
        unset($id);
        unset($status);
        exit;
   
    }
    
    public function logout(Request $request) {
      
        $request->session()->forget('admin_id');
        $request->session()->forget('email');
        $request->session()->forget('name');
        $request->session()->forget('status');
       
        return redirect('/admin');
    }
}
