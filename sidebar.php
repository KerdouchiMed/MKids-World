<div >
  <button class="btn btn-default hidden-xs btn-sm hidden-md hidden-lg" data-target="#sidebar-modal" data-toggle="modal">
      <i class="fa fa-chevron-circle-up fa-2x">Sidebar</i>
  </button>
  <div class="hidden-xs hidden-sm">
      <?php dynamicSidebarWithImage('languages'); ?>
      <?php dynamicSidebarWithImage('channels'); ?>
      <?php dynamicSidebar('categories'); ?>
  </div>
  <div class="modal fade" id="sidebar-modal">
       <div class="modal-dialog ">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <?php dynamicSidebarWithImage('languages'); ?>
                  <?php dynamicSidebarWithImage('channels'); ?>
                  <?php dynamicSidebar('categories'); ?>
               </div>
               <div class="modal-footer">
                   
               </div>
           </div>
       </div>
  </div>
    
</div>
