<div class="container demo">
    <!-- Modal -->
  <div class="modal left fade" id="modalQuickSearch" tabindex="-1" role="dialog" aria-labelledby="modalQuickSearchLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div  style="background-color:#3c8dbc; color:antiquewhite"  class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4  class="modal-title" id="modalQuickSearchLabel">Quick Search Result</h4>
        </div>

        <div class="modal-body">
           <p>
                <div id="searchXX"  >
                 </div>
           </p>
        </div>
        <footer  style="background-color:#3c8dbc;" class="demo-footer">
           <button type="button" class="btn  btn-danger btn-lg btn-block" data-dismiss="modal" >Close</button>
        </footer>

      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->
  

</div><!-- container -->
@include('corpses.showModal')