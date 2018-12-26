<?php

class Form_process {

    public function add_form($parameter, $id){
        $id = $id;
        $modal = '
            <div id="add_form_show" class="modal fade add_form_show" role="dialog">
                    <div class="modal-dialog" style="min-width: 90%">

                        <!-- Modal content-->
                        <div class="modal-content" style="min-width: 90%">
                            <div class="modal-header success">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h1 class="modal-title text-center news_heading" style="background:#fff;font-weight: bold;font-family: \'Comic Sans MS\';display:block;color:#000;">Add Form</h1>
                            </div>
                            <div class="modal-body" style="min-width: 90%;box-sizing:inherit">
                                <form class="submit_partner_form">
                                        <input type="hidden" name="action" value="anyName" />
                                        <div class="form-group">
                                            <label>First Name: </label>
                                            <input type="text" name="fname" id="fname"  class="form-control"  required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name: </label>
                                            <input type="text" name="lname" id="lname"  class="form-control"  required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Email: </label>
                                            <input type="email" name="email" id="email"  class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number: </label>
                                            <input type="tel" name="phone_number" id="tel"  class="form-control"  required />
                                        </div>
                                        <div class="form-group">
                                            <label>Alternative Phone Number: </label>
                                            <input type="tel" name="alternative_phone_number" id="atel"  class="form-control"   />
                                        </div>
                                        <div class="form-group">
                                            <label>Country: </label>
                                            <input type="text" name="country" id="country"  class="form-control"  required />
                                        </div>
                                        <div class="form-group">
                                            <label>City: </label>
                                            <input type="text" value="Accra" name="city" id="city"  class="form-control"  required/>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label>Amount to Invest: </label>
                                            <input type="text" name="amount_to_invest" id="amounttoInvest"  class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Currency: </label>
                                            <input type="text" name="currency" value="GHC" id="currency"  class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Contract Period: </label>
                                            <select name="contract_period" id="cperiod" class="form-control" style="height: 50px;"  required>
                                                <option>Select Contract Period</option>
                                                <option>3 months</option>
                                                <option>6 months</option>
                                                <option>12 months</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Payment Method: </label>
                                            <select name="payment_method" id="pmethod" style="height: 50px;"   class="form-control" required>
                                                <option selected disabled>Select Payment Method</option>
                                                <option>Cash</option>
                                                <option>Mobile Money</option>
                                                <option>Bank</option>
                                            </select>
                                        </div>
                                        <br/><br/>
                                        <input type="hidden" name="add_status" value="'.rand().time().mt_rand().'__'.date('y-m-d').'_app" />
                                        <input type="hidden" name="id" value="'.$id.'" />
                                    <button type="submit" class="btn btn-lg btn-block btn-info submit_form">Submit</button>
                                </form>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        
        
        ';
        echo json_encode(array("status"=>"success", "modal"=>$modal , "feedback"=>$parameter ));
    }

