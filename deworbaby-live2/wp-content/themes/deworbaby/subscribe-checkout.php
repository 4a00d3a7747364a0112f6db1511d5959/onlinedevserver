<?php
/*
Template Name: Subscribe checkout
*/

get_header(); 

?>

<!-- section sign IN -->
  <section class="signIn">
    <div class="container">
       <div class="form_area">
           <div class="form_inner">
              <div class="actual_form_area">
                  <h2>Go through simple three steps and done!</h2>
                  <div class="steps">
                     <div class="line"></div>
                     <div class="line2"></div>
                     <ul>
                       <li><a href="#" class="active">1</a></li>
                       <li><a href="#">2</a></li>
                       <li><a href="#">3</a></li>
                     </ul>
                  </div>
                  <form action="#" method="post"> 
                      <div class="row">
                         <p>Baby's Name</p>
                         <input type="text" name="name">
                      </div>
                      <div class="row clearfix">
                         <p>Select Baby's Gender</p>
                         <div class="retail_box">
                          <input type="radio" name="retail" value="boy" id="boy">
                          <label for="boy"> <span class="input_field"></span><span class="text">Boy</span ></label>
                          
                        </div> 
                        <div class="retail_box">
                          <input type="radio" name="retail" value="girl" id="girl">
                          <label for="girl"> <span class="input_field"></span><span class="text">Girl</span></label>                         
                        </div> 
                      </div>
                      <div class="row clearfix">
                         <p>Select Baby's Date of Birth</p>
                          <div class="querter">
                              <select>
                                <option value=""> </option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                              </select>
                          </div>
                          
                          <div class="querter">
                              <select>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                  <option value="13">13</option>
                                  <option value="14">14</option>
                                  <option value="15">15</option>
                                  <option value="16">16</option>
                                  <option value="17">17</option>
                                  <option value="18">18</option>
                                  <option value="19">19</option>
                                  <option value="20">20</option>
                                  <option value="21">21</option>
                                  <option value="22">22</option>
                                  <option value="23">23</option>
                                  <option value="24">24</option>
                                  <option value="25">25</option>
                                  <option value="26">26</option>
                                  <option value="27">27</option>
                                  <option value="28">28</option>
                                  <option value="29">29</option>
                                  <option value="30">30</option>
                                  <option value="31">31</option>
                              </select>
                          </div>
                          <div class="querter">
                               <select>
                                  <option value="2018">2018</option>
                                  <option value="2017">2017</option>
                                  <option value="2016">2016</option>
                                  <option value="2015">2015</option>
                                  <option value="2014">2014</option>
                                  <option value="2013">2013</option>
                                  <option value="2012">2012</option>
                                  <option value="2011">2011</option>
                                  <option value="2010">2010</option>
                                  <option value="2009">2009</option>
                                  <option value="2008">2008</option>
                                </select>
                           </div>
                      </div>
                      <div class="row">
                         <p>Baby's Weight</p>
                         <input type="text" name="name">
                      </div>                      
                      <div class="row signin_btn">
                         <input type="submit" name="" value="Continue"> 
                      </div>                      
                  </form>
                  
              </div>
           </div>          
       </div>
    </div>
  </section>

<?php get_footer(); ?>