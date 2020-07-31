<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('/category/add',['method' => 'post'])?>
            <div class="modal-body">

                    <div class="form-group">
                        <label for="inputName">Name category</label>
                        <?php echo form_input(['name' => 'category_name',
                            'id' => 'inputName',
                            'class' => 'form-control',
                            'placeholder' => 'Enter name',
                        ]); ?>
                    </div>
                    <div class="form-group">
                        <label for="inputDesc">Description category</label>
                        <?php echo form_input(['name' => 'category_desc',
                            'id' => 'inputDesc',
                            'class' => 'form-control',
                            'placeholder' => 'Enter desc',
                        ]); ?>
                    </div>
                <?php echo form_input([
                        'name' => 'parent_id',
                    'type' => 'hidden',
                ]); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
