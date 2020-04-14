<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="Tutoriel" tabindex="-1" role="dialog" aria-labelledby="TutorielLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="TutorielLabel">Tutoriel</h3>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
			        <iframe src="../Images/TutoQuizzENSC.mp4" class="videoTuto" title="Tutoriel"></iframe>
			    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 
<script>
$(function(){
  $("body").on('hidden.bs.modal', function (e) {
    var $iframes = $(e.target).find("iframe");
    $iframes.each(function(index, iframe){
      $(iframe).attr("src", $(iframe).attr("src"));
    });
  });
});
</script>
<footer class="footer text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Tutoriel">
    Launch demo modal
    </button>
</footer>