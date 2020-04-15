<!-- Modal contenant le tutoriel-->
<div class="modal fade bd-example-modal-lg" id="Tutoriel" tabindex="-1" role="dialog" aria-labelledby="TutorielLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="TutorielLabel">Tutoriel</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	        <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="" id="video" title="Tutoriel"></iframe>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function() 
    {
        // Arrête la video quand on ferme la modal
        $('#Tutoriel').on('hide.bs.modal', function (e) 
        {
            $("#video").attr('src',""); 
        }) 
        // Ouvre la video quand on ouvre la modal
        $('#Tutoriel').on('show.bs.modal', function (e) 
        {
            $("#video").attr('src',"../Images/TutoQuizzENSC.mp4"); 
        })  
    });
</script>

<?php if(isset($_GET['showTuto'])) //Permet d'afficher directement le tuto lorsqu'on vient de s'inscrire
{?>
    <script>
        $("#video").attr('src',"../Images/TutoQuizzENSC.mp4"); 
        $('.bd-example-modal-lg').modal('show');
    </script>

<?php } ?>

<footer class="footer text-center">
    <h6>Besoin d'aide? <a data-toggle="modal" data-target="#Tutoriel" href="#">Cliquez ici</a></h6>
</footer>