    public function edit_form($parameter){
        
        $index = $_POST['edit_form'];

        //get json data
        $data = file_get_contents('forms_details.json');
        $data_array = json_decode($data);

	    //assign the data to selected index
            $row = $data_array[$index];
    
            $modal = '
            <div id="edit_form_show" class="modal fade edit_form_show" role="dialog">
                    <div class="modal-dialog" style="min-width: 90%">

                        <!-- Modal content-->
                        <div class="modal-content" style="min-width: 90%">
                            <div class="modal-header success">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h1 class="modal-title text-center news_heading" style="background:#fff;font-weight: bold;font-family: \'Comic Sans MS\';display:block;color:#000;">Edit Form</h1>
                            </div>
                            <div class="modal-body" style="min-width: 90%;box-sizing:inherit">
                                <form class="update_submit_partner_form">
                                        <input type="hidden" name="action" value="anyName" />
                                        <div class="form-group">
                                            <label>Full Name: </label>
                                            <input type="text" name="name" id="name" value="'.$row->name.'"  class="form-control"  required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Email: </label>
                                            <input type="email" name="email" id="email"  value="'.$row->email.'"   class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number: </label>
                                            <input type="tel" name="phone_number" id="tel"  value="'.$row->phone_number.'"   class="form-control"  required />
                                        </div>
                                        <div class="form-group">
                                            <label>Alternative Phone Number: </label>
                                            <input type="tel" name="alternative_phone_number" id="atel"   value="'.$row->alternative_phone_number.'"   class="form-control"   />
                                        </div>
                                        <div class="form-group">
                                            <label>Country: </label>
                                            <input type="text" name="country" id="country"   value="'.$row->country.'"   class="form-control"  required />
                                        </div>
                                        <div class="form-group">
                                            <label>City: </label>
                                            <input type="text"  name="city" id="city"   value="'.$row->city.'"   class="form-control"  required/>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label>Amount to Invest: </label>
                                            <input type="text" name="amount_to_invest" id="amounttoInvest"   value="'.$row->amount_to_invest.'"   class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Currency: </label>
                                            <input type="text" name="currency" value="GHC" id="currency"  value="'.$row->currency.'"    class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Contract Period: </label>
                                            <select name="contract_period" id="cperiod" class="form-control"   style="height: 50px;"  required>
                                                <option>'.$row->contract_period.'</option>
                                                <option>3 months</option>
                                                <option>6 months</option>
                                                <option>12 months</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Payment Method: </label>
                                            <select name="payment_method" id="pmethod" style="height: 50px;"  class="form-control" required>
                                                <option selected>'.$row->payment_method.'</option>
                                                <option>Cash</option>
                                                <option>Mobile Money</option>
                                                <option>Bank</option>
                                            </select>
                                        </div>
                                        <br/><br/>
                                        <input type="hidden" name="update_status" value="'.rand().time().mt_rand().'__'.date('y-m-d').'_app" />
                                        <input type="hidden" name="id" value="'.$row->id.'" />
                                    <button type="submit" class="btn btn-lg btn-block btn-info update_submit_form">Update</button>
                                </form>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        
        
        ';
        echo json_encode(array("status"=>"success", "modal"=>$modal , "feedback"=>$parameter  ));
    }

    public function save_new_form(){
        $message = '';  
        $error = '';  
        if(isset($_POST["fname"]))  
        {  
             if(empty($_POST["lname"]))  
             {  
                  $error = "<label class='text-danger'>Enter Name</label>"; 
                  echo json_encode(array("status"=>"success", "message"=> $error));
             }  
             else if(empty($_POST["currency"]))  
             {  
                  $error = "<label class='text-danger'>Enter currency</label>";  
                  echo json_encode(array("status"=>"success", "message"=> $error));
             }  
             else if(empty($_POST["phone_number"]))  
             {  
                  $error = "<label class='text-danger'>Enter Phone Number</label>";  
                  echo json_encode(array("status"=>"success", "message"=> $error));
             }  
             else  
             {  
                  if(file_exists('forms_details.json'))  
                  {  
                    $current_data = file_get_contents('forms_details.json');  
                    $array_data = json_decode($current_data, true);  
                    $extra = array(  
                         'id'               =>     $_POST['id'],  
                         'name'               =>     $_POST['fname'].' '. $_POST['lname'],  
                         'email'          =>     $_POST["email"],   
                         'phone_number'          =>     $_POST["phone_number"],   
                         'alternative_phone_number'          =>     $_POST["alternative_phone_number"],   
                         'city'          =>     $_POST["city"],   
                         'country'          =>     $_POST["country"],   
                         'amount_to_invest'          =>     $_POST["amount_to_invest"],   
                         'currency'          =>     $_POST["currency"],   
                         'contract_period'          =>     $_POST["contract_period"],   
                         'payment_method'          =>     $_POST["payment_method"],
                         'date_submitted'          =>     date("F j, Y, g:i a",  time())
                         
                    );  
                       
                       $array_data[] = $extra;  
                       $final_data = json_encode($array_data, JSON_PRETTY_PRINT);  

                       if(file_put_contents('forms_details.json', $final_data))  
                       {  
                            echo json_encode(array("status"=>"success", "message"=> "File Appended Successfully"));  
                       }  
                  }  
                  else  
                  {  

                       $current_data = file_get_contents('forms_details.json');  
                       $array_data = json_decode($current_data, true);  
                       $extra = array(  
                            'name'               =>     $_POST['fname'].' '. $_POST['lname'],  
                            'email'          =>     $_POST["email"],   
                            'phone_number'          =>     $_POST["phone_number"],   
                            'alternative_phone_number'          =>     $_POST["alternative_phone_number"],   
                            'city'          =>     $_POST["city"],   
                            'country'          =>     $_POST["country"],   
                            'amount_to_invest'          =>     $_POST["amount_to_invest"],   
                            'currency'          =>     $_POST["currency"],   
                            'contract_period'          =>     $_POST["contract_period"],   
                            'payment_method'          =>     $_POST["payment_method"],
                            'date_submitted'          =>     date("F j, Y, g:i a",  time())
                            
                       );  
                       
                       $array_data[] = $extra;  
                       $final_data = json_encode($array_data);  
                       if(file_put_contents('forms_details.json', $final_data))  
                       {  
                            echo json_encode(array("status"=>"success", "message"=> "File Appended Successfully"));  
                       }  
                        //echo json_encode(array("status"=>"success", "message"=> "JSON File not exits"));  
                       //$error = 'JSON File not exits';  
                  }  
             }  
        }else{
           echo json_encode(array("status"=>"error", "message"=> ""));  
        } 
    }

