<main>

    <section>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal">
        Novo
      </button>
    </section>

    <section>
        <table class="table mt-3">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITULO</th>
                    <th>DESCRIÇÃO</th>
                    <th>STATUS</th>
                    <th>DATA</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultado=null?>
            </tbody>
            <tfoot>

            </tfoot>

        </table>
    </section>

</main>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">
          <?=$dataPage->getTituloModal()?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form method="post" id="form">

            <?=$dataPage->getForm()?>

        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="btnSubmit">Salvar</button>
      </div>
    </div>
  </div>
</div>

<!-- div container -->
</div>

<!-- Ajax -->
<script src=<?=$dataPage->getJs()?>></script>

