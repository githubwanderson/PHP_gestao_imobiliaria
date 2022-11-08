<main>

  <section>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal" id="btnNovo">
      Novo
    </button>
  </section>

  <section>
    <div class="table-responsive text-center">
      <table class="table table-striped table-sm table-hover mt-3">

          <thead class='mensalidade'>
              <?=$dataPage->getHeadTabela()?>
          </thead>
          <tbody id="tbody">
          </tbody>
          <tfoot>
          </tfoot>

      </table>
    </div>
  </section>

</main>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form id="form">

            <?=$dataPage->getForm()?>

        </form>

      </div>
      <div class="modal-footer" id="modalFooter">        
      </div>
    </div>
  </div>
</div>

<!-- div container -->
</div>

<!-- Ajax -->
<script src=<?=$dataPage->getJs()?>></script>

