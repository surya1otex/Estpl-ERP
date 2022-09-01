@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Create Elements</h3></div>

                    <div class="">
                    <div id="container1" class="row clearfix addrow">
      

                          <table class="table">
                             <tr>
                               <th>Name</th>
                               <th>Action</th>
                            </tr>
                            
                            <tr>
                              
                               <td><input type="text" class="form-control"></td>
                               <td><button class="btn btn-success upload-clarification-add" type="button"><i class="fas fa-plus-circle"></i></button></td>
                             
                            </tr>
                          </table>
                          <button type="submit" class="btn btn-success" style="margin-left:12px">Submit</button>







                            <!-- <div class="col-md-4 focused">
                                    <p>
                                       Field Name
                                    </p>
                                <input type="text" class="form-control">
                                </div>






                                <div class="col-md-2 p-t-25">
<button id="newField_1" class="add-data btn btn-success btn-circle waves-effect waves-circle waves-float" name="submit" type="button">
<i class="material-icons">add</i>
</button>
</div> -->
                                
                             </div>











                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->



@endsection

