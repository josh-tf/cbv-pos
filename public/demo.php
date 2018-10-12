<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <style>
         .form-group {
         padding: 6px;
         }
      </style>
      <script type="text/javascript">
         $(document).ready(function(){
         $(".add-row").click(function(){


         var name = $("#cbvid").val();
         var category = $("#category").val();
         var price = $("#price").val();
         var buildDate = $("#buildDate").val();
         var brandModel = $("#brandModel").val();
         var cpuType = $("#cpuType").val();
         var cpuSpeed = $("#cpuSpeed").val();
         var ram = $("#ram").val();
         var storage = $("#storage").val();
         var distro = $("#distro").val();
         var screen = $("#screen").val();
         var drive = $("#drive").val();
         var type = $("#type").val();
         var battery = $("#battery").val();
         var boxPrice = $("#boxPrice").val();
         var extras = $("#extras").val();
         var notes = $("#notes").val();
         var description = $("#description").val();

      var fields = [name,category,price,buildDate,brandModel,cpuType,cpuSpeed,ram,storage,distro,screen,drive,type,battery,boxPrice,extras,notes,description];
      var markup = '<tr><td><input type="checkbox" name="record"></td>';

      fields.forEach(function(field) {
      markup += '<td>' + field + '</td>'
      });

       markup += '</tr>'

         $("table tbody").append(markup);
         });


         // Find and remove selected table rows
         $(".delete-row").click(function(){
         $("table tbody").find('input[name="record"]').each(function(){
         if($(this).is(":checked")){
         $(this).parents("tr").remove();
         }
         });
         });
         });
      </script>
   </head>
   <body>
      <div class="container">
         <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                  <div class="jumbotron">
                     <h2>
                        Hello, world!
                     </h2>
                     <p>
                        This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
                     </p>
                     <p>
                        <a class="btn btn-primary btn-large" href="#">Learn more</a>
                     </p>
                  </div>
                  <div class="row">
                     <div class="container-fluid shadow">
                        <div class="row">
                           <div id="valErr" class="row viewerror clearfix hidden">
                              <div class="alert alert-danger">Oops! Seems there are some errors..</div>
                           </div>
                           <div id="valOk" class="row viewerror clearfix hidden">
                              <div class="alert alert-success">Yay! ..</div>
                           </div>
                           <div class="row">
                              <form>
                                 <div class="col-md-12">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div class="row" style="display: block;">
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="control-label" for="cbvid">CBV ID<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <input id="cbvid" type="text" class="form-control k-textbox" data-role="text" placeholder="8XXX" required="required" name="cbvid" data-parsley-errors-container="#errId1"><span id="errId1" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="control-label" for="category">Category<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <select id="category" class="form-control" data-role="select" selected="selected" name="category" required="required" data-parsley-errors-container="#errId2">
                                                         <option value=""></option>
                                                         <option value="Desktop">Desktop</option>
                                                         <option value="Laptop">Laptop</option>
                                                      </select>
                                                      <span id="errId2" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="control-label" for="price">Unit Price<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <input id="price" type="text" class="form-control k-textbox" data-role="text" placeholder="0.00" name="price" required="required" data-parsley-errors-container="#errId3"><span id="errId3" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label class="control-label" for="buldDate">Build Date<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <input id="buildDate" type="text" class="form-control k-textbox" data-role="text" placeholder="0.00" name="buildDate" required="required" data-parsley-errors-container="#errId3"><span id="errId3" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label class="control-label" for="brandModel">Brand / Model<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <input id="brandModel" type="text" class="form-control k-textbox" data-role="text" name="brandModel" required="required" placeholder="Lenovo T440" data-parsley-errors-container="#errId5"><span id="errId5" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row" style="display: block;">
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="control-label" for="cpuType">CPU Type<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <select id="cpuType" class="form-control" data-role="select" name="cpuType" selected="selected" required="required" data-parsley-errors-container="#errId6">
                                                         <option value="" selected="selected"></option>
                                                         <option value="C2D">C2D</option>
                                                         <option value="Celeron">Celeron</option>
                                                         <option value="Pentium">Pentium</option>
                                                         <option value="i3">i3</option>
                                                         <option value="">i5</option>
                                                         <option value="">i7</option>
                                                      </select>
                                                      <span id="errId6" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group" style="display: block;">
                                                   <label class="control-label" for="cpuSpeed">CPU Speed<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <input id="cpuSpeed" type="text" class="form-control k-textbox" data-role="text" placeholder="2.4" required="required" data-parsley-errors-container="#errId7"><span id="errId7" class="error"></span>
                                                   </div>
                                                </div>
                                                <div class="formControl ui-draggable" style="display: none;">
                                                   <img src="/images/dropdown.png">Drop Down
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group" style="display: block;">
                                                   <label class="control-label" for="ram">RAM<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <select id="ram" class="form-control" data-role="select" name="ram" selected="selected" required="required" data-parsley-errors-container="#errId8">
                                                         <option value=""></option>
                                                         <option value="2">2</option>
                                                         <option value="4">4</option>
                                                         <option value="6">6</option>
                                                         <option value="8">8</option>
                                                      </select>
                                                      <span id="errId8" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                          <div class="row" style="display: block;">
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="control-label" for="storage">Storage<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <input id="storage" type="text" class="form-control k-textbox" data-role="text" placeholder="240" name="storage" required="required" data-parsley-errors-container="#errId9"><span id="errId9" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="control-label" for="distro">Distro<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <input id="distro" type="text" class="form-control k-textbox" data-role="text" placeholder="" name="distro" required="required" data-parsley-errors-container="#errId10"><span id="errId10" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="control-label" for="screen">Screen Size<span class="req"> *</span></label>
                                                   <div class="controls">
                                                      <select id="screen" class="form-control" data-role="select" selected="selected" name="screen" required="required" data-parsley-errors-container="#errId11">
                                                         <option value=""></option>
                                                         <option value="12">12</option>
                                                         <option value="14">14</option>
                                                         <option value="15.4">15.4</option>
                                                         <option value="17">17</option>
                                                         <option value="20">20</option>
                                                         <option value="22">22</option>
                                                         <option value="24">24</option>
                                                      </select>
                                                      <span id="errId11" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label class="control-label" for="drive">Optical Drive</label>
                                                   <div class="controls">
                                                      <select id="drive" class="form-control" data-role="select" selected="selected" name="drive" data-parsley-errors-container="#errId12">
                                                         <option value=""></option>
                                                         <option value="DVD-RW">DVD-RW</option>
                                                      </select>
                                                      <span id="errId12" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label class="control-label" for="type">Desktop Type</label>
                                                   <div class="controls">
                                                      <select id="type" class="form-control" data-role="select" selected="selected" name="type" data-parsley-errors-container="#errId13">
                                                         <option value=""></option>
                                                         <option value="Tower">Tower</option>
                                                         <option value="All in One">All in One</option>
                                                         <option value="Small Form">Small Form</option>
                                                      </select>
                                                      <span id="errId13" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label class="control-label" for="battery">Battery Life</label>
                                                   <div class="controls">
                                                      <input id="battery" type="text" class="form-control k-textbox" data-role="text" placeholder="2.2" name="battery" data-parsley-errors-container="#errId14"><span id="errId14" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                   <label class="control-label" for="boxPrice">Box Only Price</label>
                                                   <div class="controls">
                                                      <input id="boxPrice" type="text" class="form-control k-textbox" data-role="text" placeholder="" name="boxPrice" data-parsley-errors-container="#errId15"><span id="errId15" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                       <div class="row" style="display: block;">
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <label class="control-label control-label-left col-sm-3" for="extras">Extras</label>
                                                   <div class="controls col-sm-9">
                                                      <textarea id="extras" rows="3" class="form-control k-textbox" data-role="textarea" name="extras" data-parsley-errors-container="#errId16"></textarea><span id="errId16" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="col-md-4">
                                          <div class="row">
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <label class="control-label control-label-left col-sm-3" for="notes">Other Notes</label>
                                                   <div class="controls col-sm-9">
                                                      <textarea id="notes" rows="3" class="form-control k-textbox" data-role="textarea" name="notes" data-parsley-errors-container="#errId17"></textarea><span id="errId17" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="col-md-4">
                                          <div class="row">
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <label class="control-label control-label-left col-sm-3" for="description">Description</label>
                                                   <div class="controls col-sm-9">
                                                      <textarea id="description" rows="3" class="form-control k-textbox" data-role="textarea" name="description" data-parsley-errors-container="#errId18"></textarea><span id="errId18" class="error"></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </div>

                                       </div>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                     <input type="button" class="add-row" value="Add Row">
                     <button type="button" class="delete-row">Delete Row</button>
                     </form>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <h3>
                           h3. Lorem ipsum dolor sit amet.
                        </h3>
                        <p>
                           Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
                        </p>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>Delete</th>
                                 <th>CBD ID</th>
                                 <th>Category</th>
                                 <th>Price</th>
                                 <th>Build Date</th>
                                 <th>Brand/Model</th>
                                 <th>CPU Type</th>
                                 <th>CPU Speed</th>
                                 <th>RAM</th>
                                 <th>Storage</th>
                                 <th>Distro</th>
                                 <th>Screen</th>
                                 <th>Optical</th>
                                 <th>Type</th>
                                 <th>Battery</th>
                                 <th>Box Price</th>
                                 <th>Extras</th>
                                 <th>Other Notes</th>
                                 <th>Description</th>
                              </tr>
                           </thead>
                           <tbody></tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>