    public function update_form(){
        $message = '';  
        $error = '';  
        if(isset($_POST["name"]))  
        {  
             if(empty($_POST["name"]))  
             {  
                  $error = "<label class='text-danger'>Enter Name</label>"; 
                  echo json_encode(array("status"=>"success", "message"=> $error));
             }  
             else if(empty($_POST["currency"]))  
             {  
                  $error = "<label class='text-danger'>Enter currency</label>";  
                  echo json_encode(array("status"=>"success", "message"=> $error));
             }  
             else if(empty($_POST["phone_number"]))  
             {  
                  $error = "<label class='text-danger'>Enter Phone Number</label>";  
                  echo json_encode(array("status"=>"success", "message"=> $error));
             }  
             else  
             {  

                	//update the selected index

                  if(file_exists('forms_details.json'))  
                  {  
                        //get the index from URL
                        $index = $_POST['id'];
                        $minus_id = $index - 1;
                        //get json data
                        //$data = file_get_contents('forms_details.json');
                        //$data_array = json_decode($data);

                        //assign the data to selected index
                        //$row = $data_array[$index];
                        
                      
                        
                       
                        //$data_array[$index] = $extra;

                        //encode back to json
                        //$data = json_encode($data_array, JSON_PRETTY_PRINT);

                        /*if(file_put_contents('forms_details.json', $data))  
                        {  
                             echo json_encode(array("status"=>"success", "message"=> "File Updated Successfully"));  
                        }  
                        */

                        $jsonString = file_get_contents('forms_details.json');
                        $data = json_decode($jsonString, true);

                        $data[$minus_id]['id'] = $_POST['id'];
                        // or if you want to change all entries with activity_code "1"
                        foreach ($data as $key => $entry) {
                            if ($entry['id'] == $index) {
                                //$data[$key]['name'] = "TENNIS";
                                $data[$key] = array(  
                                    'id'                        =>      $_POST['id'],  
                                    'name'                      =>      $_POST['name'],  
                                    'email'                     =>      $_POST["email"],   
                                    'phone_number'              =>      $_POST["phone_number"],   
                                    'alternative_phone_number'  =>      $_POST["alternative_phone_number"],   
                                    'city'                      =>      $_POST["city"],   
                                    'country'                   =>      $_POST["country"],   
                                    'amount_to_invest'          =>      $_POST["amount_to_invest"],   
                                    'currency'                  =>      $_POST["currency"],   
                                    'contract_period'           =>      $_POST["contract_period"],   
                                    'payment_method'            =>      $_POST["payment_method"],
                                    'date_submitted'            =>      date("F j, Y, g:i a", time())
                                    
                                );  
                            }
                        }

                        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

                        if(file_put_contents('forms_details.json', $newJsonString))  
                        {  
                             echo json_encode(array("status"=>"success", "message"=> "File Updated Successfully"));  
                        }  


                    
                  }  
                  else  
                  {  

                       
                        echo json_encode(array("status"=>"success", "message"=> "JSON File not exits"));  
                       //$error = 'JSON File not exits';  
                  }  
             }  
        }else{
           echo json_encode(array("status"=>"error", "message"=> ""));  
        } 
    }


}


if(isset($_POST['add_form'])){

    $add_form = $_POST['add_form'];
    $id = $_POST['id'];
    $Gform = new Form_process;

    $Gform->add_form($add_form, $id);

}else if(isset($_POST['edit_form'])){


    $edit_form = $_POST['edit_form'];
    $Gform = new Form_process;

    $Gform->edit_form($edit_form);


}else if(isset($_POST['add_status'])){


    $add_status = $_POST['add_status'];
    $Gform = new Form_process;

    $Gform->save_new_form($add_status);

}else if(isset($_POST['update_status'])){


    $update_status = $_POST['update_status'];
    $Gform = new Form_process;

    $Gform->update_form($update_status);


}else{


    echo json_encode(array("status"=>"failure" ));


}