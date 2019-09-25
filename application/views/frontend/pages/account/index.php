<div id="main" class="content_section bg-secondary pt-4">
  <div class="container">
  	<div class="row">
    	<div class="col-md-10 offset-md-1">
        	<div class="row">
                <div class="col-sm-4">
                   <?php $this->load->view('frontend/pages/account/prescriptions/left_menu');?>
                </div>
                <div class="col-sm-8">
                    <div class="account-form-area">
                    	<h3>My Prescriptions</h3>
                        <div class="upload-btn-wrapper">
                        	<a href="#">
                          	<i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
                          	<span><strong>Add Your Prescription</strong><br>
                          	Store a new glasses Prescription.</span>
                            </a>
                        </div>
                        <div class="my-presciption-view">
                        	<h5>Prescription View</h5>
                            <p><strong>Added/Updated</strong>: 2019.12.20 13.12.20</p>
                        	<table class="table table-bordered">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">Eye</th>
                                  <th scope="col">SPH</th>
                                  <th scope="col">CYL</th>
                                  <th scope="col">AXIS</th>
                                  <th scope="col">ADD</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">Right</th>
                                  <td>0</td>
                                  <td>0</td>
                                  <td>0</td>
                                  <td>0.0</td>
                                </tr>
                                <tr>
                                  <th scope="row">Left</th>
                                  <td>0</td>
                                  <td>0</td>
                                  <td>0</td>
                                  <td>0.0</td>
                                </tr>
                              </tbody>
                            </table>
                            <p><strong>Pupillary Distance</strong>: average</p>
                            <ul>
                            	<li><a href="#" class="btn my-btn">Edit Prescription</a></li>
                                <li><a href="#" class="btn my-btn">Delete Prescription</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>