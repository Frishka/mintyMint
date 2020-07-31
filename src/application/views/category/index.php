<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-3">Category <?= $category->name?></h3>
            <?php echo form_open('/category/delete',['method' => 'post', 'class' => 'd-inline-block'])?>
            <button type="submit"
                    data-toggle="tooltip" data-placement="top" title="Delete"
                    class="btn btn-danger pull-right">
                DELETE
            </button>
            <?php echo form_input([
                'name' => 'id',
                'type' => 'hidden',
                'value' => $category->id
            ]); ?>
            <?php echo form_close(); ?>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Desc</th>
                </tr>
                <tr>
                    <td><?= $category->id?></td>
                    <td><?= $category->name?></td>
                    <td><?= $category->desc?></td>
                </tr>
            </table>
        </div>
    </div>
</div>


